<?php
// src/AppBundle/Validator/Constraints/IsTradeTypeValidConstraintValidator.php
namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint,
    Symfony\Component\Validator\ConstraintValidator;

use AppBundle\Entity\Estate;

class IsTradeTypeValidConstraintValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if( !in_array($value, Estate::getTradeTypes()) ) {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
    }
}
