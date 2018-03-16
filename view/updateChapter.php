<!-- Fichier appeler pour faire afficher à l'écran administrateur TinyMCE -->
<?php $data = $chapter; ?>
<?php $title = "Modifier article" ?>

<?php ob_start(); ?>

<section class="container-fluid">
    <form action="index.php?action=updateChapter&amp;id=<?= $data['id']?>" method="post" enctype="multipart/form-data">
        <div class="form-group mt-2">
            <label for="title">Titre :</label>
            <input name="title" type="text" value="<?= htmlspecialchars($data['title']); ?>"><br>
        </div>
        <div class="form-group mt-2">
            <label for="mon_fichier">Fichier :</label><br>
            <input type="hidden" name="MAX_FILE_SIZE" value="500000000" />
            <img src="public/images/<?= $data['chapter_img']; ?>" /><br>
            <input type="file" name="mon_fichier" id="mon_fichier"/><br>
        </div>
        <textarea id="texte" name="text" rows="25" ><?= $data['chapter_texte']; ?></textarea>
        <input class="btn btn-primary mt-2" name="envoyer_article" type="submit" value="Modifier">
    </form>
 </section>
<?php $content= ob_get_clean(); ?>

<?php require('template.php'); ?>