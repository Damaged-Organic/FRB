<?php
// src/AppBundle/Validator/Constraints/IsTradeTypeValidConstraint.php
namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class IsTradeTypeValidConstraint extends Constraint
{
    public $message = "proposal.common.trade_type.valid";

    public function validatedBy()
    {
        return 'is_trade_type_valid';
    }
}
