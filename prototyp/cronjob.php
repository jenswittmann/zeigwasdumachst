<?php
#Variablen
$allposts=[];

# bibilothek initalisieren
  use InstagramScraper\Exception\InstagramException;
  require __DIR__ . '/vendor/autoload.php';
  $instagram = new \InstagramScraper\Instagram();

  # posts mit hashtag anfordern
  $medias = $instagram->getMediasByTag('dessaumatchen', 25);
  if (count($medias) > 0) {

          # tag filter
          if (isset($_GET['tag'])) {
            $tagFilter = $_GET['tag'];
          }

  # alle posts in schleife ausgeben
  foreach( array_reverse($medias) as $i => $media) {
    $allposts [] = [
     'id' => $media->getId(),
     'img' => $media->getImageHighResolutionUrl(),
     'text' => $media->getCaption()
   ];
  }

}

#posts in datei schreiben
file_put_contents('instagram.json',json_encode( $allposts ) );
