<?php

require_once Helper::getModelsPath('/model.php');
require_once Helper::getModelsPath('/festival/Festival.php');


class Participate extends Model
{

    // Déclaration des variables

    private int $annonceId;
    private int $userId;

    // Constructor
    function __construct(int $id, int $annonceId, int $userId)
    {
        parent::__construct($id);
        $this->annonceId = $annonceId;
        $this->userId = $userId;
    }

    public static function createCollection(array $rows): array
    {
        $collection = [];
        foreach ($rows as $row) {
            $collection[] = self::fromArray($row);
        }
        return $collection;
    }

    public static function fromArray(array $columns): self
    {
        return new self($columns['id'], $columns['annonceId'], $columns['userId']);
    }

    public function toArray(): array
    {
        return [
            'id' => parent::getId(),
            'annonceId' => $this->annonceId,
            'userId' => $this->userId,
        ];
    }

    public function getAnnonceId(): int
    {
        return $this->annonceId;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }
}
