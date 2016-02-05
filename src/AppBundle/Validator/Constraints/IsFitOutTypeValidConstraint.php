<?php
// src/AppBundle/Validator/Constraints/IsFitOutTypeValidConstraint.php
namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class IsFitOutTypeValidConstraint extends Constraint
{
    public $message = "proposal.commercial.fit_out_type.valid";

    public function validatedBy()
    {
        return 'is_fit_out_type_valid';
    }
}
