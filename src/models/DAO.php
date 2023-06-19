<?php

abstract class DAO
{
    // Properties
    protected $connect;

    // Constructor
    function __construct($c)
    {
        $this->connect = $c;
    }
    // Methods
    public abstract function create($model): bool;
    public abstract function read(int $modelID);
    public abstract function update($model): bool;
    public abstract function delete($model): bool;
}
