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


namespace Peregrinus\Perikope\Controllers;

use Peregrinus\Cadre\AbstractController;

/**
 * Class AbstractPerikopeController
 * Extends Cadre's original AbstractController by setting a version constant
 * @package Peregrinus\Perikope\Controllers
 */
class AbstractPerikopeController extends AbstractController
{
    /**
     * AbstractPerikopeController constructor.
     * Sets version constant
     */
    public function initializeController()
    {
        parent::initializeController();
        $this->view->assign('perikope', ['version' => PERIKOPE_version]);
    }

}