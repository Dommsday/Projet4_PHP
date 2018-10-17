<!DOCTYPE html>
<html>
<head>
	<title>
		<?= isset($title) ? $title : "Jean Forteroche: Billet simple pour l'Alaska"; ?>
	</title>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="/Web/css/layout.css" type="text/css" />
</head>

<body>
	<header class="container-fluid">
		<nav class="container">
			<ul class ="nav justify-content-end">
				<li class="nav-item">
					<a class="nav-link" href="/">Accueil</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/admin/">Admin</a>
				</li>
			</ul>
		</nav>
	</header>

	<section id="banniere" class="container-fluid">
		<div class="row">
			<img src="/Web/images/ban_Alaska.jpg" />
		</div>	
	</section>

	<section class="section-container container-fluid">
		<div class="container-contenu container">
			<div class="row">
				<?= $content ?>
			</div>
		</div>
	</section>

	<footer></footer>
</body>
</html>