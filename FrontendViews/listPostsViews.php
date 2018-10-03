<?= $title = 'Saluuuuuuuuuut'; ?>

<?php ob_start(); ?>

	<h1>Les derniers articles</h1>

	<?php
		while($data = $req->fetch()){
	?>

		<div class="news">
			<h3>
				<?= htmlspecialchars($data['title']); ?>
				<em>le <?= $data['date_fr']; ?></em>
			</h3>

			<p>
				<?= nl2br(htmlspecialchars($data['content'])); ?>
				<br />
			</p>
		</div>
	<?php
	}
	$req->closeCursor();
	?>

	<?= $content = ob_get_clean(); ?>
	<?= require('FrontendViews/layout.php'); ?>
