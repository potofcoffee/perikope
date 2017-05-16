<?php
/*
 * dewey
 *
 * Copyright (c) 2017 Volksmission Freudenstadt, http://www.volksmission-freudenstadt.de
 * Author: Christoph Fischer, chris@toph.de
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


class AbstractRepository
{

    protected $config = [];
    protected $db = NULL;
    protected $recordObjectType = '';
    protected $identifier = 'uid';

    /**
     * AbstractRepository constructor.
     */
    public function __construct()
    {
        $tmp = explode('\\', get_class($this));
        $myKey = str_replace('Repository', '', $tmp[count($tmp) - 1]);
        $this->config = \Peregrinus\Cadre\ConfigurationManager::getInstance()->getConfigurationSet('Database');
        foreach (['host', 'user', 'pass', 'name', 'init'] as $key) {
            $this->config[$key] = isset($this->config[$myKey][$key]) ? $this->config[$myKey][$key] : $this->config['default'][$key];
        }
        $this->db = new \PDO('mysql:host=' . $this->config['host'] . ';dbname=' . $this->config['name'], $this->config['user'], $this->config['pass']);
        if (isset($this->config['init'])) $this->db->query($this->config['init']);
    }

    public function persist($record)
    {
        $idGetter = 'get' . ucfirst($this->identifier);
        if ($record->$idGetter()) {
            $this->update($record);
        } else {
            $this->insert($record);
        }
    }

    public function update($record)
    {
    }

    public function insert($record)
    {
    }

    public function delete($record)
    {
    }

    /**
     * Find records by arbitrary sql query
     * @param string $statement Sql statement
     * @param array <string> $arguments Array of arguments
     * @param string $objectType Object Type for records (if left blank, records are returned as array)
     * @return array<DeweyRecord>
     */
    protected function findOneByQuery($statement, $arguments, $objectType = '')
    {
        $tmp = $this->findByQuery($statement, $arguments, $objectType);
        if (is_array($tmp) && isset($tmp[0])) {
            return $tmp[0];
        } else return $tmp;
    }

    /**
     * Find records by arbitrary sql query
     * @param string $statement Sql statement
     * @param array <string> $arguments Array of arguments
     * @param string $objectType Object Type for records (if left blank, records are returned as array)
     * @return array<DeweyRecord>
     */
    protected function findByQuery($statement, $arguments, $objectType = '')
    {
        if ((!is_null($objectType)) && ($this->recordObjectType !== '')) $objectType = $this->recordObjectType;
        $queryResult = $this->query($statement, $arguments);
        $records = [];
        if ($queryResult) {
            while ($row = $queryResult->fetch()) {
                if ($objectType !== '') {
                    $records[] = $this->mapToObject(new $objectType(), $row, ['no' => 'classification']);
                } else {
                    $records[] = $row;
                }
            }
        }
        return $records;
    }

    /**
     * Execute a query
     * @param string $statement SQL statement
     * @param array <string> $arguments Arguments as key => value array
     * @return bool|\PDOStatement Result
     * @throws \Exception
     */
    protected function query($statement, $arguments)
    {
        $prepStatement = $this->db->prepare($statement);
        $prepStatement->execute($arguments);
        return $prepStatement;
    }

    /**
     * Simple helper function to map row values to object properties
     * @param $object A domain object
     * @param $row A row array with corresponding fields
     * @param array $translation An array to allow for changing field names
     * @return mixed Domain object
     */
    public function mapToObject($object, $row, $translation = [])
    {
        foreach ($row as $key => $val) {
            if (isset($translation[$key])) $key = $translation[$key];
            $setter = 'set' . $this->underlineToCamelCase($key, true);
            if (method_exists($object, $setter)) {
                $object->$setter($val);
            }
        }
        return $object;
    }

    protected function underlineToCamelCase($string, $capitalizeFirstCharacter = false)
    {
        $str = $str = str_replace('_', '', ucwords($string, '_'));

        if (!$capitalizeFirstCharacter) {
            $str = lcfirst($str);
        }

        return $str;
    }


}