<?php
    require_once('model/ChapterManager.php');
    $chapterManager = new ChapterManager();
    $chapters = $chapterManager->getAllChapters();
    while($data = $chapters->fetch()) {
?>
    <a class="dropdown-item" href="index.php?action=chapter&amp;id=<?= $data['id'] ?>"> <?= htmlspecialchars($data['title']) ?></a>
<?php
    }
?>