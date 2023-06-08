<?php

switch ($category){
    case 1:
        $cat="Ministry";
        $min_id=$wp_id;
        $getM=$db->getMinistryById($min_id);
        $rwM=$getM->fetch();
        $wpname=$rwM['name'];
        break;
    case 2:
        $cat="Council";
        $District_id=$wp_id;
        $getcouncil=$db->getOnlyDistrictByID($District_id);
        $rwR=$getcouncil->fetch();
        $wpname=$rwR['DistrictName'];
        break;
    case 3:
        $cat="RAS";
        $ras_id=$wp_id;
        $getRas=$db->getRASNameById($ras_id);
        $rwR=$getRas->fetch();
        $wpname=$rwR['rasName'];
        break;
    case 4:
        $cat="Agencies";
        $facId=$wp_id;
        $getfac=$db->getOnlyFacilityById($facId);
        $rwR=$getfac->fetch();
        $wpname=$rwR['facname'];
        break;
    case 5:
        $cat="RRH";
        $rrh_id=$wp_id;
        $getfac=$db->getRRHNameById($rrh_id);
        $rwR=$getfac->fetch();
        $wpname=$rwR['rrhName'];
        break;
}
