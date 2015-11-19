<?php
// src/AppBundle/Validator/Constraints/IsTypeValid.php
namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class IsTypeValid extends Constraint
{
    public $message = "proposal.type.valid";
}