<?php
// src/AppBundle/Entity/Utility/LayoutTypeListInterface.php
namespace AppBundle\Entity\Utility;

interface LayoutTypeListInterface
{
    const LAYOUT_TYPE_CABINETS   = "layout_type_cabinets";
    const LAYOUT_TYPE_OPEN_SPACE = "layout_type_open_space";

    static public function getLayoutTypes();
}
