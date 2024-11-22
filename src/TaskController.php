<?php

require_once('/Task.php');
require_once('TaskManager.php');

// appel de la vue et du back avec TaskManager pour pouvoir modifier les données sur le JSON
class TaskController {
    public function createTask(Task $task)
    {
        $message = null;
        // je check que ma requete a bien eu lieu
        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            //si j'ai bien récupéré le nom de ma tache alors je fais :
            if(key_exists("newTaskName", $_POST)) {
                // 1- je créée ma nouvelle tache avec la class Task, en lui donnant le nom de la tahce
                $task = new Task($_POST["newTaskName"]);

                $message = "Nouvelle tâche ajoutée !";
//            }catch (Exception $exception) {
//                $message = $exception->getMessage();
            }
        }
        // je créé la config de twig en lui indiquant le chemin pour accéder aux templates
        $loader = new \Twig\Loader\FilesystemLoader('../public');
        // je charge twig avec la configuration
        // ça me permet d'avoir une variable $twig qui contient une instance de la classe twig
        // et donc pouvoir utiliser les méthodes public que twig crées
        $twig = new \Twig\Environment($loader);
        echo $twig->render('index.php', [
            'message' => $message,
        ]);
    }
}