<?php
// src/AppBundle/Admin/EstateAdmin.php
namespace AppBundle\Admin;

use Symfony\Component\Validator\Constraints as Assert;

use Sonata\AdminBundle\Admin\Admin,
    Sonata\AdminBundle\Datagrid\ListMapper,
    Sonata\AdminBundle\Datagrid\DatagridMapper,
    Sonata\AdminBundle\Form\FormMapper;

use AppBundle\Entity\Estate,
    AppBundle\Service\GeoCoder;

class EstateAdmin extends Admin
{
    protected $_geoCoder;

    public function setGeoCoder(GeoCoder $geoCoder)
    {
        $this->_geoCoder = $geoCoder;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add("code", "text", [
                "label" => "ID"
            ])
            ->addIdentifier("title", "text", [
                "label" => "Назва об'єкту"
            ])
            ->add("estateType", NULL, [
                "label" => "Тип нерухомості"
            ])
            ->add("price", "number", [
                "label"       => "Ціна",
                "precision"   => 2
            ])
        ;
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $translator = $this->getConfigurationPool()->getContainer()->get("translator");

        $lTranslator = function($input, $transDomain) use ($translator)
        {
            $output = [];

            foreach($input as $key => $value) {
                $output[$key] = $translator->trans($value, [], $transDomain);
            }

            return $output;
        };

        $tradeTypes = $lTranslator(Estate::getTradeTypes(), "trade_types");
        $districts  = $lTranslator(Estate::getDistricts(), "districts");

        $estateTypeQuery = $this->modelManager
            ->getEntityManager('AppBundle\Entity\EstateType')
            ->createQueryBuilder()
            ->select("estateType")
            ->from('AppBundle\Entity\EstateType', 'estateType')
            ->where("estateType.parent IS NOT NULL");

        $formMapper
            ->add("code", "text", [
                "label" => "ID"
            ])
            ->add("tradeType", "choice", [
                "label"       => "Тип транзакції",
                "placeholder" => "Оберіть тип транзакції...",
                "choices"     => $tradeTypes
            ])
            ->add("estateType", NULL, [
                "label"         => "Тип нерухомості",
                "required"      => TRUE,
                "placeholder"   => "Оберіть тип нерухомості...",
                "class"         => 'AppBundle\Entity\EstateType',
                "query_builder" => $estateTypeQuery
            ], [
                'edit' => 'standard'
            ])
            ->add("title", "text", [
                "label"    => "Назва об'єкту",
                "required" => FALSE
            ])
            ->add("address", "text", [
                "label" => "Точна адреса об'єкту"
            ])
            ->add("district", "choice", [
                "label"       => "Район",
                "placeholder" => "Оберіть район...",
                "choices"     => $districts
            ])
            ->add("space", "number", [
                "label"     => "Площа",
                "precision" => 2
            ])
            ->add("price", "number", [
                "label"       => "Ціна",
                "precision"   => 2,
                "constraints" => [
                    new Assert\Range(["min" => 0])
                ]
            ])
            ->add("isCashless", "checkbox", [
                "label"    => "Безготівковий розрахунок",
                "required" => FALSE
            ])
            ->add("isNewBuilding", "checkbox", [
                "label"    => "Нова будівля",
                "required" => FALSE
            ])
            ->add("hasElevator", "checkbox", [
                "label"    => "Наявність ліфту",
                "required" => FALSE
            ])
            ->add("hasParking", "checkbox", [
                "label"    => "Наявність парковки",
                "required" => FALSE
            ])
            ->add("hasFurniture", "checkbox", [
                "label"    => "Наявність меблів",
                "required" => FALSE
            ])
            ->add("hasRegistration", "checkbox", [
                "label"    => "Реєстрація для нерезидентів",
                "required" => FALSE
            ])
            ->add("description", "sonata_formatter_type", [
                "label"                => "Опис",
                "event_dispatcher"     => $formMapper->getFormBuilder()->getEventDispatcher(),
                "format_field"         => "descriptionFormatter",
                "source_field"         => "rawDescription",
                "ckeditor_context"     => "base_config",
                "source_field_options" => [
                    "attr" => [
                        "class" => "span10", "rows" => 10
                    ]
                ],
                "listener"             => TRUE,
                "target_field"         => "description"
            ])
            ->add('estatePhoto', 'sonata_type_collection', [
                'label'        => "Управление изображениями",
                'by_reference' => FALSE,
                'btn_add'      => "Добавить изображение"
            ], [
                'edit'   => 'inline',
                'inline' => 'table'
            ])
            ->end()
            ->with("Локалізації")
                ->add("translations", "a2lix_translations_gedmo", [
                    "label"              => "Керування локалізаціями",
                    "translatable_class" => 'AppBundle\Entity\Estate',
                    "required"           => TRUE,
                    "fields"             => [
                        "title" => [
                            "locale_options" => [
                                "en" => [
                                    "label" => "Estate title"
                                ]
                            ]
                        ],
                        "description" => [
                            "locale_options" => [
                                'en' => [
                                    'label'       => 'Description',
                                    'field_type'  => 'ckeditor',
                                    'config_name' => 'base_config'
                                ]
                            ]
                        ],
                        'slug' => [
                            'display' => FALSE
                        ]
                    ]
                ])
        ;
    }

    public function prePersist($estate)
    {
        if( !($estate instanceof Estate) )
            return;

        $this->setCoordinates($estate);
    }

    public function preUpdate($estate)
    {
        if( !($estate instanceof Estate) )
            return;

        $this->setCoordinates($estate);
    }

    protected function setCoordinates($estate)
    {
        $coordinates = $this->_geoCoder->getCoordinates($estate->getAddress());

        $estate
            ->setLatitude($coordinates['latitude'])
            ->setLongitude($coordinates['longitude'])
        ;
    }

    public function getFormTheme()
    {
        return array_merge(
            parent::getFormTheme(),
            array('ApplicationSonataUserBundle:Admin/Form:form_admin_fields.html.twig')
        );
    }
}