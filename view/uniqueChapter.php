<!-- Fichier appeler pour faire afficher à l'écran utilisateur la page d'un seul et unique article avec les commentaires -->
<?php $data = $chapter; 
      $dataComments = $comments;
?>
<?php $title = htmlspecialchars($data['title']);  ?>

<?php ob_start(); ?>

<!-- Haut de page -->
<section id="articles" class="container-fluid">
    <h1><?= htmlspecialchars($data['title']); ?> </h1>
    <!-- Div regroupant tous les chapitres -->
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <img class="card-img" src="<?= htmlspecialchars($data['chapter_img']); ?>" alt="Card image cap">
                    <div class="card-body">
                        <p><?= htmlspecialchars($data['chapter_texte']); ?></p>
                        <p> Posté le : <?= htmlspecialchars($data['chapter_date_fr']); ?></p>
                    </div>
            </div>
        </div>
    </div>
</section>
<section id="commentaires" class="container-fluid">
    <h3>Commentaires</h3>
    <div class="row">
        <div class="col-md-8">
            <?php foreach($dataComments as $dataComment): ?>
                <p><?= htmlspecialchars($dataComment['username']); ?></p>
                <p><?= htmlspecialchars($dataComment['comment_text']); ?></p>
                <p><?= htmlspecialchars($dataComment['comment_date_fr']); ?></p>
            <?php endforeach;?>
        </div>
    </div>
</section>
<?php if(isset($_SESSION['username'])) {
?>
<section class='container-fluid'>
    <h3>Ajouter un commentaire</h3>
    <form action='index.php?action=addComment&amp;id=<?=htmlspecialchars($data['id'])?>' method='post'>
        <textarea name='id_Chapters' cols='1' rows='1' style='display: none'> <?=htmlspecialchars($data['id'])?></textarea>
        Votre pseudo : <?=htmlspecialchars($_SESSION['username']) ?>
        <input name='id_Users' type='text' value ='<?=htmlspecialchars(intval($_SESSION['id']))?>' style='display: none'><br>
        Votre message :<br>
        <input name='comment_text' type='textarea' placeholder='Votre message'>
        <p>ajouter un capcha</p>
        <input type='submit' value='Submit'>
    </form>
</section>
<?php 
}
?>

<?php $content= ob_get_clean(); ?>

<?php require('template.php'); ?>