<h5>Playlists de </h5>
<div>
	<article>
		<header class='short-text'>
			<nav class="centered">
				<h3><?=$_SESSION['user']?></h3>
			</nav>
		</header>
		<form action='<?="$name"?>?choosed_genre=true&choosed_artiste=true&choosed_num=true' method="post">
            <div><h4>Sélectionez le nombe aproximatifs de musiques a inclure dans votre playlist : </h4></div>
            <div>
            
            <?php 
                foreach ($max as $maximus) {
                }
                echo "<input type='number' id='nb' name='nb' min='1' max='$maximus->number' placeholder='maximum $maximus->number' value='$maximus->number'>";

                if ($artists != null) {
                    foreach ($artists as $a => $artist) {
                        echo "<input type='hidden' name='artists[]' value='$artist'>";
                    }
                }else {
                    echo "<input type='hidden' name='artists[]'>";
                }

                if ($genres != null) {
                    foreach ($genres as $g => $genre) {
                        echo "<input type='hidden' name='genre[]' id='genre' value='$genre'>";
                    }
                }else {
                    echo "<input type='hidden' name='genre[]' id='genre'>";
                }
            ?>
                
            </div>
            <div>
                <button type="submit">Créer la playlist</button>
            </div>
        </form>
	</article>
</div>
