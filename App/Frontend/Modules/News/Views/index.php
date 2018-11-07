<?php

foreach ($listNews as $news){
?>

<div class="contenu col-md-6 col-lg-4 col-xl-4">
	<h2 class="title-index"><a href="news-<?= $news['id'] ?>.html"><?= $news['title'] ?></a></h2>
	<p><?= $news['content'] ?></p>
</div>

<?php
}
?>

<div class="button">
	<button type="button" class="btn btn-primary"><a href="/all-post.html">Voir tout les articles</a></button>
</div>