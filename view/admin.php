<!-- Fichier appeler pour faire afficher à l'écran administrateur TinyMCE -->

<?php $title = "Page administration" ?>

<?php ob_start(); ?>
<section class="container-fluid d-flex flex-column">

  <h2>Vous pouvez créer ou modifier vos articles ici</h2>

  <a href="index.php?action=sendChapter" class="btn btn-primary align-self-center m-3">Créer un nouvel article <i class="fas fa-pencil-alt"></i></a>

  <div class="col-12 table-dark">
    <div id="headTableChapter" class="row">
      <div class="d-none d-sm-block col-sm-1">#</div>
      <div class="col-5 col-sm-2">Chapitre</div>
      <div class="d-none d-sm-block col-sm-7">Extrait</div>
      <div class="col-7 col-sm-2 row">
        <div class="d-none d-sm-block col-sm-3">Lire</div>
        <div class="col-6 col-sm-5">Modifier</div>
        <div class="col-6 col-sm-4">Supprimer</div>
      </div>
    </div>
    <div id="bodyTableChapter" class="row">
    <?php 
      $i = 1;
      while($data = $chapters->fetch()) { ?>
      <div class="d-none d-sm-block col-sm-1"><?= $i++ ?></div>
      <div class="col-5 col-sm-2"><?= htmlspecialchars($data['title'])?></div>
      <div class="d-none d-sm-block col-sm-7 text-truncate"><?= $data['chapter_texte']?></div>
      <div class="col-7 col-sm-2 row">
        <div class="d-none d-sm-block col-sm-3"><a href="index.php?action=chapter&amp;id=<?= $data['id'];?>" class="btn btn-info"><i class="fas fa-eye"></i></a></div>
        <div class="col-6 col-sm-5"><a href="index.php?action=updateChapter&amp;id=<?= $data['id'];?>" class="btn btn-warning"><i class="fas fa-edit"></i></a></div>
        <div class="col-6 col-sm-4"><a href="index.php?action=deleteChapter&amp;id=<?= $data['id'];?>" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a></div>
      </div>
      <?php
      }
      ?>
  </div>
</section>

<section class="container-fluid">

<h2>Vous pouvez gerer vos commentaires ici</h2>

  <div class="container table table-striped table-dark">
    <div id="headTableComments" class="row">
          <div class="d-none d-sm-block col-sm-1">#</div>
          <div class="d-none d-sm-block col-sm-1">Utilisateur</div>
          <div class="col-4 col-sm-6">Commentaire</div>
          <div class="d-none d-sm-block col-sm-1">Chapitre</div>
          <div class="col-4 col-sm-1">Supprimer</div>
          <div class="col-4 col-sm-2">Signalement</div>
    </div>
    <div id="body" class="row">
    <?php   
      $i = 1;
      $alert = 0;
      while($comment = $comments->fetch()){ 
    ?>
      <div class="d-none d-sm-block col-sm-1"><?= $i++ ?></div>
      <div class="d-none d-sm-block col-sm-1"><?= htmlspecialchars($comment['id_Users'])?></div>
      <div class="col-4 col-sm-6 text-truncate"><a href="index.php?action=chapter&amp;id=<?= $comment['id_Chapters'];?>"><?=htmlspecialchars($comment['comment_text']); ?></a></div>
      <div class="d-none d-sm-block col-sm-1"><?=htmlspecialchars($comment['id_Chapters']); ?></div>
      <div class="col-4 col-sm-1"><a href="index.php?action=deleteComment&amp;id=<?= $comment['id'];?>" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a></div>
      <div class="col-4 col-sm-2"><?= htmlspecialchars($comment['reported']); ?></div>
    <?php
      
        if($comment['reported']>=5) {
          $alert = $alert+1;
        }
      }
    ?>
      
    </div>
  </div>
</section>

<?php $content= ob_get_clean(); ?>

<?php require('template.php'); ?>