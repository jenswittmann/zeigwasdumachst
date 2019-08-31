<!DOCTYPE html>
<html>
	<head>
	    <title>Findr</title>
	    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="css/tachyons.css">
	    <link rel="stylesheet" type="text/css" href="css/jTinder.css?v5">
	    <link rel="stylesheet" type="text/css" href="css/main.css?v5">
	    <link rel="manifest" href="manifest.json">
		<link rel="icon" href="img/favicon.png">
	</head>
	<body>

		<div class="app">

		    <h2 class="app-header f6 ttu normal tracked">Findr</h2>

		    <div class="relative app-page">

				<p class="absolute z-1 w-100 f6 tc pa4">
					<span class="f1 db">🙌🏻</span>
					Alles gematchted! Poste deine Tipps für Dessau-Roßlau auf Instagram mit dem Hashtag #dessaumatchen!
					<a href="javascript:tinderInit()" class="db tc ph1 pv2 mt2 bg-dark br2">Aktualisieren</a>
				</p>

				<div class="finder pb5">
		          	<div class="tinder wrap ph3"></div>
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
							<a href="#!" data-open-wrapper="info" class="nav-toggle db tc ph1 pv2 mb2 bg-dark br2">loslegen</a>
							<a href="javascript:install()" class="db tc ph1 pv2 mb2 bg-dark br2">zum Startbildschirm hinzufügen</a>
							<a href="javascript:requestPermission()" class="db tc ph1 pv2 mb2 bg-dark br2">Push Nachrichten aktivieren</a>
							<span class="f7">Push Nachrichten aktiviert: <span id="pushstatus">unavailable</span></span>
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
					<div class="pa3">
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
					<li data-open-wrapper="favorite" class="db nav-toggle nav-favorite btn-favorite">
						<?php echo file_get_contents('img/favorite.svg'); ?>
					</li>
					<li data-open-wrapper="share" class="db nav-toggle nav-share">
						<?php echo file_get_contents('img/share.svg'); ?>
					</li>
					<li data-open-wrapper="info" class="db nav-toggle nav-info">
						<?php echo file_get_contents('img/info.svg'); ?>
					</li>
				</ul>
		    </nav>

		</div>

		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/jquery.transform2d.js"></script>
		<script type="text/javascript" src="js/jquery.jTinder.js"></script>
		<script type="text/javascript" src="js/js.cookie.js"></script>
		<script type="text/javascript" src="js/main.js?v5"></script>
		
		<script>
			let deferredPrompt = null;
			window.addEventListener('beforeinstallprompt', (e) => {
				// Prevent Chrome 67 and earlier from automatically showing the prompt
				e.preventDefault();
				// Stash the event so it can be triggered later.
				deferredPrompt = e;
			});
			async function install() {
				if (deferredPrompt) {
					deferredPrompt.prompt();
					console.log(deferredPrompt)
					deferredPrompt.userChoice.then(function(choiceResult){
						if (choiceResult.outcome === 'accepted') {
							console.log('Your PWA has been installed');
						} else {
							console.log('User chose to not install your PWA');
						}
						deferredPrompt = null;
					});
				}
			}
			// This is the "Offline page" service worker
			// Add this below content to your HTML page, or add the js file to your page at the very top to register service worker
			// Check compatibility for the browser we're running this in
			if ("serviceWorker" in navigator) {
				if (navigator.serviceWorker.controller) {
					console.log("[PWA Builder] active service worker found, no need to register");
				} else {
				// Register the service worker
					navigator.serviceWorker
					.register("service-worker.js")
					.then(function (reg) {
						console.log("[PWA Builder] Service worker has been registered for scope: " + reg.scope);
					});
				}
			}
			
			var $status = document.getElementById('pushstatus');

			if ('Notification' in window) {
			  $status.innerText = Notification.permission;
			}
			
			function requestPermission() {
			  if (!('Notification' in window)) {
			    alert('Notification API not supported!');
			    return;
			  }
			  
			  Notification.requestPermission(function (result) {
			    $status.innerText = result;
			    if (result == 'granted') {
				    persistentNotification();
			    }
			  });
			}
			
			function persistentNotification() {
			  if (!('Notification' in window) || !('ServiceWorkerRegistration' in window)) {
			    alert('Persistent Notification API not supported!');
			    return;
			  }
			  
			  try {
			    navigator.serviceWorker.getRegistration()
			      .then(reg => reg.showNotification('Aktiviert!'))
			      .catch(err => alert('Service Worker registration error: ' + err));
			  } catch (err) {
			    alert('Notification API error: ' + err);
			  }
			}
			
		</script>

	</body>
</html>
