<?php
// src/AppBundle/Validator/Constraints/IsTypeResidentialValidConstraint.php
namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class IsTypeResidentialValidConstraint extends Constraint
{
    public $message = "proposal.common.type.valid";

    public function validatedBy()
    {
        return 'is_type_residential_valid';
    }
}
