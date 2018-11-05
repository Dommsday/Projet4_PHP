<div class="all-resume col-lg-12">
<table>
	<tr>
		<th class="title">Titre</th>
		<th class="date">Date</th>
		<th class="action">Action</th>
	</tr>

	<?php
	foreach ($listNews as $news) {
	?>

	<tr>
		<td><a href="../news-<?= $news['id'] ?>.html"><?= $news['title'] ?></a></td>
		<td><?= $news['date'] ?></td>
		<td><a href="news-update-<?= $news['id'] ?>.html"><i class="fas fa-pen"></i></a>
			<a href="news-delete-<?= $news['id'] ?>.html"><i class="fas fa-trash-alt"></i></a></td>
	</tr>

	<?php
	}
	?>

</table>
</div>

<p><a href="/admin/">Retour</a></p>