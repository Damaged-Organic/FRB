<?php
// src/AppBundle/Validator/Constraints/IsLayoutTypeValidConstraintValidator.php
namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint,
    Symfony\Component\Validator\ConstraintValidator;

use AppBundle\Entity\Estate;

class IsLayoutTypeValidConstraintValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if( !in_array($value, Estate::getLayoutTypes()) ) {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
    }
}
