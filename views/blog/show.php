<!--
    notre variable envoyé à la vue se trouve dans le tableau params à l'index post
-->
<h1><?= $params['post']->title; ?></h1>
<p> <?= $params['post']->content; ?></p>
<a href="/posts" class="btn btn-secondary">retourner en arrière</a>