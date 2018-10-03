<!DOCTYPE html>
<html>
<head>
	<title>
		<?= isset($title) ? $title : "Jean Forteroche: Billet simple pour l'Alaska"; ?>
	</title>
	<meta charset="utf-8" />
</head>

<body>
	<header>
		<nav>
			<ul>
				<li><a href="/">Accueil</a></li>
				<li><a href="/admin">Admin</a></li>
			</ul>
		</nav>
	</header>

	<section>
		<?= $content ?>
	</section>

	<footer></footer>
</body>
</html>