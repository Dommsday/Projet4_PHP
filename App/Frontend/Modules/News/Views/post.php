<div class="info-comment col-xl-12">
	<p>Par <em><?= $post['author'] ?></em>, le <?= $post['date']->format('d/m/Y à H\hi') ?></p>
</div>

<div class="title col-xl-12">
	<h2><?= $post['title'] ?></h2>
</div>

<p><?= nl2br($post['content']) ?></p>


<div class="container-comment">
<p><a href="comment-news-<?= $post['id'] ?>.html">Ajouter un commentaires</a></p>

<?php
	if(empty($comments)){
?>

<p>Aucun commentaire. Tu n'as pas envie d'etre le premier??</p>
<?php
}

foreach ($comments as $comment){
?>

<p class="info-author">Posté par <?= htmlspecialchars($comment['author']) ?> le <?= $comment['date']->format('d/m/Y à H\hi') ?></p>

<p><?= $comment['content'] ?></p>

<?php
}
?>

<p><a href="comment-news-<?= $post['id'] ?>.html">Ajouter un commentaire</a></p>
</div>
