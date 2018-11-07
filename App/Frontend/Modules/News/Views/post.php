<div class="container container-post">

	<div class="post-text col-md-12 col-lg-12 col-xl-12">
		<div class="info-post col-md-12 col-lg-12 col-xl-12">
			<p>Par <em><?= $post['author'] ?></em>, le <?= $post['date']->format('d/m/Y à H\hi') ?></p>
		</div>

		<div class="title col-md-12 col-lg-12 col-xl-12">
			<h2 class="title-post"><?= $post['title'] ?></h2>
		</div>

		<p><?= nl2br($post['content']) ?></p>

	</div>

	<div class="container-comment container-text col-md-12 col-lg-12 col-xl-12">
		<p class="link-comment"><a href="comment-news-<?= $post['id'] ?>.html">Ajouter un commentaires</a></p>

		<?php
			if(empty($comments)){
		?>

		<p>Aucun commentaire. Tu n'as pas envie d'etre le premier??</p>

		<?php
			}

			foreach ($comments as $comment){
		?>
		
		<div class="comment">
			<p class="info-author">Posté par <?= htmlspecialchars($comment['author']) ?> le <?= $comment['date']->format('d/m/Y à H\hi') ?>

			<a class="link-warning" href="warning-comment-<?= $comment['id'] ?>.html">Signaler</a>

			</p>

			<p class="text-comment"><em><?= $comment['content'] ?></em></p>

			<?php
			}
			?>

		</div>
		
	</div>

</div>