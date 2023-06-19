<?php

require_once Helper::getModelsPath('/model.php');
require_once Helper::getModelsPath('/festival/Festival.php');


class Annonce extends Model
{

    // Déclaration des variables

    private string $typeVehicule;
    private int $placeVehicule;
    private int $userId;
    private int $festivalId;
    private DateTime $dateAller;
    private DateTime | null $dateRetour;

    // Constructor
    function __construct(int $id, string $typeVehicule, int $placeVehicule, int $userId, int $festivalId, DateTime $dateAller, DateTime $dateRetour = null)
    {
        parent::__construct($id);
        $this->typeVehicule = $typeVehicule;
        $this->placeVehicule = $placeVehicule;
        $this->userId = $userId;
        $this->festivalId = $festivalId;
        $this->dateAller = $dateAller;
        $this->dateRetour = $dateRetour;
    }

    public static function createCollection(array $rows): array
    {
        $collection = [];
        foreach ($rows as $row) {
            $collection[] = Annonce::fromArray($row);
        }
        return $collection;
    }

    public static function fromArray(array $columns): Annonce
    {
        return new Annonce($columns['id'], $columns['typeVehicule'], $columns['placeVehicule'], $columns['userId'], $columns['festivalId'], new DateTime($columns['dateAller']), $columns['dateRetour'] != null ? new DateTime($columns['dateRetour']) : null);
    }

    public function toArray(): array
    {
        return [
            'id' => parent::getId(),
            'typeVehicule' => $this->typeVehicule,
            'placeVehicule' => $this->placeVehicule,
            'userId' => $this->userId,
            'festivalId' => $this->festivalId,
            'dateAller' => $this->dateAller,
            'dateRetour' => $this->dateRetour,
        ];
    }

    /**
     * Retourne le type du vehicule
     * @return string $typeVehicule le type du véhicule
     */
    public function getTypeVehicule(): string
    {
        return $this->typeVehicule;
    }
    /**
     * Retourne le nombre de place que dispose le vehicule
     * @return int $placeVehicule le nombre de place que dispose le vehicule
     */
    public function getPlaceVehicule(): int
    {
        return $this->placeVehicule;
    }

    /**
     * Retourne une instance de la classe User correspondant à l'utilisateur ayant posté l'annoonce
     * @return User l'utilisateur ayant posté l'annonce
     */
    public function getUser() //: User
    {
        return;
    }

    /**
     * Retourne la date de départ
     * @return DateTime $dateAller la date de départ
     */

    public function getDateAller(bool $forSql = false): string
    {
        return $forSql ? $this->dateAller->format('Y-m-d H:i:s') : $this->dateAller->format('d/m/Y H:i:s');
    }
    /**
     * Retourne la date de retour
     * @return DateTime $dateRetour la date de retour
     */

    public function getDateRetour(bool $forSql = false)
    {
        if ($forSql) {
            return $this->dateRetour ? $this->dateRetour->format('Y-m-d H:i:s') : null;
        } else {
            return $this->dateRetour ? $this->dateRetour->format('d/m/Y H:i:s') : null;
        }
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getFestivalId(): int
    {
        return $this->festivalId;
    }

    /**
     * Génère et retourne des instances de la classe courantes
     * @param int $numberOfObjects Le nombre d'instances à générer
     * @return array<Annonce> Un tableau d'instances de la classe courante
     */
    public static function factory(int $numberOfObjects = 1): array
    {
        $collection = [];
        for ($i = 1; $i <= $numberOfObjects; $i++) {
            $collection[] = new Annonce($i, random_bytes(10), random_int(1, 5), random_int(1, 5), random_int(1, 5), new DateTime());
        }
        return $collection;
    }
}
