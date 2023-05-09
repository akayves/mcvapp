<!--
    notre variable envoyé à la vue se trouve dans le tableau params à l'index post
-->

<h1><?= $params['post']->title; ?></h1>
<div>
    <?php foreach($params['post']->getTags() as $tag) : ?>
        <span class="text text-primary"><?= $tag->name; ?></span>
    <?php endforeach; ?>
</div>
<p> <?= $params['post']->content; ?></p>
<a href="/posts" class="btn btn-secondary">retourner en arrière</a>