<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finder App</title>
    <link rel="stylesheet" type="text/css" href="css/jTinder.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
  <div class="app">
    <div class="app-header">
      <a href="#" class="header-logo" title="Zeig, was Du machst!">Zeig, was Du machst!</a>
    </div>

    <div class="app-page">
      <div class="page page-start">
          <h1>LOGO</h1>
          <p>
            Wir, vom Projekt „Zeig, was Du machst!”, arbeiten derzeit an einem Webportal
             für Dessau-Roßlau. Nach dem Tinder-Prinzip sollen algorithmusbasierte
             Empfehlungen für Aktivitäten und Veranstaltungen in der Stadt vorgeschlagen
             werden. Die Zielgruppe sind junge Menschen zwischen 12 und 27 Jahren.
             Die Anwendung nutzt Beiträge der Plattform Instagram, die mit dem
             Hashtag #dessaumatchen markiert sind. Wir würden uns freuen,
             wenn Interesse an einer Zusammenarbeit durch Verwendung des Hashtags
              besteht. Gerne können wir dann Weiteres klären :leichtes_lächeln:
          <p>
          <button class="btn-finder">Los geht's</button>
      </div>
      <div class="page page-finder">
          <h1>FINDER APP</h1>

          <button class="btn-bookmarks">Gespeicherte Posts anzeigen</button>
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
      </div>
      <div class="page page-bookmarks">
          <h1>BOOKMARKS</h1>
      </div>
    </div>

    <nav class="app-menu" role="navigation">
      <ul>
        <li>Filter</li>
        <li>Bookmarks</li>
        <li>Share</li>
        <li>Info</li>
      </ul>
    </nav>
  </div>

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
