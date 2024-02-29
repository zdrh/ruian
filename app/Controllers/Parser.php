<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

use App\Models\Obec;
use App\Libraries\Obce;


class Parser extends BaseController
{
    var $obecMod;
    var $obecLib;
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        $this->obecMod = new Obec();
        $this->obecLib = new Obce();
    }
    public function getObce()
    {
        //získám nejdřív všechny obce ze Zlínského kraje
        $obce = $this->obecMod->select('obec.nazev as nazevObce, obec.kod as kodObce, okres.nazev as nazevOkresu, kraj.nazev as nazevKraje')->join('okres', 'obec.okres=okres.kod', 'inner')->join('kraj', 'okres.kraj=kraj.kod', 'inner')->where('kraj.kod', 141)->orderBy('okres.kod', 'asc')->orderBy('obec.nazev', 'asc')->findAll(200,200);
        $this->obecLib->zpracujObce($obce);
        
    }
}
