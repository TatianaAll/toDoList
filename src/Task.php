<?php
//pour le typage :
declare(strict_types=1);
require_once '../config/config.php';

class Task {
    public string $name;
    public string $statut;
    public ?int $id;

    public function __construct(string $taskName){
        if (mb_strlen($taskName) < 2) {
            throw new Exception("Le nom de la tâche doit être plus long");
        }
        $this->name = $taskName;
        $this->statut = "non terminé";
        // il faut incrémenter mon ID à chaque construction -> depuis mon TaskManager
    }

    private function finishTask(){
        if ($this->statut !== "finished") {
            $this->statut = "finished";
        } else {
            throw new Exception("La tâche a déjà été terminée :)");
        }

    }
    private function removeTask(){
        if ($this->statut !== "deleted") {
            $this->statut = "deleted";
        } else {
            throw new Exception("la tâche n'existe plus, sorry :p");
        }
    }

}