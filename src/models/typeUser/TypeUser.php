<?php
require_once Helper::getModelsPath('/model.php');

class TypeUser extends Model
{


    //Déclaration des variables 

    private string $nomType;
    // Constructor
    function __construct(int $id, string $nomType)
    {
        parent::__construct($id);
        $this->nomType = $nomType;
    }

    public static function createCollection(array $rows): array
    {

        $collection = [];
        foreach ($rows as $row) {
            $collection[] = self::fromArray($row);
        }
        return $collection;
    }

    public static function fromArray(array $columns): TypeUser
    {
        return new TypeUser($columns['id'], $columns['nomType']);
    }

    public function toArray(): array
    {
        return [

            'nomType' => $this->nomType,

        ];
    }

    /**
     * Retourne le type de l'utilisateur
     * @return string $nomType le type de l'utilisateur
     */
    public function getNomType(): string
    {
        return $this->nomType;
    }
}
