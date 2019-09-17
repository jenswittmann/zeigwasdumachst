<?php

# variablen
$allPosts = [];
$emailSend = false;
$emailPosts = [];
$emailTo = 'hallo@zeigwasdumachst.de';
$emailFrom = 'adam@zeigwasdumachst.de';
$emailSubject = 'Neue Instagramposts';
$blacklistUrl = 'https://findr.zeigwasdumachst.de/blacklist.php?id=';
$imgUrl = 'https://findr.zeigwasdumachst.de/';

# bibilothek initalisieren
use InstagramScraper\Exception\InstagramException;
require __DIR__ . '/vendor/autoload.php';
require 'SimpleImage.php';
$instagram = new \InstagramScraper\Instagram();

# posts mit hashtag anfordern
$medias = $instagram->getMediasByTag('dessaumatchen', 25);

# aktuelle posts auslesen
$lastPosts = json_decode( file_get_contents('instagram.json'), true );
$lastPost = array_pop($lastPosts);
$lastPostId = $lastPost['id'];

if (count($medias) > 0) {

	# alle posts in schleife ausgeben
	foreach( array_reverse($medias) as $i => $media) {

		$caption = $media->getCaption();

		# urls in beschreibung verlinken
		$regexUrl = '/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/';

		if (preg_match($regexUrl, $caption, $url)) {
			$caption = preg_replace($regexUrl, '<a href="'.$url[0].'" target="_blank">'.$url[0].'</a> ', $caption);
		}

		# bilder klein rechnen
		$imageName = 'cache/'.$media->getId().'.jpg';
		$image = new \claviska\SimpleImage();
		$image
	    ->fromString( file_get_contents( $media->getImageHighResolutionUrl() ) )
	    ->resize(500, null)
	    ->toFile($imageName, 'image/jpeg');

		# daten für datei
		$thisPost = [
			'id' => $media->getId(),
			'img' => $imageName,
			'text' => $caption
		];
		$allPosts[] = $thisPost;
		
		# daten für email
		$emailPosts[] = '
			<p style="max-width: 300px; border-bottom: 2px solid black;">
				<img src="'.$imgUrl.$thisPost['img'].'" width="100%">
				'.$thisPost['text'].'<br>
				<a href="'.$blacklistUrl.$thisPost['id'].'">Post verbergen</a>
			</p>
		';

		if ($thisPost['id'] > $lastPostId) {
			$emailSend = true;
		}
	}

}

# posts in datei schreiben
file_put_contents('instagram.json', json_encode( $allPosts ) );

# email versenden
if ( $emailSend == true ) {
	$header[] = 'MIME-Version: 1.0';
	$header[] = 'Content-type: text/html; charset=UTF-8';
	$header[] = 'From: '.$emailFrom;
	mail($emailTo, $emailSubject, implode('', array_reverse($emailPosts) ), implode("\r\n", $header) );
}
