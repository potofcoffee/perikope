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


namespace Peregrinus\Perikope\Domain\Repository;


class PericopeRepository extends AbstractRepository
{

    protected $recordObjectType = 'Peregrinus\\Perikope\\Domain\\Model\\Pericope';

    public function findOneByUid($uid) {
        return $this->findOneByQuery('SELECT * FROM lectionary WHERE uid= :uid;', [':uid' => $uid]);
    }


    /**
     * Insert a new record
     * @param \Peregrinus\Perikope\Domain\Model\Pericope $record Record
     */
    public function insert($record) {
        if ($this->query(
            'INSERT INTO lectionary (revision, section, day, reading, reference, range_start, range_end) VALUES (:revision, :section, :day, :reading, :reference, :range_start, :range_end);',
            [
                ':revision' => $record->getRevision(),
                ':section' => $record->getSection(),
                ':day' => $record->getDay(),
                ':reading' => $record->getReading(),
                ':reference' => $record->getReference(),
                ':range_start' => $record->getRangeStart(),
                ':range_end' => $record->getRangeEnd(),
            ])) {
            $newUid = $this->db->lastInsertId();
            return $this->findOneByUid($newUid);
        } else {
            return false;
        }
    }

    public function truncate($revision) {
        $this->query('DELETE FROM lectionary WHERE (revision=:revision)', [':revision' => $revision]);
    }

    public function findByReference($reference) {
        return $this->findByQuery('SELECT * FROM `lectionary` WHERE (range_start BETWEEN :start AND :end) OR (range_end BETWEEN :start AND :end) OR (:start BETWEEN range_start AND range_end) OR (:end BETWEEN range_start AND range_end) ORDER BY range_start, range_end',
            [':start' => $reference['start'], ':end' => $reference['end']]);

    }
}