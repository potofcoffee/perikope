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


namespace Peregrinus\Perikope\Domain\Model;


class Pericope
{

    protected $uid;
    protected $revision;
    protected $section;
    protected $day;
    protected $reading;
    protected $reference;
    protected $rangeStart;
    protected $rangeEnd;

    /**
     * @return mixed
     */
    public function getUid()
    {
        return $this->uid;
    }

    /**
     * @param mixed $uid
     */
    public function setUid($uid)
    {
        $this->uid = $uid;
    }

    /**
     * @return mixed
     */
    public function getRevision()
    {
        return $this->revision;
    }

    /**
     * @param mixed $revision
     */
    public function setRevision($revision)
    {
        $this->revision = $revision;
    }

    
    /**
     * @return mixed
     */
    public function getSection()
    {
        return $this->section;
    }

    /**
     * @param mixed $section
     */
    public function setSection($section)
    {
        $this->section = $section;
    }

    /**
     * @return mixed
     */
    public function getDay()
    {
        return $this->day;
    }

    /**
     * @param mixed $day
     */
    public function setDay($day)
    {
        $this->day = $day;
    }

    /**
     * @return mixed
     */
    public function getReading()
    {
        return $this->reading;
    }

    /**
     * @param mixed $reading
     */
    public function setReading($reading)
    {
        $this->reading = $reading;
    }

    /**
     * @return mixed
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * @param mixed $reference
     */
    public function setReference($reference)
    {
        $this->reference = $reference;
    }

    /**
     * @return mixed
     */
    public function getRangeStart()
    {
        return $this->rangeStart;
    }

    /**
     * @param mixed $rangeStart
     */
    public function setRangeStart($rangeStart)
    {
        $this->rangeStart = $rangeStart;
    }

    /**
     * @return mixed
     */
    public function getRangeEnd()
    {
        return $this->rangeEnd;
    }

    /**
     * @param mixed $rangeEnd
     */
    public function setRangeEnd($rangeEnd)
    {
        $this->rangeEnd = $rangeEnd;
    }


}