<?php
require_once Helper::getModelsPath('/model.php');

class Festival extends Model

{
    //Déclaration des variables

    private string $nomFestival;
    private DateTime $dateDebut;
    private DateTime $dateFin;
    private string $localisation;
    private string $photo;
    // Constructor
    function __construct(int $id,string $nomFestival, DateTime $dateDebut, DateTime $dateFin, string $localisation, string $photo)
    {
        parent::__construct($id);
        $this->nomFestival = $nomFestival;
        $this->dateDebut = $dateDebut;
        $this->dateFin = $dateFin;
        $this->localisation = $localisation;
        $this->photo = $photo;
        
    }

    public static function fromArray(array $columns): Festival
    {
        return new Festival($columns['id'],$columns['nomFestival'], new DateTime($columns['dateDebut']), new DateTime($columns['dateFin']), $columns['localisation'], $columns['photo']);
    }
    
    public static function createCollection(array $rows): array
    {
        $collection = [];
        foreach ($rows as $row) {
            $collection[] = Festival::fromArray($row);
        }
        return $collection;
    }

    public function toArray(): array
    {
        return [
            
            'nomFestival' => $this->nomFestival,
            'dateDebut' => $this->dateDebut,
            'dateFin' => $this->dateFin,
            'localisation' => $this->localisation,
            'photo' => $this->photo,
        ];
    }


    /**
     * Retourne le nom du festival
     * @return string $nomFestival le nom du festival
     */
    public function getNomFestival(): string
    {
        return $this->nomFestival;
    }
    /**
     * Retourne la date de debut du festival
     * @return DateTime $dateDebut la date de debut du festival
     */
    public function getDateDebut(): DateTime
    {
        return $this->dateDebut;
    }
    /**
     * Retourne la date de fin du festival
     * @return DateTime $dateFin la date de fin du festival
     */
    public function getDateFin(): DateTime
    {
        return $this->dateFin;
    }
    /**
     * Retourne la localision du festival
     * @return string $localisation la localisation du festival
     */
    public function getLocalisation(): string
    {
        return $this->localisation;
    }
    /**
     * Retourne la photo du festival
     * @return string $photo la photo du festival
     */
    public function getPhoto(): string
    {
        return $this->photo;
    }
}
