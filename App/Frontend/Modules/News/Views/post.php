<p>Par <em><?= $news['author'] ?></em>, le <?= $news['date']->format('d/m/Y à H\hi') ?></p>
<h2><?= $news['title'] ?></h2>
<p><?= nl2br($news['content']) ?></p>

<?php if ($news['date'] != $news['update_date']) { ?>
  <p style="text-align: right;"><small><em>Modifiée le <?= $news['update_date']->format('d/m/Y à H\hi') ?></em></small></p>
<?php } ?>