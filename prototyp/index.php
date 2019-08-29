<!DOCTYPE html>
<html>
	<head>
	    <title>Findr</title>
	    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="css/tachyons.css">
	    <link rel="stylesheet" type="text/css" href="css/jTinder.css?v3">
	    <link rel="stylesheet" type="text/css" href="css/main.css?v3">
	</head>
	<body>

		<div class="app">

		    <h2 class="app-header f6 ttu normal tracked">Findr</h2>

		    <div class="relative app-page">

				<p class="absolute w-100 f6 tc pa4">
					<span class="f1 db">🙌🏻</span>
					Alles gematchted! Poste deine Tipps für Dessau-Roßlau auf Instagram mit dem Hashtag #dessaumatchen!
				</p>

				<div class="finder pb5">
		          	<div class="wrap ph2">
		              	<div id="tinderslide">
		                  	<ul>
			                  	<?php
													$allposts = json_decode(file_get_contents('instagram.json'), true );


													if (count($allposts) > 0) {

														# tag filter
														if (isset($_GET['tag'])) {
															$tagFilter = $_GET['tag'];
														}

														# alle posts in schleife ausgeben

														foreach( array_reverse($allposts) as $i => $post) {


														if (!isset($tagFilter) || (isset($tagFilter) && strpos($post['text'], '#'.$tagFilter) !== false)) {
												?>
														<li data-post-id="<?php echo $post['id']; ?>"
															data-post-img="<?php echo $post['img']; ?>"
														data-post-content="<?php echo $post['text']; ?>" class="pane<?php echo $i + 1; ?>">
														<img src="<?php echo $post['img']; ?>" width="300" alt="">
														<p class="f6 hyphens-auto ma0"><?php echo $post['text']; ?></p>
														</li>
												<?php
												}
										}

						}
			          			?>
		                  	</ul>
		              	</div>
		          	</div>

					<!--div class="actions">
						<a href="#" class="dislike"><i></i></a>
						<a href="#" class="like"><i></i></a>
					</div-->

		    	</div>

		      	<div class="page page-info shadow-1">
					<div class="pa3">
						<h3>Worum geht's?</h3>
						<p>
							Die Zielgruppe sind junge Menschen zwischen 12 und 27 Jahren. Die Anwendung nutzt Beiträge der Plattform Instagram, die mit dem Hashtag <strong class="bg-yellow">#dessaumatchen</strong> markiert sind. Wir würden uns freuen, wenn Interesse an einer Zusammenarbeit durch Verwendung des Hashtags besteht. Gerne können wir dann Weiteres klären.
						<p>
						<h3>Wie funktioniert es?</h3>
						<img src="img/swipe.gif" alt="Swipe Anleitung">
						<h3>Wie kann ich mitmachen?</h3>
						<p>
							Wir, vom Projekt „Zeig, was Du machst!”, arbeiten derzeit an einem Webportal für Dessau-Roßlau. Nach dem Tinder-Prinzip sollen algorithmusbasierte Empfehlungen für Aktivitäten und Veranstaltungen in der Stadt vorgeschlagen werden.
						<p>
						<h3>Alles klar?</h3>
						<p>
							<a href="#!" data-open-wrapper="info" class="nav-toggle db tc ph1 pv2 bg-dark br2">loslegen</a>
						</p>
						<ul class="list f7 pa0 mt5">
							<li><a href="https://vonderrolle.org/impressum.html" target="_blank" class="mb2 db">Impressum</a></li>
							<li><a href="https://vonderrolle.org/datenschutzerklaerung.html" target="_blank">Datenschutzerklärung</a></li>
						</ul>
					</div>
				</div>

				<div class="page page-favorite shadow-1">
					<div class="pa3">
						<div class="favorite-list"></div>
					</div>
				</div>

				<div class="page page-share page-half shadow-1">
					<div class="pa1">
						<h3 class="tc">Teile uns!</h3>
						<p class="tc">
							Teile unsere APP mit deinen Freunden:
						</p>
						<ul class="list pa0">
							<li class="mb3"><a href="whatsapp://send?text=Teste%20die%20Findr%20APP%3A%20https%3A%2F%2Fprototyp.zeig-was-du-machst.de" class="db tc ph1 pv2 bg-dark br2">WhatsApp</a></li>
							<li><a href="https://facebook.com/sharer/sharer.php?u=https%3A%2F%2Fprototyp.zeig-was-du-machst.de" target="_blank" class="db tc ph1 pv2 bg-dark br2">Facebook</a></li>
						</ul>
					</div>
				</div>

		    </div>

		    <nav class="app-menu" role="navigation">
				<ul class="mw5 ma0 center">
					<!--li class="btn-filter">
						<img src="img/filter.svg" alt="">
					</li-->
					<li data-open-wrapper="favorite" class="nav-toggle nav-favorite btn-favorite">
						<?php echo file_get_contents('img/favorite.svg'); ?>
					</li>
					<li data-open-wrapper="share" class="nav-toggle nav-share">
						<?php echo file_get_contents('img/share.svg'); ?>
					</li>
					<li data-open-wrapper="info" class="nav-toggle nav-info">
						<?php echo file_get_contents('img/info.svg'); ?>
					</li>
				</ul>
		    </nav>

		</div>

		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/jquery.transform2d.js"></script>
		<script type="text/javascript" src="js/jquery.jTinder.js"></script>
		<script type="text/javascript" src="js/js.cookie.js"></script>
		<script type="text/javascript" src="js/main.js?v3"></script>

	</body>
</html>
