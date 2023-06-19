<?php
require_once Helper::getModelsPath('/DAO.php');
require_once Helper::getModelsPath('/participate/Participate.php');

class ParticipateDAO extends DAO
{
    // Constructor
    function __construct($c)
    {
        parent::__construct($c);
    }

    // Methods
    public function create($model): bool
    {
        $query = "INSERT INTO participate (annonceId, userId) VALUES (?, ?)";
        $statement = $this->connect->prepare($query);
        $statement->bindValue(1, $model->getAnnonceId());
        $statement->bindValue(2, $model->getUserId());
        return $statement->execute();
    }

    public function read(int $modelID)
    {
        $query = "SELECT * FROM participate WHERE id = ?";
        $statement = $this->connect->prepare($query);
        $statement->bindValue(1, $modelID);
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        $result = $statement->fetch();
        return $result != false ? Participate::fromArray($result) : null;
    }

    public function readAll()
    {
        $query = "SELECT * FROM participate";
        $statement = $this->connect->prepare($query);
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        $result = $statement->fetchAll();
        return $result != false ? Participate::createCollection($result) : [];
    }

    public function readAllByAnnonceId(int $annonceId)
    {
        $query = "SELECT * FROM participate WHERE annonceId = ?";
        $statement = $this->connect->prepare($query);
        $statement->bindValue(1, $annonceId);
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        $result = $statement->fetchAll();
        return $result != false ? Participate::createCollection($result) : [];
    }

    public function update($model): bool
    {
        $query = "UPDATE participate SET annonceId = ?, userId = ? WHERE id = ?";
        $statement = $this->connect->prepare($query);
        $statement->bindValue(1, $model->getAnnonceId());
        $statement->bindValue(2, $model->getUserId());
        $statement->bindValue(3, $model->getId());
        return $statement->execute();
    }

    public function delete($model): bool
    {
        $query = "DELETE FROM participate WHERE id = ?";
        $statement = $this->connect->prepare($query);
        $statement->bindValue(1, $model->getId());
        return $statement->execute();
    }
}
