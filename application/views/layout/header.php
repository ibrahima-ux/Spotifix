<!doctype html>
<html lang="fr" class="has-navbar-fixed-top">
	<head>
		<meta charset="UTF-8" />
    <link rel="icon" type="image/png" href=<?=base_url("assets/spotifix_logo.png")?>>
		<title>Spotifix</title>
    <?=link_tag('assets/style.css')?>
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css"
    />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>
	<body>
		<main class='container'>
			<nav>
        <ul>
          <li>
            <?=anchor("albums", "<img src='".base_url("assets/spotifix_logo.png")."' alt='' width='10%'><h2><strong>Spotifix</strong></h2>",['class'=>'title'])?>
          </lidisplay>
        </ul>
        <ul>
          <li><?=anchor('albums','Albums');?></li>
          <li><?=anchor('musique/index','Musiques');?></li>
          <li><?=anchor('artistes','Artistes');?></li>
          <li><?=anchor('playlist','Playlist');?></li>
        </ul>
      </nav>
