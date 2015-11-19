<?php
// src/AppBundle/Entity/Utility/DistrictsListInterface.php
namespace AppBundle\Entity\Utility;

interface DistrictsListInterface
{
    const DISTRICT_HO = "district_ho";
    const DISTRICT_DA = "district_da";
    const DISTRICT_DE = "district_de";
    const DISTRICT_DN = "district_dn";
    const DISTRICT_OB = "district_ob";
    const DISTRICT_PE = "district_pe";
    const DISTRICT_PO = "district_po";
    const DISTRICT_SV = "district_sv";
    const DISTRICT_SO = "district_so";
    const DISTRICT_SH = "district_sh";
    const DISTRICT_KO = "district_ko";

    const DISTRICT_OTHER = "district_other";

    static public function getDistricts();
}