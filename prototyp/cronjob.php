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

# aktuelle posts auslesen
$lastPost = array_pop( json_decode( file_get_contents('instagram.json'), true ) );
$lastPostId = $lastPost['id'];

if (count($medias) > 0) {
		
	# alle posts in schleife ausgeben
	foreach( array_reverse($medias) as $i => $media) {
		
		# daten für datei
		$thisPost = [
			'id' => $media->getId(),
			'img' => $media->getImageHighResolutionUrl(),
			'text' => $media->getCaption()
		];	
		$allPosts[] = $thisPost;
		
		if ($thisPost['id'] > $lastPostId) {
		
			# daten für email
			$emailPosts[] = '
				<p style="max-width: 300px; border-bottom: 2px solid black;">
					<img src="'.$thisPost['img'].'" width="100%">
					'.$thisPost['text'].'
				</p>
			';
			
		}
	}

}

# posts in datei schreiben
file_put_contents('instagram.json', json_encode( $allPosts ) );

# email versenden
if ( count($emailPosts) > 0 ) {
	$header[] = 'MIME-Version: 1.0';
	$header[] = 'Content-type: text/html; charset=UTF-8';
	$header[] = 'From: '.$emailFrom;
	mail($emailTo, $emailSubject, implode('', $emailPosts), implode("\r\n", $header) );
}