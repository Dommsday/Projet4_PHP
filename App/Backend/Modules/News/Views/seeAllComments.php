
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
		foreach ($comments as $comment){
	?>
		<tr><td><?= $comment['author_comment'] ?></td>
		<td><?= $comment['title_news'] ?></td>
		<td><?= $comment['content_comment'] ?></td>
		
		
		<?php
			if($comment['warning_comment'] == 1){
				echo '<td><i class="fas fa-star"></i>
						  <a href="comment-valid-'.$comment['id_comment'].'.html"><i class="fas fa-check"></i></a>
						  <a href="comment-delete-'.$comment['id_comment'].'.html"><i class="fas fa-trash-alt"></i></a>
					  </td>';
			}
		?>
		</tr>



	<?php
		}
	?>
</table>
</div>

<p><a href="/admin/">Retour</a></p>