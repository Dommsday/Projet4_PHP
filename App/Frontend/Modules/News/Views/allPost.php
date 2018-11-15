
<div class="container container-all-post">

		<?php
			foreach ($listNews as $news) {
		?>

	<div class="all-post-text col-md-12 col-lg-12 col-xl-12">

		<div class="title-all-post">
			<h2 class="title-post"><a href="<?= $GLOBALS['ROOT_URL'] ?>news-<?= $news['id'] ?>.html"><?= $news['title'] ?></a></h2>
		</div>

		<div class="info-comment">
			<?= $news['date'] ?>
		</div>

		<div class="container-text">
			<?= $news['content'] ?>
		</div>
	</div>
		<?php
		}
		?>
</div>