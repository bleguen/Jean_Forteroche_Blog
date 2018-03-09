<!-- Routeur, fait appel au bon controleur afin de faire afficher la bonne page en question -->

<?php 
require('controller/controller.php');

$controller = new Controller();

if(isset($_GET['id'])){
    $controller->chapter($_GET['id']);
} else {
    $controller->listChapters();
}