<p>Il y a actuellement <?= $nombreNews ?> articles <p>

<table>
	<tr>
		<th>Auteur</th>
		<th>Titre</th>
		<th>Date</th>
		<th>Modification</th>
		<th>Action</th>
	</tr>

	<?php

	foreach ($listNews as $news) {

		echo '<tr><td>'.$news['author'].'</td><td>'.$news['title'].'</td><td>'.$news['date']->format('d/m/Y à H\hi').'</td><td>'.($news['date'] == $news('update_date') ? ' - ' : 'le '.$news['update_date']->format('d/m/Y à H\di')), '</td><td><a href="news-update-'.$news['id'].'.html">U</a> <a href="news-delete-'.$news['id'].'.html">X</a></td></tr>';
	}
	?>
</table>