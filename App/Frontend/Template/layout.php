<!DOCTYPE html>
<html>
<head>
	<title>
		<?= isset($title) ? $title : "Jean Forteroche: Billet simple pour l'Alaska"; ?>
	</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Depuis quelques temps maintenant, j'ai commencé l'écriture de mon nouveau roman 'Billet simple pour l'Alaska'.Cependant, j'ai voulu innover en publiant mon roman sur mon blog. Le fonctionnement est très simple, je publie régulièrement par 'épisode', des petits chapitres de mon roman.">

	<!--LIEN BOOTSTRAP-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

	<!--FICHIER CSS-->
	<link rel="stylesheet" href="/Web/css/layout.css" type="text/css" />
	<link rel="stylesheet" href="/Web/css/resolution_screen.css" media="screen and (min-width: 992px) and (max-width: 1199px)" type="text/css" />
	<link rel="stylesheet" href="/Web/css/resolution_tablette.css" media="screen and (min-width: 768px) and (max-width: 991px)" type="text/css" />
	<link rel="stylesheet" href="/Web/css/resolution_phone.css" media="screen and (max-width: 767px)" type="text/css" />
	
	<!--FICHIER DES ICONES-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css" integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns" crossorigin="anonymous">

	<!--FICHIER POLICE D'ECRITURE-->
	<link href="https://fonts.googleapis.com/css?family=Puritan" rel="stylesheet">

	<!--FACEBOOK-->
    <meta property="og:title" content="Jean Forteroche">
    <meta property="og:type" content="website">
    <meta property="og:url" content="http://www.julien-zimmermann.fr/blog/Projet4_PHP/Autoload/">
    <meta property="og:image" content=" ">
    <meta property="og:description" content="Depuis quelques temps maintenant, j'ai commencé l'écriture de mon nouveau roman 'Billet simple pour l'Alaska'.Cependant, j'ai voulu innover en publiant mon roman sur mon blog. Le fonctionnement est très simple, je publie régulièrement par 'épisode', des petits chapitres de mon roman.">
        
    <!--TWITTER-->
    <meta name="twitter:card" content="summary">
    <meta name="twitter:description" content="J'ai commencé l'écriture de mon nouveau roman 'Billet simple pour l'Alaska'."/>
    <meta name="twitter:site" content=" ">
</head>

<body>

	<!--MENU NAVIGATION-->
	<header class="container-fluid">
		
            <nav class="navbar navbar-expand-md navbar-light">

                <a  class="navbar-brand" href="/">Jean Forteroche</a>

            	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            	<span class="navbar-toggler-icon"></span>
            	</button>

				<div class="collapse navbar-collapse" id="navbarSupportedContent">

					<ul class ="navbar-nav mr-auto">
						<li class="nav-item">
							<a class="nav-link" href="/">Accueil</a>
						</li>

						<li class="nav-item">
							<a class="nav-link" href="/all-post.html">Articles</a>
						</li>
						
						<?php
							if(!$user->isAuthenticated()){
						?>
						<li class="nav-item">
							<a class="nav-link" href="/inscription.html">S'incrire</a>
						</li>
						<?php
						}
						?>

						<?php  
							if($user->isAuthenticated()){
						?>
						<li class="nav-item">
							<a class="nav-link" href="/"><i class="fas fa-user"></i></a>
						</li>
						<?php  
						}
						?>

						<?php
							if(!$user->isAuthenticated()){
						?>
						<li class="nav-item">
							<a class="nav-link" href="/connexion.html">Se connecter</a>
						</li>
						<?php  
						}
						?>
					</ul>

				</div>
			</nav>
	</header>
	<!--FIN MENU NAVIGATION-->

	<!--BANNIERE-->
	<section class="container-fluid" id="banniere">
		<div class="ban">
			<img class="img-fluid" src="/Web/images/montagne.jpg" alt="Baleine Responsive image" />
		</div>

		<div class="intro texte_banniere">
             <h1><strong>Un billet simple pour l'Alaska</strong></h1>
        </div>	
	</section>
	<!--FIN BANNIERE-->

	<!--CONTENU DES DERNIERES NEWS-->
	<section class="section-container container-fluid">
		<div class="container-contenu container">

			<div class="row">
			
				<?= $content ?>
			</div>
		</div>
	</section>
	<!--FIN CONTENU DES DERNIERES NEWS-->

	<!--FOOTER-->
	<footer>
		<div class="items-footer">
			<p class="icon-footer copyright">© Copyright 2018</p>
			<p class="icon-footer facebbok"><a href="#"><i class="fab fa-facebook-square"></i></a></p>
			<p class="icon-footer twitter"><a href="#"><i class="fab fa-twitter-square"></i></a></p>
			<p class="icon-footer instagram"><a href="#"><i class="fab fa-instagram"></i></a></p>
		</div>
	</footer>


	<!--PARTIE FORMULAIRE TINYMCE-->
	<script src='https://cloud.tinymce.com/stable/tinymce.min.js'></script>

	<script>
  		tinymce.init({
    		selector: '#mytextarea'
  		});
  	</script>
  	<!--FIN PARTIE FORMULAIRE TINYMCE-->
</body>
</html>