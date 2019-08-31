/**
 * Variablen
 */
const activeClass = 'is-active';

/**
 * Cookie handling
 */
const visitedWebsite = Cookies.get('visited-website');
if (!visitedWebsite) {
	$('.page-info').addClass(activeClass);
	$('.nav-info').addClass(activeClass);
}
Cookies.set('visited-website', 1, { expires: 365 });

/**
 * Navigation
 **/
$('.nav-toggle').on('click', function(e) {
	let pageId = $(this).data('open-wrapper');
	$('.page, .nav-toggle').not('.page-'+pageId+', .nav-'+pageId).removeClass(activeClass);
	$('.page-'+pageId).toggleClass(activeClass);
	$('.nav-'+pageId).toggleClass(activeClass);
});

/**
 * Favorites
 **/
 const getFavorites = function() {
	const allcookies = Cookies.get();
	let favorites =[];
	$('.favorite-list').html('');
	$.each(allcookies, function(i, cookiedata) {
		const thisCookie = cookiedata.split('||');
		if (thisCookie.length == 3) {
			favorites.push(thisCookie);
		}
	});
	if (favorites.length == 0) {
		$('.favorite-list').html('<p class="f6 tc"><span class="f1 db">🤲</span> Du hast gerade keine Favoriten. Swipe in den Beiträgen nach rechts, um sie zu speichern.</p>')
	} else {
		$.each(favorites, function(i, cookiedata) {
			$('.favorite-list').prepend('<div class="relative"><img src="'+cookiedata[1]+'">'+
			'<button data-post-id="'+cookiedata[0]+'" class="btn-remove absolute top-0 right-0 db tc ph3 pv1 ma2 bg-dark bn br2">x</button><p class="f6 hyphens-auto pb4 mt0 mb4 bb b--silver">'+cookiedata[2]+'</p></div>');
		});
	}
};
$('.favorite-list').on('click', '.btn-remove', function()  {
	const postId= $(this).data('post-id');
	Cookies.remove('like'+postId);
	getFavorites();
});
$('.btn-favorite').on('click', function(e) {
	getFavorites();
});

/**
 * jTinder initialization
 */
let tinderslides = 0;
let tinderslidesMatched = 0;
const tinderslidesCheck = function(item) {
	tinderslidesMatched++;
	let lastSwipedPostId = Cookies.get('lastSwipedPostId'),
		thisPostId = item.data('post-id');
	if (thisPostId > lastSwipedPostId || lastSwipedPostId == undefined) {
		Cookies.set('lastSwipedPostId', thisPostId, { expires: 365 });
	}
	if (tinderslidesMatched == tinderslides) {
		$('#tinderslide').addClass('z-0');
	}
};
const tinderInit = function() {
	$('#tinderslide').removeClass('z-0');
	$.get('api.php', function(data) {
		$('.tinder').html(data);
		tinderslides = $('#tinderslide li').length;
		tinderslidesMatched = 0;
		$('#tinderslide').jTinder({
			// dislike callback
		    onDislike: function (item) {
		      console.log('[Finder App] Button »Dislike« geklickt');
			    // set the status text
		        $('#status').html('Dislike Post #' + (item.index()+1));
		        tinderslidesCheck(item);
		    },
			// like callback
		    onLike: function (item) {
				const postId = item.data('post-id');
				const postImg = item.data('post-img');
				const postContent = item.data('post-content');
				console.log(postId);
				Cookies.set('like'+postId, postId+'||'+postImg+'||'+postContent, { expires: 365 });
				console.log('[Finder App] Button »Like« geklickt',item);
			    // set the status text
		        $('#status').html('Like Post #' + (item.index()+1));
		        tinderslidesCheck(item);
		    },
			animationRevertSpeed: 200,
			animationSpeed: 400,
			threshold: 1,
			likeSelector: '.like',
			dislikeSelector: '.dislike'
		});
	});
};
tinderInit();

/**
 * Neue Posts holen wenn PWA neu geöffnet wird
 */
let userActive = true;
$(window).blur(function(e) {
    userActive = false;
});
$(window).focus(function(e) {
	if (userActive == false) {
		console.log('Besucher wieder da');
    	tinderInit();
		userActive = true;
	}
});

/**
 * Prüfen auf neue Posts
 **/
setInterval(function() {
	if (('Notification' in window) || ('ServiceWorkerRegistration' in window)) {
		$.get('api.php', function(data) {
			let latestPostId = $(data).find('#tinderslide li').last().data('post-id'),
				lastSwipedPostId = Cookies.get('lastSwipedPostId');
			if (latestPostId > lastSwipedPostId || lastSwipedPostId == undefined) {			
				try {
					navigator.serviceWorker.getRegistration()
					  .then(reg => reg.showNotification('Neue Posts 🔥'))
					  .catch(err => alert('Service Worker registration error: ' + err));
				} catch (err) {
					console.log('Notification API error: ' + err);
				}
			}
		});
	}	
}, 60000);