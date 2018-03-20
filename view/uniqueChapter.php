<!-- Fichier appeler pour faire afficher à l'écran utilisateur la page d'un seul et unique article avec les commentaires -->
<?php $data = $chapter; 
      $dataComments = $comments;
?>
<?php $title = htmlspecialchars($data['title']);  ?>

<?php ob_start(); ?>

<!-- Haut de page -->
<section id="articles" class="container-fluid">
    <h1 id="title" class="d-flex justify-content-center"><?= htmlspecialchars($data['title']); ?> </h1>
    <!-- Div regroupant tous les chapitres -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <img class="card-img col-12 col-md-6 d-flex align-self-center" src="public/images/<?= htmlspecialchars($data['chapter_img']); ?>" alt="Card image cap">
                    <div class="card-body">
                        <p><?= $data['chapter_texte']; ?></p>
                        <p id="date"> Posté le : <?= htmlspecialchars($data['chapter_date_fr']); ?></p>
                    </div>
            </div>
        </div>
    </div>
</section>
<section id="commentaires" class="container-fluid">
    <h3  id="comments" class="d-flex justify-content-center mb-5">Commentaires</h3>
    <div class="row">
        <?php if(count($dataComments) == 0) {
        ?>  
            <div class="col-12 d-flex justify-content-center">
                <p>Aucun commentaire, soyez le premier à en laisser un !</p>
            </div>
        <?php 
            } else { 
                foreach($dataComments as $dataComment): 
        ?>
        <div class="col-12 col-md-4 mb-3">
            <div id="comment-block" class="col-12 no-gutters">
                <div id="comment-user" class="row col-12 m-0">
                    <p id="comment-username" class="col-2 col-md-3 p-0"><strong><?= htmlspecialchars($dataComment['username']); ?></strong></p>
                    <p id="comment-date" class="col-8 col-md-6">Ajouté le : <?= htmlspecialchars($dataComment['comment_date_fr']); ?></p>
                    <a class="col-2 col-md-3" href="index.php?action=report&amp;id=<?= htmlspecialchars($dataComment['id']);?>&amp;idChap=<?= htmlspecialchars($dataComment['id_Chapters'])?>">Signaler</a>
                </div>
                <div id="comment-text" class="col-md-12">
                    <p><?= htmlspecialchars($dataComment['comment_text']); ?></p>
                </div>
            <?php if(isset($_SESSION['username']) &&  ($_SESSION['username']== $dataComment['username'])) { ?>
                <div id="comment-modify" class="col-md-12">
                    <a data-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapseModif" href="#<?= htmlspecialchars($dataComment['id']);?>">Modifier</a>
                    <div class="modif collapse" id="<?= htmlspecialchars($dataComment['id']);?>">
                        <form action="index.php?action=updateComment&amp;id=<?= htmlspecialchars($dataComment['id']);?>&amp;id_Chapters=<?= htmlspecialchars($dataComment['id_Chapters']);?>" method='post'>
                            <label for="newText">Votre message :</label><br>
                            <input name='newText' type='textarea' cols="5" rows="5" placeholder='Votre message'><br>
                            <button class="btn btn-primary mt-2" type='submit'>Modifier</button>
                        </form>
                    </div>
                </div>
            </div>
            </div>
            <?php
                } else {
            ?>
                <div class="col-md-6">
                    <p></p>
                </div>
            </div>
        </div>
            <?php
                }
                endforeach;
                }
            ?>
    </div>
</section>

<?php if(isset($_SESSION['username'])) {
?>
<section id="ajoutCommentaire" class='container-fluid mt-5'>
<a class="btn btn-primary d-flex justify-content-center" data-toggle="collapse" href="#collapseForm" role="button" aria-expanded="false" aria-controls="collapseForm">Laisser un commentaire</a>
    <div class="collapse mb-2" id="collapseForm">
        <form action='index.php?action=addComment&amp;id=<?=htmlspecialchars($data['id'])?>' method='post'>
            <div id="comment-form" class="form-group col-md-12">
                <textarea name='id_Chapters' cols='1' rows='1' style='display: none'> <?=htmlspecialchars($data['id'])?></textarea>
                <input name='id_Users' type='text' value ='<?=htmlspecialchars(intval($_SESSION['id']))?>' style='display: none'>
                <label for="comment_text">Votre message :</label><br>
                <input name='comment_text' type='textarea' cols="5" rows="5" placeholder='Votre message'><br>
                <button class="btn btn-primary mt-2" type='submit'>Envoyer</button>
            </div>
        </form>
    </div>
</section>
<?php 
}
?>

<?php $content= ob_get_clean(); ?>

<?php require('template.php'); ?>