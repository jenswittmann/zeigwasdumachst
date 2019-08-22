<!DOCTYPE html>
<html>
	<head>
	    <title>Findr APP</title>
	    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
			<link rel="stylesheet" href="https://unpkg.com/tachyons@4.10.0/css/tachyons.min.css"/>
	    <link rel="stylesheet" type="text/css" href="css/jTinder.css">
	    <link rel="stylesheet" type="text/css" href="css/main.css?v2">
	</head>
	<body>

		<div class="app">

		    <h2 class="app-header">Findr APP</h2>

		    <div class="app-page">

				<div class="finder pb5">
		          	<div class="wrap">
		              	<div id="tinderslide">
		                  	<ul>
			                  	<?php
			      				# bibilothek initalisieren
			      				use InstagramScraper\Exception\InstagramException;
			      				require __DIR__ . '/vendor/autoload.php';
			      				$instagram = new \InstagramScraper\Instagram();

			      				# posts mit hashtag anfordern
			      				$medias = $instagram->getCurrentTopMediasByTagName('dessaumatchen');
			      				if (count($medias) > 0) {

				                    # tag filter
				                    if (isset($_GET['tag'])) {
				                      $tagFilter = $_GET['tag'];
				                    }

				  					# alle posts in schleife ausgeben
				  					foreach($medias as $media) {
				  						if (!isset($tagFilter) || (isset($tagFilter) && strpos($media->getCaption(), '#'.$tagFilter) !== false)) {
				  						?>
				  							<li data-post-id="<?php echo $media->getId(); ?>"
				  								data-post-img="<?php echo $media->getImageHighResolutionUrl(); ?>"
				  								data-post-content="<?php echo $media->getCaption(); ?>" class="pane1">
				  								<img src="<?php echo $media->getImageHighResolutionUrl(); ?>" width="300" alt="">
				  								<p class="f5 ma0"><?php echo $media->getCaption(); ?></p>
				  								<div class="like"></div>
				  								<div class="dislike"></div>
				  							</li>
				  						<?php
				  						}
				  					}

			  					}
			          			?>
		                  	</ul>
		              	</div>
		          	</div>

					<div class="actions">
						<a href="#" class="dislike"><i></i></a>
						<a href="#" class="like"><i></i></a>
					</div>

		    	</div>

		      	<div class="page page-start is-active">
					<div class="pa1">
						<p>
							Wir, vom Projekt „Zeig, was Du machst!”, arbeiten derzeit an einem Webportal für Dessau-Roßlau. Nach dem Tinder-Prinzip sollen algorithmusbasierte Empfehlungen für Aktivitäten und Veranstaltungen in der Stadt vorgeschlagen werden. Die Zielgruppe sind junge Menschen zwischen 12 und 27 Jahren. Die Anwendung nutzt Beiträge der Plattform Instagram, die mit dem Hashtag #dessaumatchen markiert sind. Wir würden uns freuen, wenn Interesse an einer Zusammenarbeit durch Verwendung des Hashtags besteht. Gerne können wir dann Weiteres klären.
						<p>
						<button class="btn-finder">Los geht's</button>
						<ul class="small">
							<li><a href="https://vonderrolle.org/impressum.html" target="_blank" class="mb2 db">Impressum</a></li>
							<li><a href="https://vonderrolle.org/datenschutzerklaerung.html" target="_blank">Datenschutzerklärung</a></li>
						</ul>
					</div>
				</div>

				<div class="page page-bookmarks">
					<div class="pa1">
						<h3>Bookmarks</h3>
						<div class="bookmark-list"></div>
					</div>
				</div>

				<div class="page page-share page-half white center bg-black">
					<div class="pa1">
						<h3>Share</h3>
						<ul>
							<li class="mb1"><a href="whatsapp://send?text=Teste%20die%20Findr%20APP%3A%20https%3A%2F%2Fprototyp.zeig-was-du-machst.de">WhatsApp</a></li>
							<li><a href="https://facebook.com/sharer/sharer.php?u=https%3A%2F%2Fprototyp.zeig-was-du-machst.de" target="_blank">Facebook</a></li>
						</ul>
					</div>
				</div>

		    </div>

		    <nav class="app-menu" role="navigation">
				<ul>
					<!--li class="btn-filter">
						<img src="img/filter.svg" alt="">
					</li-->
					<li class="btn-bookmarks">
						<img src="img/favorite.svg" alt="">
					</li>
					<li class="btn-share">
						<img src="img/share.svg" alt="">
					</li>
					<li class="btn-start">
						<img src="img/info.svg" alt="">
					</li>
				</ul>
		    </nav>

		</div>

		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/jquery.transform2d.js"></script>
		<script type="text/javascript" src="js/jquery.jTinder.js"></script>
		<script type="text/javascript" src="js/js.cookie.js"></script>
		<script type="text/javascript" src="js/main.js?v2"></script>

	</body>
</html>
