<?php
/**
 * Created by PhpStorm.
 * User: timoj
 * Date: 15/05/2018
 * Time: 16:43
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: application/json');

$file = "todos.json";
$current_todos = file_exists($file) ? (array)json_decode(file_get_contents($file)) : array();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['id']) && isset($current_todos[$_GET['id']])) {
        echo json_encode($current_todos[$_GET['id']]);
    } else {
        echo json_encode($current_todos);
    }
} else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id']) && isset($current_todos[$_POST['id']])) {
        //update
        $data = json_decode(file_get_contents('php://input'), true);
        $current_todos[$data['id']] = array('title' => $data['title'], 'content' => $data['content']);
    } else {
        //create
        $data = json_decode(file_get_contents('php://input'), true);
        $new_id = uniqid();
        $current_todos[$new_id] = array('title' => $data['title'], 'content' => $data['content']);
    }
} else if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    if (isset($_GET['id']) && isset($current_todos[$_GET['id']])) {
        //delete
        unset($current_todos[$_GET['id']]);
    }
}

file_put_contents($file, json_encode($current_todos));