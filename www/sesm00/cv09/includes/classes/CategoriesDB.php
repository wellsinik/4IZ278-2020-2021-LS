<?php
require_once __DIR__ . '/Database.php';

class CategoriesDB extends Database
{

    protected $tableName = 'categories';

    public function fetchAll()
    {
        return $this->readData();
    }

    public function fetchBy($params)
    {
        // TODO: Implement fetchBy() method.
    }

    public function create($params)
    {
        // TODO: Implement create() method.
    }

    public function update($data, $where)
    {
        // TODO: Implement update() method.
    }

    public function delete($params)
    {
        // TODO: Implement delete() method.
    }

}