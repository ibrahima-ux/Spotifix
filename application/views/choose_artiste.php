<h5>Playlists de </h5>
<div>
	<article>
		<header class='short-text'>
			<nav class="centered">
				<h3><?=$_SESSION['user']?></h3>
			</nav>
		</header>
		<form action='<?="$name"?>?choosed_genre=true&choosed_artiste=true' method="post">
            <div><h4>Sélectionez le(s) artistes a inclure dans votre playlist : </h4></div>
            <div style="margin-left: 4em; margin-bottom: 1em;">
            <?php 
                $i = 0;
                foreach ($artists as $artist) {
                    echo "<input type='checkbox' id='$i' name='artists[]' value='$artist->name'> <label for='$i'>{$artist->name}</label><br>";
                    $i++ ;
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
