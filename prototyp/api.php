<?php
$allPosts = json_decode( file_get_contents('instagram.json'), true );

if (count($allPosts) > 0) {
?>
<div id="tinderslide">
	<ul>
	<?php
	# tag filter
	if (isset($_GET['tag'])) {
		$tagFilter = $_GET['tag'];
	}
	
	# alle posts in schleife ausgeben
	foreach( $allPosts as $i => $post) {
		
		# blacklist holen
		$blacklist = json_decode( file_get_contents('blacklist.json'), true );
		
		if ( !in_array($post['id'], $blacklist) ) {
		
			if (!isset($tagFilter) || (isset($tagFilter) && strpos($post['text'], '#'.$tagFilter) !== false)) {
			?>
				<li data-post-id="<?php echo $post['id']; ?>"
					data-post-img="<?php echo $post['img']; ?>"
					data-post-content="<?php echo $post['text']; ?>" class="pane<?php echo $i + 1; ?>">
					<img src="<?php echo $post['img']; ?>" width="300" alt="">
					<p class="f6 hyphens-auto ma0"><?php echo $post['text']; ?></p>
				</li>
			<?php
			}
			
		}		
	}
	?>
	</ul>
</div>
<?php
}
?>