<?php
//pour le typage :
declare(strict_types=1);

class Task {
    public string $name;
    public string $statut;
    private integer $id;

    private function __construct(string $taskName){
        $this->name = $taskName;
        $this->statut = "non terminé";
        $this->id = 1;
//        il faut incrémenter mon ID à chaque construction
    }

    private function addTask(){

    }
    private function finishTask(){

    }
    private function endTask(){

    }

}