<?php
// src/AppBundle/Form/Type/ProposalType.php
namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType,
    Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Doctrine\ORM\EntityManager;

class ProposalType extends AbstractType
{
    protected $_entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->_entityManager = $entityManager;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $propertyTypeChoices = [];

        $propertyTypes = $this->_entityManager->getRepository("AppBundle:EstateType")->findSpecificType(1);

        foreach($propertyTypes as $propertyType) {
            $propertyTypeChoices[$propertyType['stringId']] = $propertyType['title'];
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
                'placeholder' => "...",
                'choices'     => $propertyTypeChoices
            ])
            ->add("priceValue", 'number', [
                'label'     => "proposal.price_value.label",
                'attr'  => [
                    'placeholder' => "proposal.price_value.placeholder"
                ],
                'precision' => 2
            ])
            ->add("priceCurrency", 'choice', [
                'label'   => "proposal.price_currency.label",
                'attr'  => [
                    'placeholder' => "proposal.price_currency.placeholder"
                ],
                'choices' => ["UAH", "USD"]
            ])
            ->add("address", "text", [
                'label'   => "proposal.address.label",
                'attr'  => [
                    'placeholder' => "proposal.address.placeholder"
                ]
            ])
            ->add("space", "number", [
                'label'     => "proposal.space.label",
                'attr'  => [
                    'placeholder' => "proposal.space.placeholder"
                ],
                'precision' => 2
            ])
            ->add("floor", "integer", [
                'label'   => "proposal.floor.label",
                'attr'  => [
                    'placeholder' => "proposal.floor.placeholder"
                ]
            ])
            ->add("floorsNumber", "integer", [
                'label'   => "proposal.floors_number.label",
                'attr'  => [
                    'placeholder' => "proposal.floors_number.placeholder"
                ]
            ])
            ->add("roomsNumber", "integer", [
                'label'   => "proposal.rooms_number.label",
                'attr'  => [
                    'placeholder' => "proposal.rooms_number.placeholder"
                ]
            ])
            ->add("bathroomsNumber", "integer", [
                'label'   => "proposal.bathrooms_number.label",
                'attr'  => [
                    'placeholder' => "proposal.bathrooms_number.placeholder"
                ]
            ])
            ->add("isCashless", "checkbox", [
                'label'   => "proposal.is_cashless.label"
            ])
            ->add("isNewBuilding", "checkbox", [
                'label'   => "proposal.is_new_building.label"
            ])
            ->add("hasElevator", "checkbox", [
                'label'   => "proposal.has_elevator.label"
            ])
            ->add("hasParking", "checkbox", [
                'label'   => "proposal.has_parking.label"
            ])
            ->add("hasFurniture", "checkbox", [
                'label'   => "proposal.has_furniture.label"
            ])
            ->add("hasRegistration", "checkbox", [
                'label'   => "proposal.has_registration.label"
            ])
            ->add("send", 'submit', [
                'label' => "proposal.submit.label"
            ]);
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