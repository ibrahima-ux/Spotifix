<h5>Albums list</h5>
<nav>
    <!-- Ajout d'un formulaire de recherche pour les playlists -->
    <?php
        $message_recherche = 'par année';
        if ($sorted == "nom") {
            $message_recherche = 'par nom';
        }elseif ($sorted == "genre") {
            $message_recherche = 'par genre';
        }
    ?>
    <form action="" method="post" class='recherche'>
        <input type="text" name="query" placeholder="<?=$message_recherche?>" required>
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
        <li><?=anchor("albums/?sorted=year&by=$by",'Year',['role'=>($sorted=='year'?'button':'')]);?></li>
        <li><?=anchor("albums/?sorted=nom&by=$by",'Nom',['role'=>($sorted=='nom'?'button':'')]);?></li>
        <li><?=anchor("albums/?sorted=genre&by=$by",'Genre',['role'=>($sorted=='genre'?'button':'')]);?></li>
        <li><?=anchor("albums/?sorted=$sorted&by=$bynext", "<img src='{$CI->config->base_url("assets/$arrow")}' alt='$bynext' width='30px' />",['role'=> 'button', 'class'=>'flipflop']);?></li>
    </ul>
</nav>
<section class="list">
    <?php
    foreach($albums as $album){
        echo "<div><article>";
        echo "<header class='short-text'>";
        echo anchor("albums/view/{$album->id}", "{$album->name}");
        echo "</header>";
        echo '<img src="data:image/jpeg;base64,' . base64_encode($album->jpeg) . '" />';
        echo "<footer class='short-text'>{$album->year} - {$album->artistName} - {$album->genreName}</footer>
          </article></div>";
    }
    ?>
</section>
