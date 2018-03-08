<!-- Routeur, fait appel au bon controleur afin de faire afficher la bonne page en question -->

<?php 
require('controller/controller.php');

if(isset($_GET['id'])){
    chapter($_GET['id']);
} else {
    listChapters();
}