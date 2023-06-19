<?php
require_once Helper::getModelsPath('/DAO.php');
require_once Helper::getModelsPath('/user/User.php');

class UserDAO extends DAO
{
    // Constructor
    function __construct($c)
    {
        parent::__construct($c);
    }

    // Methods
    public function create($model): bool
    {
        $query = "INSERT INTO user (nom, prenom, login, hashMdp, typeUserId) VALUES (?, ?, ?, ?, ?)";
        $statement = $this->connect->prepare($query);
        $statement->bindValue(1, $model->getNom());
        $statement->bindValue(2, $model->getPrenom());
        $statement->bindValue(3, $model->getLogin());
        $statement->bindValue(4, $model->getHashMdp());
        $statement->bindValue(5, $model->getTypeUserId());
        return $statement->execute();
    }
    public function read(int $modelID)
    {
        $query = "SELECT * FROM user WHERE id = ?";
        $statement = $this->connect->prepare($query);
        $statement->bindValue(1, $modelID);
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        $result = $statement->fetch();
        return $result != false ? User::fromArray($result) : null;
    }

    public function readAll()
    {
        $query = "SELECT * FROM user";
        $statement = $this->connect->prepare($query);
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        $result = $statement->fetchAll();
        return $result != false ? User::createCollection($result) : [];
    }

    public function readByLogin(string $userLogin)
    {
        $query = "SELECT * FROM user WHERE login = ?";
        $statement = $this->connect->prepare($query);
        $statement->bindValue(1, $userLogin);
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        $result = $statement->fetch();
        return $result != false ? User::fromArray($result) : null;
    }

    public function update($model): bool
    {
        $query = "UPDATE user SET nom = ?, prenom = ?, hashMdp = ? WHERE id = ?";
        $statement = $this->connect->prepare($query);
        $statement->bindValue(1, $model->getNom());
        $statement->bindValue(2, $model->getPrenom());
        $statement->bindValue(3, $model->getHashMdp());
        $statement->bindValue(4, $model->getId());
        return $statement->execute();
    }
    public function delete($model): bool
    {
        $query = "DELETE FROM user WHERE id = ?";
        $statement = $this->connect->prepare($query);
        $statement->bindValue(1, $model->getId());
        return $statement->execute();
    }
}
