<!-- Fichier appeler pour faire afficher à l'écran utilisateur la page d'accueil soit celle ou l'on voit tout les articles etc -->

<?php $title = 'Jean Forteroche Blog Alaska' ?>

<?php ob_start(); ?>
<!-- Haut de page -->
<section id="img_home" class="container-fluid d-flex" >
    <button id="allChapter" class="btn btn-primary" href="#articles">Voir tout les chapitres</button>
</section>
<section id="articles" class="container-fluid">
    <h2 class="d-flex justify-content-center">Mes chapitres</h1>
    <!-- Div regroupant tous les chapitres -->
    <div id="allChapters" class="row col-12">
    <?php 

    while($data = $chapters->fetch()) {
        ?>
        <div class="allChapters col-md-4 mb-4">
            <a  class="card-text" href='index.php?action=chapter&amp;id=<?=$data['id'] ?>'>
                <div class="card">
                    <img class="card-img" src="public/images/<?= htmlspecialchars($data['chapter_img']) ?>" alt="<?= htmlspecialchars($data['chapter_img']) ?>">
                        <div class="card-img-overlay text-white d-flex flex-column justify-content-end">
                            <h4 class="card-title"><?= htmlspecialchars($data['title']) ?></h4>
                            <p class="card-text"> Posté le : <?= htmlspecialchars($data['chapter_date_fr']) ?></p>
                        </div>
                </div>
            </a>
        </div>
        <?php 
    }

    $chapters->closeCursor();
    ?>
    </div>
</section>
<?php $content= ob_get_clean(); ?>

<?php require('template.php'); ?>