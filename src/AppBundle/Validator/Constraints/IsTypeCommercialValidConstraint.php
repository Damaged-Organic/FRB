<?php
// src/AppBundle/Validator/Constraints/IsTypeCommercialValidConstraint.php
namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class IsTypeCommercialValidConstraint extends Constraint
{
    public $message = "proposal.common.type.valid";

    public function validatedBy()
    {
        return 'is_type_commercial_valid';
    }
}
