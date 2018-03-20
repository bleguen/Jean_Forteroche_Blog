<!-- Fichier appeler pour faire afficher à l'écran administrateur TinyMCE -->

<?php $title = "Création article" ?>

<?php ob_start(); ?>

<section class="container-fluid" style="margin-top: 60px">
    <form action="index.php?action=sendChapter" method="post" enctype="multipart/form-data">
        <div class="form-group mt-2" >
            <label for="title">Titre :</label>
            <input name="title" type="text"><br>
        </div>
        <div class="form-group">
            <label for="mon_fichier">Fichier (tous formats | max. 1 Mo) :</label><br>
            <input type="hidden" name="MAX_FILE_SIZE" value="500000000" />
            <input type="file" name="mon_fichier" id="mon_fichier" /><br>
        </div>
        <textarea id="texte" name="text" rows="25" ></textarea>
        <input class="btn btn-primary mt-2" name="envoyer_article" type="submit" value="Envoyer">
    </form>
 </section>
<?php $content= ob_get_clean(); ?>

<?php require('template.php'); ?>