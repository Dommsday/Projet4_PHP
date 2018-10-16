<div class="title col-xl-12">
	<h2>Ajouter un commentaire</h2>
</div>

<div class="form col-xl-12">
	<form action="" method="post">
		<div class="form-group">
			<?= isset($erreurs) && in_array(\Entity\Comment::AUTEUR_INVALIDE, $erreurs) ? 'L\'auteur est invalide <br />' : '' ?>
			<label>Pseudo</label>
			<input type="text" name="pseudo" value="<?= isset($comment) ? htmlspecialchars($comment['author']) : '' ?>" class="form-control" placeholder="Entrez votre pseudo"/><br />

			<?= isset($erreurs) && in_array(\Entity\Comment::CONTENU_INVALIDE, $erreurs) ? 'Le commentaire n\'est pas valide <br />' : '' ?>
			<label>Message</label>
			<textarea name="content" class="form-control" rows="7" cols="50" placeholder="Votre message"><?= isset($comment) ? htmlspecialchars($comment['content']) : '' ?></textarea>
		</div>

			<input type="submit" class="btn btn-primary" value="Ajouter" />

	</form>
</div>
