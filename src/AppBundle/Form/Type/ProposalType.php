<?php
// src/AppBundle/Form/Type/ProposalType.php
namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType,
    Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Doctrine\ORM\EntityManager;

use AppBundle\Entity\Estate;

class ProposalType extends AbstractType
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
                'label' => "proposal.name.label",
                'attr'  => [
                    'placeholder' => "proposal.name.placeholder"
                ]
            ])
            ->add("phone", 'text', [
                'label' => "proposal.phone.label",
                'attr'  => [
                    'placeholder' => "proposal.phone.placeholder"
                ]
            ])
            ->add("email", 'email', [
                'label' => "proposal.email.label",
                'attr'  => [
                    'placeholder' => "proposal.email.placeholder"
                ]
            ])
            ->add("type", 'choice', [
                'label'       => "proposal.type.label",
                'attr'  => [
                    'placeholder' => "proposal.type.placeholder"
                ],
                'choices'     => $propertyTypeChoices,
                'expanded'    => TRUE,
                'multiple'    => FALSE,
                'invalid_message' => "proposal.type.valid",
            ])
            ->add("tradeType", 'choice', [
                'label'       => "proposal.trade_type.label",
                'attr'  => [
                    'placeholder' => "proposal.trade_type.placeholder"
                ],
                'choices'     => $propertyTradeTypeChoices,
                'expanded'    => TRUE,
                'multiple'    => FALSE,
                'invalid_message' => "proposal.trade_type.valid",
            ])
            ->add("priceCurrency", 'choice', [
                'label'   => "proposal.price_currency.label",
                'attr'  => [
                    'placeholder' => "proposal.price_currency.placeholder"
                ],
                'choices'  => ['UAH' => "UAH", 'USD' => "USD"],
                'expanded' => TRUE,
                'multiple' => FALSE,
                'invalid_message' => "proposal.price_currency.valid",
            ])
            ->add("priceRentValue", 'number', [
                'required' => FALSE,
                'label'    => "proposal.price_rent_value.label",
                'attr'     => [
                    'placeholder' => "proposal.price_rent_value.placeholder"
                ],
                'precision' => 2
            ])
            ->add("priceSaleValue", 'number', [
                'required' => FALSE,
                'label'    => "proposal.price_sale_value.label",
                'attr'     => [
                    'placeholder' => "proposal.price_sale_value.placeholder"
                ],
                'precision' => 2
            ])
            ->add("street", "text", [
                'label' => "proposal.street.label",
                'attr'  => [
                    'placeholder' => "proposal.street.placeholder"
                ]
            ])
            ->add("house", "text", [
                'label' => "proposal.house.label",
                'attr'  => [
                    'placeholder' => "proposal.house.placeholder"
                ]
            ])
            ->add("space", "number", [
                'label'     => "proposal.space.label",
                'attr'  => [
                    'placeholder' => "proposal.space.placeholder"
                ],
                'precision' => 2
            ])
            ->add("spacePlot", "number", [
                'required' => FALSE,
                'label'    => "proposal.space_plot.label",
                'attr' => [
                    'placeholder' => "proposal.space_plot.placeholder"
                ],
                'precision' => 2
            ])
            ->add("roomsNumber", "number", [
                'label'   => "proposal.rooms_number.label",
                'attr'  => [
                    'placeholder' => "proposal.rooms_number.placeholder"
                ]
            ])
            ->add("bathroomsNumber", "number", [
                'label'   => "proposal.bathrooms_number.label",
                'attr'  => [
                    'placeholder' => "proposal.bathrooms_number.placeholder"
                ]
            ])
            ->add("bedroomsNumber", "number", [
                'required' => FALSE,
                'label'    => "proposal.bedrooms_number.label",
                'attr'  => [
                    'placeholder' => "proposal.bedrooms_number.placeholder"
                ]
            ])
            ->add("floor", "number", [
                'required' => FALSE,
                'label'    => "proposal.floor.label",
                'attr'  => [
                    'placeholder' => "proposal.floor.placeholder"
                ]
            ])
            ->add("floorsNumber", "number", [
                'required' => FALSE,
                'label'    => "proposal.floors_number.label",
                'attr'  => [
                    'placeholder' => "proposal.floors_number.placeholder"
                ]
            ])
            ->add("isCashless", "checkbox", [
                'required' => FALSE,
                'label'    => "proposal.is_cashless.label"
            ])
            ->add("isNewBuilding", "checkbox", [
                'required' => FALSE,
                'label'    => "proposal.is_new_building.label"
            ])
            ->add("hasElevator", "checkbox", [
                'required' => FALSE,
                'label'    => "proposal.has_elevator.label"
            ])
            ->add("hasParking", "checkbox", [
                'required' => FALSE,
                'label'    => "proposal.has_parking.label"
            ])
            ->add("hasFurniture", "checkbox", [
                'required' => FALSE,
                'label'    => "proposal.has_furniture.label"
            ])
            ->add("hasRegistration", "checkbox", [
                'required' => FALSE,
                'label'    => "proposal.has_registration.label"
            ])
            ->add("description", "textarea", [
                'required' => FALSE,
                'label'    => "proposal.description.label"
            ])
            ->add("wasted", "checkbox", [
                'label' => "proposal.wasted.label"
            ])
            ->add("send", 'submit', [
                'label' => "proposal.submit.label"
            ])
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class'         => 'AppBundle\Model\Proposal',
            'translation_domain' => 'forms'
        ]);
    }

    public function getName()
    {
        return "proposal_type";
    }
}
