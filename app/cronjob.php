<?php

# variablen
$allPosts = [];
$emailPosts = [];
$emailTo = 'hallo@zeigwasdumachst.de';
$emailFrom = 'adam@zeigwasdumachst.de';
$emailSubject = 'Neue Instagramposts';
$blacklistUrl = 'https://findr.zeigwasdumachst.de/blacklist.php?id=';

# bibilothek initalisieren
use InstagramScraper\Exception\InstagramException;
require __DIR__ . '/vendor/autoload.php';
$instagram = new \InstagramScraper\Instagram();

# posts mit hashtag anfordern
$medias = $instagram->getMediasByTag('dessaumatchen', 30);

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

		# daten für datei
		$thisPost = [
			'id' => $media->getId(),
			'img' => $media->getImageHighResolutionUrl(),
			'text' => $caption
		];
		$allPosts[] = $thisPost;

		if ($thisPost['id'] > $lastPostId) {

			# daten für email
			$emailPosts[] = '
				<p style="max-width: 300px; border-bottom: 2px solid black;">
					<img src="'.$thisPost['img'].'" width="100%">
					'.$thisPost['text'].'<br>
					<a href="'.$blacklistUrl.$thisPost['id'].'">Post verbergen</a>
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
