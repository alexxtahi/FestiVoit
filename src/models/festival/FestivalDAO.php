<?php
require_once Helper::getModelsPath('/DAO.php');
require_once Helper::getModelsPath('/festival/Festival.php');
class FestivalDAO extends DAO
{
    // Constructor
    function __construct($c)
    {
        parent::__construct($c);
    }

    // Methods
    public function create($model): bool
    {
        $query = "INSERT INTO festival (nomFestival, dateDebut, dateFin, localisation, photo) VALUES (?, ?, ?, ?, ?, ?)";
        $statement = $this->connect->prepare($query);
        $statement->bindValue(1, $model->getNomFestival());
        $statement->bindValue(2, $model->getDateDebut());
        $statement->bindValue(3, $model->getDateFin());
        $statement->bindValue(4, $model->getLocalisation());
        $statement->bindValue(5, $model->getPhoto());
        return $statement->execute();
    }

    public function read(int $modelID): Festival
    {
        $query = "SELECT * FROM festival WHERE id = ?";
        $statement = $this->connect->prepare($query);
        $statement->bindValue(1, $modelID);
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        $result = $statement->fetch();
        return $result != false ? Festival::fromArray($result) : null;
    }

    public function readAll()
    {
        $query = "SELECT * FROM festival";
        $statement = $this->connect->prepare($query);
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        $result = $statement->fetchAll();
        return $result != false ? Festival::createCollection($result) : [];
    }

    public function update($model): bool
    {
        $query = "UPDATE festival SET nomFestival = ?, dateDebut = ?, dateFin = ?, localisation = ?, photo = ? WHERE id = ?";
        $statement = $this->connect->prepare($query);
        $statement->bindValue(1, $model->getNomFestival());
        $statement->bindValue(2, $model->getDateDebut());
        $statement->bindValue(3, $model->getDateFin());
        $statement->bindValue(4, $model->getLocalisation());
        $statement->bindValue(5, $model->getPhoto());
        $statement->bindValue(6, $model->getId());
        return $statement->execute();
    }

    public function delete($model): bool
    {
        $query = "DELETE FROM festival WHERE id = ?";
        $statement = $this->connect->prepare($query);
        $statement->bindValue(1, $model->getId());
        return $statement->execute();
    }
}
