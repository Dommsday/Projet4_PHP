<div class="container container-allpost">

		<?php
			foreach ($listNews as $news) {
		?>

	<div class="all-post-text col-lg-12">

		<div class="title-all-post col-xl-12">
			<h2><a href="../news-<?= $news['id'] ?>.html"><?= $news['title'] ?></a></h2>
		</div>

		<div class="info-comment col-xl-12">
			<?= $news['date'] ?>
		</div>

		<?= $news['content'] ?>

	</div>
		<?php
		}
		?>
</div>