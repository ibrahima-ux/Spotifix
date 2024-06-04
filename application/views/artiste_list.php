<h5>Liste des Artistes</h5>
<nav>
    <form action="" method="get" class='recherche'>
        <input type="text" name="search" placeholder="pas nom">
		<input type="hidden" name="by" value="<?=$by?>">
        <button type="submit">Recherche</button>
    </form>
    <ul style="align-items: normal; float: left;">
        <?php
        $CI =& get_instance();
        if ($by == 'asc') {
            $bynext = "desc";
            $arrow = "up.png";
        } else {
            $bynext = "asc";
            $arrow = "down.png";
        }
        ?>
        <li><?=anchor("artistes/?by=$bynext&search=$search", "<img src='{$CI->config->base_url("assets/$arrow")}' alt='$bynext' width='30px' />",['role'=> 'button', 'class'=>'flipflop']);?></li>
    </ul>
</nav>
<section class="list">
    <?php
    foreach($artistes as $artiste){
        echo "<div><article>";
        echo anchor("artistes/view/{$artiste->id}", "{$artiste->name}");
        echo "</article></div>";
    }
    ?>
</section>