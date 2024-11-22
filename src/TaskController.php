<?php
declare(strict_types=1);
require_once('../config/config.php');
require_once('Task.php');
require_once('TaskManager.php');

// appel de la vue et du back avec TaskManager pour pouvoir modifier les données sur le JSON


class TaskController
{
    public function toTheIndexPage(): void
    {
        $message = null;
        // je créé la config de twig en lui indiquant le chemin pour accéder aux templates
        $loader = new \Twig\Loader\FilesystemLoader('../view');
        $twig = new \Twig\Environment($loader, ['debug' => true]);
        $twig->addExtension(new \Twig\Extension\DebugExtension());
        echo $twig->render('index.twig', [
            'message' => $message,]);
    }

    public function createTask(): void
    {
        $message = null;
        $taskManager = new TaskManager();
        // j'appelle mon manager pour décoder mon json
        $task = $taskManager->getJsonTask();

        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            //si j'ai bien récupéré le nom de ma tache alors je fais :
            if (key_exists("newTaskName", $_POST)) {
                try {
                    // 1- je créée ma nouvelle tache avec la class Task, en lui donnant le nom de la tahce
                    $task = new Task($_POST["newTaskName"]);
                    $taskManager->addJsonTask($task);

                    $message = "Nouvelle tâche ajoutée !";
                } catch (Exception $exception) {
                    $message = $exception->getMessage();
                }
            }
        }
        // je créé la config de twig en lui indiquant le chemin pour accéder aux templates
        $loader = new \Twig\Loader\FilesystemLoader('../view');
        $twig = new \Twig\Environment($loader, ['debug' => true]);
        $twig->addExtension(new \Twig\Extension\DebugExtension());
        echo $twig->render('add-task.twig', [
            'message' => $message,
        ]);
    }
}