<!-- Fichier appeler pour faire afficher à l'écran utilisateur la page d'un seul et unique article avec les commentaires -->
<?php $data = $chapter; ?>
<?php $title = htmlspecialchars($data['title']);  ?>

<?php ob_start(); ?>

<!-- Haut de page -->
<section id="articles" class="container-fluid">
<h1><?= htmlspecialchars($data['title']); ?> </h1>
<!-- Div regroupant tous les chapitres -->
<div class="row">
    <div class="col-md-6">
    <div class="card">
        <img class="card-img" src="<?= htmlspecialchars($data['chapter_img']); ?>" alt="Card image cap">
            <div class="card-body">
                <p><?= htmlspecialchars($data['chapter_texte']); ?></p>
                <p> le : <?= htmlspecialchars($data['chapter_date_fr']); ?></p>
            </div>
    </div>
    </div>
</div>
</section>
<?php $content= ob_get_clean(); ?>

<?php require('template.php'); ?>
