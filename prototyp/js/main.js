console.log('[Finder App] Start');

/**
 * Cookie handling
 */
const visitedWebsite = Cookies.get('visited-website');
console.log('[Finder App] Cookie gesetzt:', visitedWebsite);

/**
 * Variablen
 */
const activeClass = 'is-active';

/**
 * Buttons
 */
 $('.btn-start').on('click', (event) => {
   $('.page').removeClass(activeClass);
   $('.page-start').addClass(activeClass);
 });

$('.btn-finder').on('click', (event) => {
  $('.page').removeClass(activeClass);
  $('.page-finder').addClass(activeClass);
});

$('.btn-bookmarks').on('click', (event) => {
  $('.page').removeClass(activeClass);
  $('.page-bookmarks').addClass(activeClass);
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
      console.log('[Finder App] Button »Like« geklickt');
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
