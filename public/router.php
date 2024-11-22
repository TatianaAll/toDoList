<?php

require_once '../src/TaskController.php';



// récupère l'url actuelle
$requestUri = $_SERVER['REQUEST_URI'];

// découpe l'url actuelle pour ne récupérer que la fin
// si l'url demandée est "http://localhost:8888/piscine-ecommerce-app/public/test"
// $enduri contient "test"
$uri = parse_url($requestUri, PHP_URL_PATH);
$endUri = str_replace('/revision-toDo/todolist/public', '', $uri);
$endUri = trim($endUri, '/');

// en fonction de la valeur de $endUri on charge le bon contrôleur
$addTask = new TaskController();

if ($endUri === "") {
    $addTask->toTheIndexPage();
} else if ($endUri === "add-task") {
    $addTask->createTask();
}
