<?php
// src/AppBundle/Entity/Utility/FitOutTypeListInterface.php
namespace AppBundle\Entity\Utility;

interface FitOutTypeListInterface
{
    const FIT_OUT_TYPE_SHELL_AND_CORE = "fit_out_type_shell_and_core";
    const FIT_OUT_TYPE_AFTER_TENANT   = "fit_out_type_after_tenant";
    const FIT_OUT_TYPE_RENOVATED      = "fit_out_type_renovated";

    static public function getFitOutTypes();
}
