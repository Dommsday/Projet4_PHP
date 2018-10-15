<p>Par <em><?= $post['author'] ?></em>, le <?= $post['date']->format('d/m/Y à H\hi') ?></p>
<h2><?= $post['title'] ?></h2>
<p><?= nl2br($post['content']) ?></p>


<?php if($news['date'] != $news['update_date']){ ?>

	<p>Modifié le <?= $news['update_date']->format('d/m/Y à H\hi') ?></p>
<?php 
}
?>

<p><a href="comment-news-<?= $news['id'] ?>.html">Ajouter un commentaire</a></p>

<?php
	if(empty($comment)){
?>

<p>Aucun commentaire. Tu n'as pas envie d'$etre le premier??</p>
<?php
}

foreach ($comments as $comment){
?>

<p>Posté par <?= htmlspecialchars($comment['author']) ?> le <?= $comment['date']->format('d/m/Y à H\hi') ?></p>

<p><?= $comment['content'] ?></p>

<?php
}
?>

<p><a href="comment-news-<?= $news['id'] ?>.html">Ajouter un commentaire</a></p>
