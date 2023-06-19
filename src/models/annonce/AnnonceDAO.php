<?php
require_once Helper::getModelsPath('/DAO.php');
require_once Helper::getModelsPath('/annonce/Annonce.php');
class AnnonceDAO extends DAO
{
    // Constructor
    function __construct($c)
    {
        parent::__construct($c);
    }

    // Methods
    public function create($model): bool
    {
        $query = "INSERT INTO annonce (typeVehicule, placeVehicule, dateAller, dateRetour, userId, festivalId) VALUES (?, ?, ?, ?, ?, ?)";
        $statement = $this->connect->prepare($query);
        $statement->bindValue(1, $model->getTypeVehicule());
        $statement->bindValue(2, $model->getPlaceVehicule());
        $statement->bindValue(3, $model->getDateAller(true));
        $statement->bindValue(4, $model->getDateRetour(true));
        $statement->bindValue(5, $model->getUserId());
        $statement->bindValue(6, $model->getFestivalId());
        return $statement->execute();
    }

    public function read(int $modelID)
    {
        $query = "SELECT * FROM annonce WHERE id = ?";
        $statement = $this->connect->prepare($query);
        $statement->bindValue(1, $modelID);
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        $result = $statement->fetch();
        return $result != false ? Annonce::fromArray($result) : null;
    }

    public function readAll()
    {
        $query = "SELECT * FROM annonce WHERE placeVehicule > (SELECT count(id) FROM participate WHERE annonceId = annonce.id)";
        $statement = $this->connect->prepare($query);
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        $result = $statement->fetchAll();
        return $result != false ? Annonce::createCollection($result) : [];
    }

    public function update($model): bool
    {
        $query = "UPDATE annonce SET typeVehicule = ?, placeVehicule = ?, dateAller = ?, dateRetour = ? WHERE id = ?";
        $statement = $this->connect->prepare($query);
        $statement->bindValue(1, $model->getTypeVehicule());
        $statement->bindValue(2, $model->getPlaceVehicule());
        $statement->bindValue(3, $model->getDateAller());
        $statement->bindValue(4, $model->getDateRetour());
        $statement->bindValue(5, $model->getId());
        return $statement->execute();
    }

    public function delete($model): bool
    {
        $query = "DELETE FROM annonce WHERE id = ?";
        $statement = $this->connect->prepare($query);
        $statement->bindValue(1, $model->getId());
        return $statement->execute();
    }
}
