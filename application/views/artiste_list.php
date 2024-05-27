<nav>
    <h5>Liste des Artistes</h5>
    <ul style="align-items: normal; float: left;">
        <form action="" method="get" style="float: left; margin-right: 20px;">
            <input type="text" name="search_query" placeholder="Rechercher un artiste" required>
            <button type="submit">Recherche</button>
        </form>
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
        <li><?=anchor("artistes/?by=$bynext", "<img src='{$CI->config->base_url("assets/$arrow")}' alt='$bynext' width='30px' />",['role'=> 'button', 'class'=>'flipflop']);?></li>
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