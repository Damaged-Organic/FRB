<?php
// src/AppBundle/Form/Type/ProposalCommercialType.php
namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType,
    Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Doctrine\ORM\EntityManager;

use AppBundle\Entity\Estate;

class ProposalCommercialType extends AbstractType
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

        $propertyTypes = $this->_entityManager->getRepository("AppBundle:EstateType")->findSpecificType(2);

        foreach($propertyTypes as $propertyType) {
            $propertyTypeChoices[$propertyType['stringId']] = $propertyType['title'];
        }

        foreach(Estate::getTradeTypes() as $tradeType) {
            $propertyTradeTypeChoices[$tradeType] = mb_convert_case($this->_translator->trans('state.catalog.trade_type_' . $tradeType), MB_CASE_TITLE, "UTF-8");
        }

        foreach(Estate::getFitOutTypes() as $fitOutType) {
            $propertyFitOutTypeChoices[$fitOutType] = mb_convert_case($this->_translator->trans('state.catalog.fit_out_type_' . $fitOutType), MB_CASE_TITLE, "UTF-8");
        }

        foreach(Estate::getLayoutTypes() as $layoutType) {
            $propertyLayoutTypeChoices[$layoutType] = mb_convert_case($this->_translator->trans('state.catalog.layout_type_' . $layoutType), MB_CASE_TITLE, "UTF-8");
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
            ->add("city", "text", [
                'label' => "proposal.common.city.label",
                'attr'  => [
                    'placeholder' => "proposal.common.city.placeholder"
                ]
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
            ->add("space", "text", [
                'label'     => "proposal.common.space.label",
                'attr'  => [
                    'placeholder' => "proposal.common.space.placeholder"
                ]
            ])
            ->add("fitOutType", 'choice', [
                'label'       => "proposal.commercial.fit_out_type.label",
                'attr'  => [
                    'placeholder' => "proposal.commercial.fit_out_type.placeholder"
                ],
                'choices'     => $propertyFitOutTypeChoices,
                'expanded'    => TRUE,
                'multiple'    => FALSE,
                'invalid_message' => "proposal.commercial.fit_out_type.valid",
            ])
            ->add("layoutType", 'choice', [
                'label'       => "proposal.commercial.layout_type.label",
                'attr'  => [
                    'placeholder' => "proposal.commercial.layout_type.placeholder"
                ],
                'choices'     => $propertyLayoutTypeChoices,
                'expanded'    => TRUE,
                'multiple'    => FALSE,
                'invalid_message' => "proposal.commercial.layout_type.valid",
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
                'label'    => "proposal.commercial.price_rent_value.label",
                'attr'     => [
                    'placeholder' => "proposal.commercial.price_rent_value.placeholder"
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
            ->add("operatingExpenseValue", 'number', [
                'required' => FALSE,
                'label'    => "proposal.commercial.operating_expense_value.label",
                'attr'     => [
                    'placeholder' => "proposal.commercial.operating_expense_value.placeholder"
                ],
                'precision' => 2
            ])
            ->add("parkingBayNumber", "number", [
                'required' => FALSE,
                'label'    => "proposal.commercial.parking_bay_number.label",
                'attr'  => [
                    'placeholder' => "proposal.commercial.parking_bay_number.placeholder"
                ]
            ])
            ->add("parkingBayPriceValue", 'number', [
                'required' => FALSE,
                'label'    => "proposal.commercial.parking_bay_price_value.label",
                'attr'     => [
                    'placeholder' => "proposal.commercial.parking_bay_price_value.placeholder"
                ],
                'precision' => 2
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
            'data_class'         => 'AppBundle\Model\ProposalCommercial',
            'translation_domain' => 'forms'
        ]);
    }

    public function getName()
    {
        return "proposal_commercial_type";
    }
}
