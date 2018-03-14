<!-- Fichier appeler pour faire afficher à l'écran administrateur TinyMCE -->

<?php $title = "Page administration" ?>

<?php ob_start(); ?>
    
<?php $content= ob_get_clean(); ?>

<?php require('template.php'); ?>