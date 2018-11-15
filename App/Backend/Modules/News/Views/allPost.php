<div class="all-resume col-lg-12 col-xl-12">
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
		<td class="title"><a href="/test/Autoload/admin/news-<?= $news['id'] ?>.html"><?= $news['title'] ?></a></td>
		<td class="date"><?= $news['date'] ?></td>
		<td class="action"><a href="/test/Autoload/admin/news-update-<?= $news['id'] ?>.html"><i class="fas fa-pen"></i></a>
			<a href="/test/Autoload/admin/news-delete-<?= $news['id'] ?>.html"><i class="fas fa-trash-alt"></i></a></td>
	</tr>

	<?php
	}
	?>

</table>
</div>

<p><a class="link " href="<?= $GLOBALS['ROOT_URL'] ?> admin/">Retour</a></p>