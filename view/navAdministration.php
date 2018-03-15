<?php 
    require_once('model/CommentManager.php');
    $commentManager = new CommentManager();
    $comments = $commentManager->getAllComments();
    $alert = 0;

    while($comment = $comments->fetch()){
        if($comment['reported']>=5) {
            $alert = $alert+1;
        }
    }
                    
    if(isset($_SESSION['username']) && ($_SESSION['id'] == 1)) {
?>
    <li class="nav-item">
        <a class="nav-link" href="index.php?action=admin">Administration <span class="badge badge-danger"><?= $alert ?></span></a>
    </li>
<?php                    
    }
?>