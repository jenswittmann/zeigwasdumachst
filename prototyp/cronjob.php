<?php
	
# variablen
$allPosts = [];
$emailPosts = [];
$emailTo = 'hallo@zeigwasdumachst.de';
$emailFrom = 'adam@zeigwasdumachst.de';
$emailSubject = 'Neue Instagramposts';
	
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
		
		# daten für datei
		$thisPost = [
			'id' => $media->getId(),
			'img' => $media->getImageHighResolutionUrl(),
			'text' => $media->getCaption()
		];	
		$allPosts[] = $thisPost;
		
		# daten für email
		$emailPosts[] = '
			<p>
				<img src="'.$thisPost['img'].'">
				'.$thisPost['text'].'
			</p>
		';	
	}

}

# posts in datei schreiben
file_put_contents('instagram.json', json_encode( $allPosts ) );

# email versenden
$header[] = 'MIME-Version: 1.0';
$header[] = 'Content-type: text/html; charset=UTF-8';
$header[] = 'To: '.$emailTo;
$header[] = 'From: '.$emailFrom;
mail($emailTo, $emailSubject, implode('', $emailPosts), implode("\r\n", $header) );