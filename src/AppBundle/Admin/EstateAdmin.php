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
            ->where("estateType.parent IS NOT NULL")
        ;

        $formMapper
            ->with("Нерухомість - Локалізований контент")
                ->add("translations", "a2lix_translations_gedmo", [
                    "locales"            => ['ua', 'en'],
                    "label"              => FALSE,
                    "translatable_class" => 'AppBundle\Entity\Estate',
                    "required"           => TRUE,
                    "fields"             => [
                        "title" => [
                            "locale_options" => [
                                "ua" => [
                                    "required" => FALSE,
                                    "label"    => "Назва об'єкту"
                                ],
                                "en" => [
                                    "required" => FALSE,
                                    "label"    => "Estate title"
                                ]
                            ]
                        ],
                        "address" => [
                            "locale_options" => [
                                "ua" => [
                                    "label" => "Точна адреса об'єкту"
                                ],
                                "en" => [
                                    "required" => FALSE,
                                    "label"    => "Exact property address"
                                ]
                            ]
                        ],
                        "description" => [
                            "locale_options" => [
                                'ua' => [
                                    'label'       => 'Опис',
                                    'field_type'  => 'ckeditor',
                                    'config_name' => 'base_config'
                                ],
                                'en' => [
                                    "required"    => FALSE,
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
            ->end()
            ->with("Нерухомість - Загальні дані")
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
                ->add("district", "choice", [
                    "label"       => "Район",
                    "placeholder" => "Оберіть район...",
                    "choices"     => $districts
                ])
                ->add("space", "number", [
                    "label"     => "Площа",
                    "precision" => 2
                ])
                ->add("priceUAH", "number", [
                    "label"       => "Ціна (UAH)",
                    "precision"   => 2,
                    "constraints" => [
                        new Assert\Range(["min" => 0])
                    ]
                ])
                ->add("priceUSD", "number", [
                    "label"       => "Ціна (USD)",
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
            ->end()
            ->with("Нерухомість - Характеристики")
                ->add('estateAttribute', 'sonata_type_collection', [
                    'label'        => FALSE,
                    'by_reference' => FALSE,
                    'btn_add'      => "Додати характеристику"
                ], [
                    'edit'   => 'inline',
                    'inline' => 'table'
                ])
            ->end()
            ->with("Нерухомість - Фотографії")
                ->add('estatePhoto', 'sonata_type_collection', [
                    'required'     => TRUE,
                    'label'        => "Управление изображениями",
                    'by_reference' => FALSE,
                    'btn_add'      => "Добавить изображение"
                ], [
                    'edit'   => 'inline',
                    'inline' => 'table'
                ])
            ->end()
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
        $geoCoder = $this->getConfigurationPool()->getContainer()->get('app.geo_coder');

        $coordinates = $geoCoder->getCoordinates($estate->getAddress());

        if( $coordinates )
            $estate->setCoordinates($coordinates);
    }

    public function getFormTheme()
    {
        return array_merge(
            parent::getFormTheme(),
            array('ApplicationSonataUserBundle:Admin/Form:form_admin_fields.html.twig')
        );
    }
}