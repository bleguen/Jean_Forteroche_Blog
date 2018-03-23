<?php $title = "Erreurs" ?>

<?php ob_start(); ?>

<h3 id="errors"><?= $errors ?></h3>

<?php $content= ob_get_clean(); ?>

<?php require('template.php'); ?>