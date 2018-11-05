<?php

foreach ($listNews as $news){
?>

<div class="contenu col-xl-6">
	<h2><a href="news-<?= $news['id'] ?>.html"><?= $news['title'] ?></a></h2>
	<p><?= $news['content'] ?></p>
</div>

<?php
}
?>


<div class="button">
	<button type="button" class="btn btn-primary"><a href="/all-post.html">Voir tout les articles</a></button>
</div>