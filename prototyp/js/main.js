console.log('[Finder App] Start');

/**
 * Cookie handling
 */
const visitedWebsite = Cookies.get('visited-website');
console.log('[Finder App] Cookie gesetzt:', visitedWebsite);

$('.page-start').show();

/**
 * Startpage
 */
$('.btn-finder').on('click', (event) => {
  console.log('[Finder App] Button Click (Startpage) => (Finder)');
  $('.page-start').hide();
  $('.page-finder').show();
});

$('.btn-bookmarks').on('click', (event) => {
  console.log('[Finder App] Button Click (Finder) => (Bookmarks)');
  $('.page-finder').hide();
  $('.page-bookmarks').show();
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
