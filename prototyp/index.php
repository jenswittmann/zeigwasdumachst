<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finder App</title>
    <link rel="stylesheet" type="text/css" href="css/jTinder.css">
</head>
<body>
    <!-- start padding container -->
    <div class="wrap">
        <!-- start jtinder container -->
        <div id="tinderslide">
            <ul>
    
			    <?php
				
				# bibilothek initalisieren
				use InstagramScraper\Exception\InstagramException;
				require __DIR__ . '/vendor/autoload.php';
				$instagram = new \InstagramScraper\Instagram();
				
				# posts mit hashtag anfordern
				$medias = $instagram->getCurrentTopMediasByTagName('dessau');
			
				if (count($medias) > 0) {
				
					# alle posts in schleife ausgeben
					foreach($medias as $media) {
			
						if (strpos($media->getCaption(), '#'.$_GET['tag']) !== false) {
							
						
						?>
							<li class="pane1">
								<img src="<?php echo $media->getImageHighResolutionUrl(); ?>" width="300" alt="">
								<div style="font-size: 10px;"><?php echo $media->getCaption(); ?></div>
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
        <!-- end jtinder container -->
    </div>
    <!-- end padding container -->

    <!-- jTinder trigger by buttons  -->
    <div class="actions">
        <a href="#" class="dislike"><i></i></a>
        <a href="#" class="like"><i></i></a>
    </div>

    <!-- jTinder status text  -->
    <div id="status"></div>

    <!-- jQuery lib -->
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <!-- transform2d lib -->
    <script type="text/javascript" src="js/jquery.transform2d.js"></script>
    <!-- jTinder lib -->
    <script type="text/javascript" src="js/jquery.jTinder.js"></script>

    <script type="text/javascript" src="js/js.cookie.js"></script>
    <!-- jTinder initialization script -->
    <script type="text/javascript" src="js/main.js"></script>
</body>
</html>
