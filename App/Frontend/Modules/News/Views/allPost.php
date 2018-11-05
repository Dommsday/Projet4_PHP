<?php
	foreach ($listNews as $news) {
	?>

	<tr>
		<td><a href="../news-<?= $news['id'] ?>.html"><?= $news['title'] ?></a></td>
		<td><?= $news['date'] ?></td>
		<td><?= $news['content'] ?></td>
	</tr>

	<?php
	}
	?>