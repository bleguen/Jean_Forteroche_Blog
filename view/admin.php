<!-- Fichier appeler pour faire afficher à l'écran administrateur TinyMCE -->

<?php $title = "Page administration" ?>

<?php ob_start(); ?>
<section class="container-fluid">

<h2>Vous pouvez créer ou modifier vos articles ici</h2>

<a href="index.php?action=sendChapter" class="btn btn-primary">Créer un nouvel article</a>

<table class="table table-striped table-dark">
  <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Chapitre</th>
        <th scope="col">Modifier un article</th>
        <th scope="col">Supprimer un article</th>
    </tr>
  </thead>
  <tbody>
  <?php 
    $i = 1;
    while($data = $chapters->fetch()) { ?>
    <tr>
    
        <th scope="row"><?= $i++ ?></th>
        <td><?= htmlspecialchars($data['title'])?></td>
        <td><a href="index.php?action=updateChapter&amp;id=<?= $data['id'];?>" class="btn btn-primary">Modifier</a></td>
        <td><a href="index.php?action=deleteChapter&amp;id=<?= $data['id'];?>" class="btn btn-primary">Supprimer</a></td>
    </tr>
    <?php
    }
    ?>
    
  </tbody>
</table>
</section>

<section class="container-fluid">

<h2>Vous pouvez gerer vos commentaires ici</h2>

<table class="table table-striped table-dark">
  <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Identifiant de l'utilisateur</th>
        <th scope="col">Commentaire</th>
        <th scope="col">Chapitre</th>
        <th scope="col">Supprimer un commentaire</th>
        <th scope="col">Nombre de signalement</th>
    </tr>
  </thead>
  <tbody>
  <?php   
    $i = 1;
    $alert = 0;
    while($comment = $comments->fetch()){ ?>
      <tr>
          <th scope="row"><?= $i++ ?></th>
          <td><?= htmlspecialchars($comment['id_Users'])?></td>
          <td><?=htmlspecialchars($comment['comment_text']); ?></td>
          <td><?=htmlspecialchars($comment['id_Chapters']); ?></td>
          <td><a href="index.php?action=deleteComment&amp;id=<?= $comment['id'];?>" class="btn btn-primary">Supprimer</a></td>
          <td><?= htmlspecialchars($comment['reported']); ?></td>
      </tr>
    <?php
    
      if($comment['reported']>=5) {
        $alert = $alert+1;
      }
    }
    ?>
    
  </tbody>
</table>
</section>

<?php $content= ob_get_clean(); ?>

<?php require('template.php'); ?>