<?php
require_once Helper::getModelsPath('/DAO.php');
require_once Helper::getModelsPath('/typeUser/TypeUser.php');

class TypeUserDAO extends DAO
{
    // Constructor
    function __construct($c)
    {
        parent::__construct($c);
    }

    // Methods
    public function create($model): bool
    {
        $query = "INSERT INTO typeUser (nomType) VALUES (?)";
        $statement = $this->connect->prepare($query);
        $statement->bindValue(1, $model->getNomType());
        return $statement->execute();
    }

    public function read(int $modelID)
    {
        $query = "SELECT * FROM typeUser WHERE id = ?";
        $statement = $this->connect->prepare($query);
        $statement->bindValue(1, $modelID);
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        $result = $statement->fetch();
        return $result != false ? TypeUser::fromArray($result) : null;
    }

    public function readAll()
    {
        $query = "SELECT * FROM typeuser";
        $statement = $this->connect->prepare($query);
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        $result = $statement->fetchAll();
        return $result != false ? TypeUser::createCollection($result) : [];
    }

    public function update($model): bool
    {
        $query = "UPDATE typeUser SET nomType = ? WHERE id = ?";
        $statement = $this->connect->prepare($query);
        $statement->bindValue(1, $model->getNomType());
        $statement->bindValue(2, $model->getId());
        return $statement->execute();
    }

    public function delete($model): bool
    {
        $query = "DELETE FROM typeUser WHERE id = ?";
        $statement = $this->connect->prepare($query);
        $statement->bindValue(1, $model->getId());
        return $statement->execute();
    }
}
