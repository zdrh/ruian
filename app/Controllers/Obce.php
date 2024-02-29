<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\HTTP\RequestInterface;
use Psr\Log\LoggerInterface;

use App\Models\Obec;
use App\Models\Ulice;
use Config\Settings;
use App\Libraries\Ulice as UliceLib;


class Obce extends BaseController
{
    var $obec;
    var $ulice;
    var $config;
    var $uliceLib;
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);
        $this->obec = new Obec();
        $this->ulice = new Ulice();
        $this->config = new Settings();
        $this->uliceLib = new UliceLib();
    }

    public function index()
    {
        $data["obce"] = $this->obec->select('obec.nazev as nazevObce, okres.nazev as nazevOkresu, Count(*) as pocet')->join('cast_obce', 'cast_obce.obec=obec.kod')->join('ulice', 'cast_obce.kod=ulice.cast_obce', 'left')->join('adresni_misto', 'ulice.kod=adresni_misto.ulice', 'left')->join('okres', 'obec.okres=okres.kod', 'left')->groupBy('obec.kod')->orderBy('okres.nazev', 'asc')->orderBy('obec.nazev', 'asc')->findAll();
        echo view("index");
    }

    public function adresniMista()
    {
        $perPage = $this->config->perPage;
       
        $data["obce"] = $this->obec->select('obec.nazev as nazevObce, okres.nazev as nazevOkresu, Count(*) as pocet')->join('cast_obce', 'cast_obce.obec=obec.kod')->join('ulice', 'cast_obce.kod=ulice.cast_obce', 'left')->join('adresni_misto', 'ulice.kod=adresni_misto.ulice', 'left')->join('okres', 'obec.okres=okres.kod', 'left')->groupBy('obec.kod')->orderBy('pocet', 'desc')->paginate($perPage);
        $page = $this->obec->pager->getCurrentPage();
        $data["firstRecord"] = ($page-1)*$perPage + 1;
        $data["pager"] = $this->obec->pager;
        echo view("adresniMista", $data);
    }

    public function nazvyUlic()
    {
        $perPage = $this->config->perPage;
        $ulice2 = $this->ulice->select('ulice.nazev as nazevUlice, obec.nazev as nazevObce')->join('cast_obce', 'cast_obce.kod=ulice.cast_obce', 'inner')->join('obec', 'obec.kod=cast_obce.obec', 'inner')->orderBy('obec.nazev', 'asc')->findAll();
        $data["ulice"] = $this->ulice->select("nazev, Count(*) as pocet, kod")->where('virtualni', 0)->groupBy('nazev')->orderBy('pocet', 'desc')->paginate($perPage);
        $data["ulice2"] = $this->uliceLib->groupValues($ulice2, 'nazevUlice', 'nazevObce');
        $page = $this->ulice->pager->getCurrentPage();
        $data["firstRecord"] = ($page-1)*$perPage + 1;
        $data["pager"] = $this->ulice->pager;
        echo view("ulice", $data);
    }

    public function nejviceCasti() {
        $perPage = $this->config->perPage;
        $castObce2 = $this->obec->select('obec.kod as kodObce, cast_obce.nazev as nazevCasti')->join('cast_obce', 'cast_obce.obec=obec.kod', 'inner')->orderBy('nazevCasti', 'asc')->findAll();
        $data['castObce2'] = $this->uliceLib->groupValues($castObce2, 'kodObce', 'nazevCasti');
        $data['castObce'] = $this->obec->select('obec.nazev, obec.kod, Count(*) as pocet')->join('cast_obce', 'obec.kod=cast_obce.obec', 'inner')->groupBy('obec.kod')->orderBy('pocet', 'desc')->paginate($perPage);
        $data["pager"] = $this->obec->pager;
        $page = $this->obec->pager->getCurrentPage();
        $data["firstRecord"] = ($page-1)*$perPage + 1;
        echo view("castObce", $data);
    }
}
