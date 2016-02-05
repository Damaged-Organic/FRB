<?php
// src/AppBundle/Validator/Constraints/IsLayoutTypeValidConstraint.php
namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class IsLayoutTypeValidConstraint extends Constraint
{
    public $message = "proposal.commercial.layout_type.valid";

    public function validatedBy()
    {
        return 'is_layout_type_valid';
    }
}
