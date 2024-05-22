<h5>Artistes list</h5>
<section class="list">
<?php
foreach($artistes as $artiste){
	echo "<div><article>";
	echo anchor("artistes/view/{$artiste->id}","{$artiste->name}");
	echo "</article></div>";
}
?>
</section>
