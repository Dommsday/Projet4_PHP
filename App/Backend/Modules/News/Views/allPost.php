<div class="all-resume col-lg-12 col-xl-12">
<table>
	<tr>
		<th class="title">Titre</th>
		<th class="date">Date</th>
		<th class="updateDate">Date de Modification</th>
		<th class="nbrComments">Commentaires</th>
		<th class="action">Action</th>
	</tr>

	<?php
	foreach ($listNews as $news) {
	?>

	<tr>
		<td class="title"><a href="../news-<?= $news['id'] ?>.html"><?= $news['title'] ?></a></td>
		<td class="date"><?= $news['date'] ?></td>
		<td class="updateDate">
			<?php
				if($news['date'] != $news['updateDate']){
			?>
				<p><?= $news['updateDate'] ?></p>
			<?php
			}else{
			?>
			<p>-</p>
			<?php
			}
			?>
		</td>
		<td class="nbrComments"><p><?= $news['total'] ?></p></td>
		<td class="action"><a href="news-update-<?= $news['id'] ?>.html"><i class="fas fa-pen"></i></a>
			<a href="news-delete-<?= $news['id'] ?>.html"><i class="fas fa-trash-alt"></i></a></td>
	</tr>

	<?php
	}
	?>

</table>
</div>

<p><a class="link " href="<?= $GLOBALS['ROOT_URL_BACK'] ?>">Retour</a></p>