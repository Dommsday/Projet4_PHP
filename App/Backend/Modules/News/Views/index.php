<div class="containt-admin title col-md-12 col-lg-12 col-xl-12">
	<h1 class="title-admin">Tableau de bord</h1>
</div>

<div class="informations col-sm-12 col-md-12 col-lg-12 col-xl-12">
	<div class="news">
			<a href="<?= $GLOBALS['ROOT_URL_BACK'] ?>all-post.html"><h2>Articles</h2></a>
			<p class="number"> <?= $nombreNews ?> </p>
	</div>

	<div class="comments">
		<a href="<?= $GLOBALS['ROOT_URL_BACK'] ?>all-comments.html"><h2>Commentaires</h2></a>
		<p class="number"><?= $nombreComments ?> </p>
	</div>
</div>

<div class="title-comments-warning col-md-12 col-lg-12 col-xl-12">
		<h2 class="title-admin">Commentaires signalés</h2>
</div>

<div class="warning-comments col-md-12 col-lg-12 col-xl-12">
<table>
	<tr>
		<th class="author">Auteur</th>
		<th class="title">Article</th>
		<th class="content">Contenu</th>
		<th class="date">Date</th>
		<th class="action">Action</th>
	</tr>

	<?php
	foreach ($comments as $comment) {
	?>

	<?php
		if($comment['warning'] == 1){
	?>

	<tr>
		<td class="author-warning"><?= $comment['author'] ?></td>
		<td class="title-warning"><?= $comment['title'] ?></td>
		<td class="comment-warning"><?= $comment['comments'] ?></td>
		<td class="date-warning"><?= $comment['date'] ?></td>
		<td class="action-warning"><a href="<?= $GLOBALS['ROOT_URL_BACK'] ?>comment-valid-<?= $comment['id'] ?>.html"><i class="fas fa-check"></i></a> 
									<a href="<?= $GLOBALS['ROOT_URL_BACK'] ?>comment-delete-<?= $comment['id'] ?>.html"><i class="fas fa-trash-alt"></i></a> 
		</td>
	</tr>

	<?php
	}

	}
	?>
</table>
</div>