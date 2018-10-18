<form action="" method="post">
  <p>
    <?= isset($erreurs) && in_array(\Entity\News::AUTEUR_INVALIDE, $erreurs) ? 'L\'auteur est invalide.<br />' : '' ?>
    <label>Auteur</label>
    <input type="text" name="auteur" value="<?= isset($post) ? $post['author'] : '' ?>" /><br />
    
    <?= isset($erreurs) && in_array(\Entity\News::TITRE_INVALIDE, $erreurs) ? 'Le titre est invalide.<br />' : '' ?>
    <label>Titre</label><input type="text" name="titre" value="<?= isset($post) ? $post['title'] : '' ?>" /><br />
    
    <?= isset($erreurs) && in_array(\Entity\News::CONTENU_INVALIDE, $erreurs) ? 'Le contenu est invalide.<br />' : '' ?>
    <label>Contenu</label><textarea rows="8" cols="60" name="contenu"><?= isset($post) ? $post['content'] : '' ?></textarea><br />
<?php
if(isset($post) && !$post->idNew())
{
?>
    <input type="hidden" name="id" value="<?= $post['id'] ?>" />
    <input type="submit" value="Modifier" name="modifier" />
<?php
}
else
{
?>
    <input type="submit" value="Ajouter" />
<?php
}
?>
  </p>
</form>