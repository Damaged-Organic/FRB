<?php
// src/AppBundle/Form/Type/ProposalResidentialType.php
namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType,
    Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Doctrine\ORM\EntityManager;

use AppBundle\Entity\Estate;

class ProposalResidentialType extends AbstractType
{
    protected $_entityManager;
    protected $_translator;

    public function __construct(EntityManager $entityManager, $translator)
    {
        $this->_entityManager = $entityManager;
        $this->_translator    = $translator;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $propertyTypeChoices = [];

        $propertyTypes = $this->_entityManager->getRepository("AppBundle:EstateType")->findSpecificType(1);

        foreach($propertyTypes as $propertyType) {
            $propertyTypeChoices[$propertyType['stringId']] = $propertyType['title'];
        }

        foreach(Estate::getTradeTypes() as $tradeType) {
            $propertyTradeTypeChoices[$tradeType] = mb_convert_case($this->_translator->trans('state.catalog.trade_type_' . $tradeType), MB_CASE_TITLE, "UTF-8");
        }

        $builder
            ->add("name", 'text', [
                'label' => "proposal.common.name.label",
                'attr'  => [
                    'placeholder' => "proposal.common.name.placeholder"
                ]
            ])
            ->add("phone", 'text', [
                'label' => "proposal.common.phone.label",
                'attr'  => [
                    'placeholder' => "proposal.common.phone.placeholder"
                ]
            ])
            ->add("email", 'email', [
                'label' => "proposal.common.email.label",
                'attr'  => [
                    'placeholder' => "proposal.common.email.placeholder"
                ]
            ])
            ->add("type", 'choice', [
                'label'       => "proposal.common.type.label",
                'attr'  => [
                    'placeholder' => "proposal.common.type.placeholder"
                ],
                'choices'     => $propertyTypeChoices,
                'expanded'    => TRUE,
                'multiple'    => FALSE,
                'invalid_message' => "proposal.common.type.valid",
            ])
            ->add("tradeType", 'choice', [
                'label'       => "proposal.common.trade_type.label",
                'attr'  => [
                    'placeholder' => "proposal.common.trade_type.placeholder"
                ],
                'choices'     => $propertyTradeTypeChoices,
                'expanded'    => TRUE,
                'multiple'    => FALSE,
                'invalid_message' => "proposal.common.trade_type.valid",
            ])
            ->add("priceCurrency", 'choice', [
                'label'   => "proposal.common.price_currency.label",
                'attr'  => [
                    'placeholder' => "proposal.common.price_currency.placeholder"
                ],
                'choices'  => ['UAH' => "UAH", 'USD' => "USD"],
                'expanded' => TRUE,
                'multiple' => FALSE,
                'invalid_message' => "proposal.common.price_currency.valid",
            ])
            ->add("priceRentValue", 'number', [
                'required' => FALSE,
                'label'    => "proposal.residential.price_rent_value.label",
                'attr'     => [
                    'placeholder' => "proposal.residential.price_rent_value.placeholder"
                ],
                'precision' => 2
            ])
            ->add("priceSaleValue", 'number', [
                'required' => FALSE,
                'label'    => "proposal.common.price_sale_value.label",
                'attr'     => [
                    'placeholder' => "proposal.common.price_sale_value.placeholder"
                ],
                'precision' => 2
            ])
            ->add("street", "text", [
                'label' => "proposal.common.street.label",
                'attr'  => [
                    'placeholder' => "proposal.common.street.placeholder"
                ]
            ])
            ->add("house", "text", [
                'label' => "proposal.common.house.label",
                'attr'  => [
                    'placeholder' => "proposal.common.house.placeholder"
                ]
            ])
            ->add("space", "number", [
                'label'     => "proposal.common.space.label",
                'attr'  => [
                    'placeholder' => "proposal.common.space.placeholder"
                ],
                'precision' => 2
            ])
            ->add("spacePlot", "number", [
                'required' => FALSE,
                'label'    => "proposal.residential.space_plot.label",
                'attr' => [
                    'placeholder' => "proposal.residential.space_plot.placeholder"
                ],
                'precision' => 2
            ])
            ->add("roomsNumber", "number", [
                'label'   => "proposal.residential.rooms_number.label",
                'attr'  => [
                    'placeholder' => "proposal.residential.rooms_number.placeholder"
                ]
            ])
            ->add("bathroomsNumber", "number", [
                'label'   => "proposal.residential.bathrooms_number.label",
                'attr'  => [
                    'placeholder' => "proposal.residential.bathrooms_number.placeholder"
                ]
            ])
            ->add("bedroomsNumber", "number", [
                'required' => FALSE,
                'label'    => "proposal.residential.bedrooms_number.label",
                'attr'  => [
                    'placeholder' => "proposal.residential.bedrooms_number.placeholder"
                ]
            ])
            ->add("floor", "number", [
                'required' => FALSE,
                'label'    => "proposal.residential.floor.label",
                'attr'  => [
                    'placeholder' => "proposal.residential.floor.placeholder"
                ]
            ])
            ->add("floorsNumber", "number", [
                'required' => FALSE,
                'label'    => "proposal.residential.floors_number.label",
                'attr'  => [
                    'placeholder' => "proposal.residential.floors_number.placeholder"
                ]
            ])
            ->add("isCashless", "checkbox", [
                'required' => FALSE,
                'label'    => "proposal.residential.is_cashless.label"
            ])
            ->add("isNewBuilding", "checkbox", [
                'required' => FALSE,
                'label'    => "proposal.residential.is_new_building.label"
            ])
            ->add("hasElevator", "checkbox", [
                'required' => FALSE,
                'label'    => "proposal.residential.has_elevator.label"
            ])
            ->add("hasParking", "checkbox", [
                'required' => FALSE,
                'label'    => "proposal.residential.has_parking.label"
            ])
            ->add("hasFurniture", "checkbox", [
                'required' => FALSE,
                'label'    => "proposal.residential.has_furniture.label"
            ])
            ->add("hasRegistration", "checkbox", [
                'required' => FALSE,
                'label'    => "proposal.residential.has_registration.label"
            ])
            ->add("description", "textarea", [
                'required' => FALSE,
                'label'    => "proposal.common.description.label"
            ])
            ->add("wasted", "checkbox", [
                'label' => "proposal.common.wasted.label"
            ])
            ->add("send", 'submit', [
                'label' => "proposal.common.submit.label"
            ])
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class'         => 'AppBundle\Model\ProposalResidential',
            'translation_domain' => 'forms'
        ]);
    }

    public function getName()
    {
        return "proposal_residential_type";
    }
}
