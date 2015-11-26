<?php
// src/AppBundle/Validator/Constraints/IsTypeValidConstraint.php
namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class IsTypeValidConstraint extends Constraint
{
    public $message = "proposal.type.valid";
}