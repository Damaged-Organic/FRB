<?php
// src/AppBundle/Validator/Constraints/IsFitOutTypeValidConstraintValidator.php
namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint,
    Symfony\Component\Validator\ConstraintValidator;

use AppBundle\Entity\Estate;

class IsFitOutTypeValidConstraintValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if( !in_array($value, Estate::getFitOutTypes()) ) {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
    }
}
