<!-- Fichier appeler pour faire afficher à l'écran utilisateur la page d'incription -->

<?php $title = "Page inscription" ?>

<?php ob_start(); ?>
    <section id="presentation" class="container-fluid">
        <h1>Jean Forteroche</h1>
        <div class="col-12">
            <p>
                Après un long moment de réfléxion sur ma vie, j'ai décidé de prendre mon envole. L'idée de partir me trotait dans la tête depuis bien longtemps.
                J'ai donc choisi l'Alaska, ce pays m'as toujours fais rêvé. Je vous raconterais donc mon voyage du début jusqu'a la fin avec des articles qui apparaitront au fur et à mesure de mon aventure
                N'hésitez pas à prendre contact avec moi si vous souhaitez avoir des informations. Laisser des commentaires et je vous répondrais le plus vite possible.
                En espérant partager mon expérience au maximum.

            </p>
        </div>
    </section>
<?php $content= ob_get_clean(); ?>

<?php require('template.php'); ?>