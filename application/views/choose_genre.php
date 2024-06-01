<h5>Playlists de </h5>
<div>
	<article>
		<header class='short-text'>
			<nav class="centered">
				<h3><?=$_SESSION['user']?></h3>
			</nav>
		</header>
		<form action='<?="$name"?>?choosed_genre=true' method="post">
            <div><h4>Sélectionez le(s) genres a inclure dans votre playlist : </h4></div>
            <div style="margin-left: 4em; margin-bottom: 1em;">
            <?php 
                $i = 0;
                foreach ($genres as $genre) {
                    echo "<input type='checkbox' id='$i' name='genre[]' value='$genre->name'> <label for='$i'>{$genre->name}</label><br>";
                    $i++ ;
                }         
            ?>
            </div>
            <div>
                <button type="submit">Créer la playlist</button>
            </div>
        </form>
	</article>
</div>
