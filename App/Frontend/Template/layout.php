<!DOCTYPE html>
<html>
<head>
	<title>
		<?= isset($title) ? $title : "Jean Forteroche: Billet simple pour l'Alaska"; ?>
	</title>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="/Web/css/layout.css" type="text/css" />
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css" integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns" crossorigin="anonymous">
	
	<link href="https://fonts.googleapis.com/css?family=Puritan" rel="stylesheet">
</head>

<body>
	<header class="container-fluid">

		<div class="container-header">
			<div class="logo">
                <a href="#"><img src="/Web/images/logo-alaska.png" alt="logo" style="width:80px; height: 80px;"/></a>
            </div>

            <nav class="header_nav">
				<ul class ="nav justify-content-end">
					<li class="nav-item">
							<a class="nav-link" href="/">Accueil</a>
					</li>
					
					<li class="nav-item">
							<a class="nav-link" href="/all-post.html">Articles</a>
					</li>

					<li class="nav-item">
						<a class="nav-link" href="/admin/">Admin</a>
					</li>

					<?php
						if($user->isAuthenticated()){
					?>
						<li class="nav-item">
							<a class="nav-link" href="/admin/news-insert.html">Ajouter un article</a>
						</li>
					<?php
						}
					?>
					
				</ul>
			</nav>

		</div>
	</header>

	<section id="banniere">
		<div class="ban">
			<img src="/Web/images/ban_Alaska.jpg" alt="Baleine" />
		</div>	
	</section>

	<section class="section-container container-fluid">
		<div class="container-contenu container">
			<div class="row">
			 
			     <?php if($user->hasMessage()){
                            
                            echo $user->getMessage();
                        }
                ?>
				<?= $content ?>
			</div>
		</div>
	</section>

	<footer></footer>

	<script src='https://cloud.tinymce.com/stable/tinymce.min.js'></script>

	<script>
  		tinymce.init({
    		selector: '#mytextarea'
  		});
  	</script>
</body>
</html>