<?php

namespace App\Libraries;

use stdClass;

class Ulice
{
    function __construct()
    {
    }

    /**
     * dostane pole obejktů a podle porměnné $groupedValue to má seskupit, aby se všechny hodnoty pro jednu groupedValue zobrazovaly spolu
     * 
     * return: dvourozměrné pole, kde v prvním rozměru je $groupedValue a v druhém jednotlivé displayedValues pro danou groupedValue
     */
    function groupValues($pole, $groupingValue, $displayedValue)
    {
        $result = array();
        foreach ($pole as $row) {
            $grouped = $row->$groupingValue;
            $displayed = $row->$displayedValue;
            $result[$grouped][] = $displayed;
        }
        return $result;
    }
}
