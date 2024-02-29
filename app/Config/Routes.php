<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Obce::index');
$routes->get('ziskej-obce', 'Parser::getObce');
$routes->get('adresni-mista', 'Obce::adresniMista');
$routes->get('nejcastejsi-ulice', 'Obce::nazvyUlic');
$routes->get('nejvice-casti', 'Obce::nejviceCasti');
