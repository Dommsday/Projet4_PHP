
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
		foreach ($comments as $comment){
	?>
	<tr>
		<td class="author"><?= $comment['author'] ?></td>
		<td class="title"><?= $comment['title'] ?></td>
		<td class="content"><?= $comment['comments'] ?></td>
		<td class="date"><?= $comment['date'] ?></td>
		

		<?php
			if($comment['warning'] == 1){
			?>
				<td class="action"><i class="fas fa-star"></i>
					<a href="/test/Autoload/admin/comment-valid-<?=$comment['id'] ?>.html"><i class="fas fa-check"></i></a>
					<a href="/test/Autoload/admin/comment-delete-<?=$comment['id'] ?>.html"><i class="fas fa-trash-alt"></i></a>
				</td>'
		<?php
			}
		?>
		</tr>
		
	<?php
		}
	?>
</table>
</div>

<p><a class="link" href="<?= $GLOBALS['ROOT_URL'] ?>admin/">Retour</a></p>