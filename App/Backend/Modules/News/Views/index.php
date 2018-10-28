<div class="title-admin col-lg-12">
	<h1>Tableau de bord</h1>
</div>

<div class="informations col-lg-12">
	<div class="news">
			<h2>Articles</h2>
			<p class="number"> <?= $nombreNews ?> </p>
	</div>

	<div class="comments">
		<h2>Commentaires</h2>
		<p class="number"><?= $nombreComments ?> </p>
	</div>
</div>

<div class="all-resume col-lg-12">
<table>
	<tr>
		<th class="author">Auteur</th>
		<th class="title">Titre</th>
		<th class="date">Date</th>
		<th class="action">Action</th>
	</tr>

	<?php
	foreach ($listNews as $news) {

		echo '<tr><td>'.$news['author'].'</td><td>'.$news['title'].'</td><td>'.$news['date'].'</td><td> <a href="news-update-'.$news['id'].'.html"><i class="fas fa-pen"></i></a> <a href="news-delete-'.$news['id'].'.html"><i class="fas fa-trash-alt"></i></a></td></tr>';
	}
	?>
</table>
</div>