<p>	Bonjour <?= $_SESSION['nom']?></p>

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
		<td><a href="comment-valid-'.$comment['id'].'.html"><i class="fas fa-check"></i></a> <a href="comment-delete-'.$comment['id'].'.html"><i class="fas fa-trash-alt"></i></a></td><td><i class="fas fa-star"></i></td></tr>';
	}
	?>
</table>
</div>

<p><a href="/admin/">Retour</a></p>