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

Cookies.set('visited-website', 1);

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
$('.btn-favorite').on('click', function(e) {
	const allcookies = Cookies.get();
	console.log(allcookies);
	$('.favorite-list').html('');
	if(Object.keys(allcookies).length==0){
		$('.favorite-list').html('<p>es wurden keine posts vorgemerkt</p>')
	}
	$.each(allcookies, function(i, cookiedata) {
		const thisCookie = cookiedata.split('||');
		if (thisCookie.length == 3) {
			$('.favorite-list').prepend('<div class="relative"><img src="'+thisCookie[1]+'">'+
			'<button data-post-id="'+thisCookie[0]+'" class="btn-remove absolute top-0 right-0 db tc ph3 pv1 ma2 bg-dark bn br2">x</button><p class="f6 hyphens-auto pb4 mt0 mb4 bb b--silver">'+thisCookie[2]+'</p></div>');
		}
	});
});
$('.favorite-list').on('click', '.btn-remove', function()  {
	const postId= $(this).data('post-id');
	Cookies.remove('like'+postId);
	$(this).parent().remove();
});

/**
 * jTinder initialization
 */
$("#tinderslide").jTinder({
	// dislike callback
    onDislike: function (item) {
      console.log('[Finder App] Button »Dislike« geklickt');
	    // set the status text
        $('#status').html('Dislike Post #' + (item.index()+1));
    },
	// like callback
    onLike: function (item) {
		const postId = item.data('post-id');
		const postImg = item.data('post-img');
		const postContent = item.data('post-content');
		console.log(postId);
		Cookies.set('like'+postId, postId+'||'+postImg+'||'+postContent);
		console.log('[Finder App] Button »Like« geklickt',item);
	    // set the status text
        $('#status').html('Like Post #' + (item.index()+1));
    },
	animationRevertSpeed: 200,
	animationSpeed: 400,
	threshold: 1,
	likeSelector: '.like',
	dislikeSelector: '.dislike'
});

/**
 * Set button action to trigger jTinder like & dislike.
 */
$('.actions .like, .actions .dislike').click(function(e){
	e.preventDefault();
	$("#tinderslide").jTinder($(this).attr('class'));
});
