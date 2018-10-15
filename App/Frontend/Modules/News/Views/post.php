<p>Par <em><?= $post['author'] ?></em>, le <?= $post['date']->format('d/m/Y à H\hi') ?></p>
<h2><?= $post['title'] ?></h2>
<p><?= nl2br($post['content']) ?></p>