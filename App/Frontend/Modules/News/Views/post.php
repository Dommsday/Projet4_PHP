<div class="container container-post">

	<div class="post-text col-md-12 col-lg-12 col-xl-12">
		<div class="info-post col-md-12 col-lg-12 col-xl-12">
			<p>Par <em><?= $post['author'] ?></em>, le <?= $post['date'] ?></p>
		</div>

		<div class="title col-md-12 col-lg-12 col-xl-12">
			<h2 class="title-post"><?= $post['title'] ?></h2>
		</div>

		<p><?= nl2br($post['content']) ?></p>

		<?php
			if($post['date'] != $post['updateDate']){
		?>
		<p><small><em>Modifié le <?= $post['updateDate'] ?></em></small></p>
		<?php
		}
		?>

	</div>

	<div class="container-comment container-text col-md-12 col-lg-12 col-xl-12">

		<?php
			if(!$user->isAuthenticated()){
		?>
		<p>Si vous voulez signaler un commentaire je vous invite à créer un compte ou à vous connectez :) </p>
			<p class="link-comment"><a href="<?=$GLOBALS['ROOT_URL']?>inscription.html">S'inscrire</a> / <a href="<?=$GLOBALS['ROOT_URL']?>connexion.html">Se connecter</a></p>
		<?php
		 }
		?>

		
			<p class="link-comment"><a href="comment-news-<?= $post['id'] ?>.html">Ajouter un commentaire</a></p>
		

		<?php
			if(empty($comments)){
		?>

		<p>Aucun commentaire. Tu n'as pas envie d'etre le premier??</p>

		<?php
			}

			foreach ($comments as $comment){
		?>
		
		<div class="comment">
			<p class="info-author">Posté par <?= htmlspecialchars($comment['author']) ?> le <?= $comment['date'] ?>

			<?php
				if($user->isAuthenticated() && $comment['reporting'] == 0){
			?>
			<a class="link-warning" href="warning-comment-<?= $comment['id'] ?>.html">Signaler</a>
			
			<?php 
			}
			?>
			</p>

			<p class="text-comment"><em><?= $comment['content'] ?></em></p>

			<?php
			}
			?>

		</div>
		
	</div>

</div>