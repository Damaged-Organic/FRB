<?php
// src/AppBundle/Validator/Constraints/IsPhoneConstraint.php
namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class IsPhoneConstraint extends Constraint
{
    public $message = "common.phone.valid";
}