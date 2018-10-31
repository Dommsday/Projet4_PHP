<div class="title-admin col-lg-12">
	<h1>Tableau de bord</h1>
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


<h2>Commentaires signalés</h2>

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
	foreach ($commentsWarning as $comment) {

		echo '<tr><td>'.$comment['author'].'</td>
		<td>'.$comment['news'].'</td>
		<td>'.$comment['content'].'</td>
		<td>'.$comment['date']->format('d/m/Y à H\hi').'</td>
		<td><a href="comment-valid-'.$comment['id'].'.html"><i class="fas fa-check"></i></a> <a href="comment-delete-'.$comment['id'].'.html"><i class="fas fa-trash-alt"></i></a></td></tr>';
	}
	?>
</table>
</div>