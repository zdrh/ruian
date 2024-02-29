<?php

namespace App\Libraries;

use Config\Settings;
use App\Models\AdresniMisto;
use App\Models\CastObce;
use App\Models\Ulice;



class Obce
{
    var $config;
    var $adresniMisto;
    var $castObce;
    var $ulice;

    function __construct()
    {
        $this->config = new Settings();
        $this->adresniMisto = new AdresniMisto();
        $this->castObce = new CastObce();
        $this->ulice = new Ulice();
    }

    function zpracujObce($seznamObci)
    {
        foreach ($seznamObci as $key => $obec) {

            $this->getAdresniMista($obec->kodObce);
        }
    }


    function getAdresniMista($kodObce)
    {
        $cesta = $this->config->obce;
        $fileName = "20240131_OB_" . $kodObce . "_ADR.csv";
        $file = file_get_contents(base_url($cesta . $fileName));
        $utf8String = iconv('CP1250', 'UTF-8', $file);
        //$utf8String = mb_convert_encoding($file, 'UTF-8', 'UTF-8');
        $rozdeleno = preg_split("/\\r\\n|\\r|\\n/", $utf8String);
        $pocet = Count($rozdeleno);
        unset($rozdeleno[$pocet - 1]);

        foreach ($rozdeleno as $key => $adrMisto) {
            if ($key > 0) {
                $this->zpracujAdresniMisto($adrMisto);
            }
        }
    }
    /**
     * vrací 1, když část obce existuje, 0 když neexistuje
     */
    function getCastObce($kod)
    {
        $return = 1;
        $result = $this->castObce->find($kod);

        if (is_null($result)) {
            $return = 0;
        }

        return $return;
    }

    function getUlice($kod)
    {
        $return = 1;
        $result = $this->ulice->find($kod);
        if (is_null($result)) {
            $return = 0;
        }

        return $return;
    }

    function zpracujAdresniMisto($adrMistoString)
    {
        $data = explode(";", $adrMistoString);


        foreach ($data as $key => $row) {
            switch ($key) {
                case 0:
                    $kodAdrMisto = $row;
                    break;
                case 1:
                    $kodObce = $row;
                    break;
                case 7:
                    $kodCastiObce = $row;
                    break;
                case 8:
                    $nazevCastiObce = $row;
                    break;
                case 9:
                    $kodUlice = $row;
                    break;
                case 10:
                    $nazevUlice = $row;
                    break;
                case 11:
                    $typSO = $row;
                    break;
                case 12:
                    $cisloDomovni = $row;
                    break;
                case 13:
                    $cisloOrientacni = $row;
                    break;
                case 15:
                    $psc = $row;
                    break;
                case 16:
                    $souradniceY = $row;
                    break;
                case 17:
                    $souradniceX = $row;
                    break;
                default:
                    break;
            }
        }
        $virtualniCastObce = 0;
        if ($kodCastiObce == "") {
            $kodCastiObce = $kodObce;
            $virtualniCastObce = 1;
        }
        $castObceInDb = $this->getCastObce($kodCastiObce);

        if (!$castObceInDb) {
            $dataCastObce = array(
                'kod' => $kodCastiObce,
                'nazev' => $nazevCastiObce,
                'obec' => $kodObce,
                'virtualni' => $virtualniCastObce
            );
            $resultCastObce = $this->castObce->insert($dataCastObce);
            var_dump($resultCastObce);
        }
        $virtualniUlice = 0;
        if ($kodUlice == "") {
            $kodUlice = $kodCastiObce;
            $virtualniUlice = 1;
        }
        $uliceInDb = $this->getUlice($kodUlice);
        if (!$uliceInDb) {
            $dataUlice = array(
                'kod' => $kodUlice,
                'nazev' => $nazevUlice,
                'cast_obce' => $kodCastiObce,
                'virtualni' => $virtualniUlice
            );
            $resultUlice = $this->ulice->insert($dataUlice);
            var_dump($resultUlice);
        }





        if ($typSO == "č.p.") {
            $so = 1;
        } else {
            $so = 2;
        }

        $dataAdrMisto = array(
            'kod' => $kodAdrMisto,
            'ulice' => $kodUlice,
            'typ_so' => $so,
            'cislo_domovni' => $cisloDomovni,
            'cislo_orientacni' => $cisloOrientacni,
            'psc' => $psc,
            'souradnice_x' => $souradniceX,
            'souradnice_y' => $souradniceY
        );
        $resultAdrMisto = $this->adresniMisto->insert($dataAdrMisto);



        var_dump($resultAdrMisto);


        echo "<hr>";
    }
}
