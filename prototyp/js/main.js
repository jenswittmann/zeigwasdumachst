/**
 * Variablen
 */
const activeClass = 'is-active';

/**
 * Cookie handling
 */
const visitedWebsite = Cookies.get('visited-website');

if (visitedWebsite) {
	$('.page-start').removeClass(activeClass);
}

Cookies.set('visited-website', 1);

/**
 * Buttons
 */
 $('.btn-start').on('click', (event) => {
   $('.page-start').toggleClass(activeClass);
 });

$('.btn-finder').on('click', (event) => {
  $('.page').removeClass(activeClass);
});

$('.btn-share').on('click', (event) => {
  $('.page-share').toggleClass(activeClass);
});

$('.btn-bookmarks').on('click', (event) => {
  $('.page-bookmarks').toggleClass(activeClass);
	const allcookies = Cookies.get();
	console.log(allcookies);
	$('.bookmark-list').html('');
	if(Object.keys(allcookies).length==0){
		$('.bookmark-list').html('<p>es wurden keine posts vorgemerkt</p>')
	}
	$.each(allcookies, function(i, cookiedata) {
			console.log(i+': '+cookiedata);

			const thisCookie = cookiedata.split('||');

			$('.bookmark-list').prepend('<div class="relative"><img src="'+thisCookie[1]+'">'+
			'<button data-post-id="'+thisCookie[0]+'" class="absolute top-0 right-0 btn-remove">x</button><p>'+thisCookie[2]+'</p></div>');
	});

});

$('.bookmark-list').on('click', '.btn-remove', function()  {
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
