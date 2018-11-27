<?php
	if(!$user->isAuthenticated()){
?>
<div class="title col-md-12 col-lg-12 col-xl-12">
	<h2 class="title-form">Connexion</h2>
</div>
<?php  
}
?>

<?php
	if(!$user->isAuthenticated()){
?>
<div class="form col-md-12 col-lg-12 col-xl-12">
	<form action="" method="post">
		<div class="form-group">
			
			<?= $authorconnexionform ?>
		
		</div>
			<input type="submit" class="btn btn-primary" value="Connexion" />

	</form>
</div>
<?php 

}else{

?>

<div class="confirmation confirmation-inscription">
	<h1><i class="fas fa-check-circle"></i>Vous êtes déjà connecté </h1>

	<p><a class="link link-confimration" href="/">Accueil</a></p>
</div>

<?php  
}
?>
