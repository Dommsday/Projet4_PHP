<div class="containt-admin title col-lg-12">
	<h1 class="title-admin">Tableau de bord</h1>
</div>

<div class="informations col-lg-12">
	<div class="news">
			<a href="/admin/all-post.html"><h2>Articles</h2></a>
			<p class="number"> <?= $nombreNews ?> </p>
	</div>

	<div class="comments">
		<a href="/admin/all-comments.html"><h2>Commentaires</h2></a>
		<p class="number"><?= $nombreComments ?> </p>
	</div>
</div>

<div class="title col-xl-12">
		<h2 class="title-admin">Commentaires signalés</h2>
</div>

<div class="warning-comments col-lg-12">
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
		<td><?= $comment['author'] ?></td>
		<td><?= $comment['title'] ?></td>
		<td><?= $comment['comments'] ?></td>
		<td><?= $comment['date'] ?></td>
		<td><a href="comment-valid-<?= $comment['id'] ?>.html"><i class="fas fa-check"></i></a> 
			<a href="comment-delete-<?= $comment['id'] ?>.html"><i class="fas fa-trash-alt"></i></a> </td>
	</tr>

	<?php
	}

	}
	?>
</table>
</div>