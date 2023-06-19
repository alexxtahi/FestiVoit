<?php
require_once Helper::getModelsPath('/model.php');


class User extends Model
{
    //Déclaration des variables

    private string $nom;
    private string $prenom;
    private string $login;
    private string $hashMdp;
    private int $typeUserId;

    // Constructors
    function __construct(int $id, string $nom, string $prenom, string $login, string $hashMdp, int $typeUserId = 3)
    {
        parent::__construct($id);
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->login = $login;
        $this->hashMdp = $hashMdp;
        $this->typeUserId = $typeUserId;
    }

    public static function createCollection(array $rows): array
    {

        $collection = [];
        foreach ($rows as $row) {
            $collection[] = User::fromArray($row);
        }
        return $collection;
    }
    public static function fromArray(array $columns): User
    {
        return new User($columns['id'], $columns['nom'], $columns['prenom'], $columns['login'], $columns['hashMdp'], isset($columns['typeUserId']) ? $columns['typeUserId'] : 3);
    }

    public function toArray(): array
    {
        return [
            'id' => parent::getId(),
            'nom' => $this->nom,
            'prenom' => $this->prenom,
            'login' => $this->login,
            'hashMdp' => $this->hashMdp,
            'typeUserId' => $this->typeUserId,
        ];
    }

    public static function isLoggedIn(): bool
    {
        return self::getAuthUser() != null;
    }

    public static function getAuthUser()
    {
        return isset($_SESSION['authUser']) ? User::fromArray(json_decode($_SESSION['authUser'], true)) : null;
    }

    public static function setAuthUser(User $authUser): void
    {
        $_SESSION['authUser'] = json_encode($authUser->toArray());
    }

    public static function logout(): void
    {
        unset($_SESSION['authUser']);
    }

    /**
     * Retourne le nom de l'utilisateur
     * @return string $nom le nom de l'utilisateur
     */
    public function getNom(): string
    {
        return $this->nom;
    }

    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }
    /**
     * Retourne le prénom de l'utilisateur
     * @return string $prenom le prenom de l'utilisateur
     */
    public function getPrenom(): string
    {
        return $this->prenom;
    }
    public function setPrenom(string $prenom): void
    {
        $this->prenom = $prenom;
    }

    /**
     * Retourne le nom de l'utilisateur
     * @return string $nom le nom de l'utilisateur
     */
    public function getNomComplet(): string
    {
        return $this->prenom . ' ' . $this->nom;
    }
    /**
     * Retourne le login de l'utilisateur
     * @return string $login le login de l'utilisateur
     */
    public function getLogin(): string
    {
        return $this->login;
    }
    /**
     * Retourne le mot de pass haché de l'utilisateur
     * @return string $hashMdp le mot de passe haché de l'utilisateur
     */

    public function getHashMdp(): string
    {
        return $this->hashMdp;
    }
    public function setHashMdp(string $mdp): void
    {
        $this->hashMdp = password_hash($mdp, PASSWORD_DEFAULT);
    }

    public function getTypeUserId(): int
    {
        return $this->typeUserId;
    }
}
