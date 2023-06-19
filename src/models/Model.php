<?php

abstract class Model
{
    private int $id;

    // Constructor
    function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
     * Retourne l'id du modèle
     * @return int $id l'id du modèle
     */
    public function getId(): int
    {
        return $this->id;
    }
}
