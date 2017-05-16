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

use Peregrinus\Perikope\BibleHelper\Parser;
use Peregrinus\Perikope\Domain\Model\Pericope;
use Peregrinus\Perikope\Domain\Repository\PericopeRepository;

class ReferenceController extends AbstractPerikopeController
{

    private $pericopeRepository = null;

    public function __construct()
    {
        parent::__construct();
        $this->pericopeRepository = new PericopeRepository();
        $this->setDefaultAction('index');
    }

    public function indexAction()
    {

    }

    public function searchAction()
    {

        if (!$this->request->hasArgument('reference')) $this->forward('index');
        $reference = $this->request->getArgument('reference');

        $parsedReference = Parser::parse($reference);
        $results = $this->pericopeRepository->findByReference($parsedReference[0]);

        $this->view->assign('search', $reference);
        $this->view->assign('reference', $parsedReference);
        $this->view->assign('results', $results);
    }


}