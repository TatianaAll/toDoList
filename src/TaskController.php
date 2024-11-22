<?php
declare(strict_types=1);
require_once('./../config/config.php');
require_once('./../src/Task.php');
require_once('./../src/TaskManager.php');

// appel de la vue et du back avec TaskManager pour pouvoir modifier les données sur le JSON


class TaskController
{
    public function toTheIndexPage(): void
    {
        $taskManager = new TaskManager();
        $tasks = $taskManager->getJsonTask('../data/tasks.json');

        $message = 'Bienvenue sur votre To Do List !' ;

        $loader = new \Twig\Loader\FilesystemLoader('../view');
        $twig = new \Twig\Environment($loader, ['debug' => true]);
        $twig->addExtension(new \Twig\Extension\DebugExtension());
        echo $twig->render('index.twig', [
            'message' => $message,
            'tasks' => $tasks,]);

    }

    public function createTask(): void
    {
        $message = null;
        $taskManager = new TaskManager();


        if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // var_dump($_POST); die;
            //si j'ai bien récupéré le nom de ma tache alors je fais :
            if (key_exists("newTaskName", $_POST)) {
                try {
                    // 1- je créée ma nouvelle tache avec la class Task, en lui donnant le nom de la tahce
                    $task = new Task($_POST["newTaskName"]);
                    $taskManager->addJsonTask($task);

                    $message = "Nouvelle tâche ajoutée !";
                } catch (Exception $exception) {
                    $message = $exception->getMessage();
                    $tasks = [];
                }
            }
        }
        $tasks = $taskManager->getJsonTask('../data/tasks.json');
        // je créé la config de twig en lui indiquant le chemin pour accéder aux templates
        $loader = new \Twig\Loader\FilesystemLoader('../view');
        $twig = new \Twig\Environment($loader, ['debug' => true]);
        $twig->addExtension(new \Twig\Extension\DebugExtension());
        echo $twig->render('add-task.twig', [
            'message' => $message,
            'tasks' => $tasks,
        ]);
    }

    public function validateTask(): void {
        // je veux sélectionner la tache en question
        //et changer son statut
        //

    }
}