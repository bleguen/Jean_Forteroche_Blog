<!-- Fichier appeler pour faire afficher à l'écran administrateur TinyMCE -->

<?php $title = "Création article" ?>

<?php ob_start(); ?>

<section class="container-fluid">
    <form action="index.php?action=sendChapter" method="post" enctype="multipart/form-data">
        <label for="title">Titre :</label>
        <input name="title" type="text"><br>
        <label for="mon_fichier">Fichier (tous formats | max. 1 Mo) :</label><br>
        <input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
        <input type="file" name="mon_fichier" id="mon_fichier" /><br>
        <textarea id="texte" name="text" rows="25" ></textarea>
        <input name="envoyer_article" type="submit" value="Envoyer">
    </form>
 </section>
<?php $content= ob_get_clean(); ?>

<?php require('template.php'); ?>