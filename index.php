<?php
/*
 * perikope
 *
 * Copyright (c) 2017 Christoph Fischer, chris@toph.de 
 * http://christoph-fischer.org
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

require_once ('vendor/autoload.php');

define('CADRE_debug', true);

\Peregrinus\Cadre\Framework::setConstants(
    'Perikope',
    [
        'version' => '1.0.0',
        'basePath' => __DIR__,
        'namespace' => 'Peregrinus\\Perikope\\'
    ]
);
\Peregrinus\Cadre\Logger::initialize();

// get some global config
$configurationManager = \Peregrinus\Cadre\ConfigurationManager::getInstance();
$config = $configurationManager->getConfigurationSet(CADRE_app);

// set locale?
if (isset($config['locale'])) setlocale (LC_ALL, $config['locale']);


// get a router and process request
$router = \Peregrinus\Cadre\Router::getInstance();
$router->setDefaultController('reference');
$router->dispatch();

