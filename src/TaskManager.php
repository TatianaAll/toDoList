<?php
declare(strict_types=1);

require_once '../config/config.php';


// Gestion des opérations CRUD sur les tâches ==> on récupère les infos du JSON SANS les modif

class TaskManager
{
    //on type : on attend une instance de la class TASK en paramètre, et la fonction ne retourne rien :
    public function getJsonTask()
    {
        $path = '../data/tasks.json';
        $jsonString = file_get_contents($path);
        // je dit que ce que j'ai récupéré depuis mon json
        $tasks = json_decode($jsonString, true);
        return $tasks;
    }

    public function addJsonTask(Task $task)
    {
        $path = '../data/task.json';

        try {
            if (file_exists($path)) {

                $tasks = $this->getJsonTask();

                //ranger mes tasks décodées dans un tableau
                if ($tasks === null) {
                    $tasks = [];
                }
            } else {
                // Si le fichier n'existe pas, je créer un tableau vide
                $tasks = [];
            }
            // Ajouter un ID a mes task
            $task->id = count($tasks) + 1;  // Assigner un ID unique
            $tasks[] = $task;

            return $tasks;
        } catch (Exception $exception) {
            throw new Exception("Erreur dans le chemin !! @_@");
        }

    }

}
