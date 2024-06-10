<!doctype html>
<html lang="fr" class="has-navbar-fixed-top">
	<head>
		<meta charset="UTF-8" />
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
    <li><h2><strong><?=anchor("albums", "Spotifix",['class'=>'no_a_style, title'])?></strong></h2></li>
  </ul>
  <ul>
  <li><?=anchor('albums','Albums');?></li>
  <li><?=anchor('musique/index','Musiques');?></li>
  <li><?=anchor('artistes','Artistes');?></li>
  <li><?=anchor('playlist','Playlist');?></li>
  </ul>
</nav>
