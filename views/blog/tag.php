<h1> <?= $params['tag']->name ?> </h1>
<!--
    notre variable envoyé à la vue se trouve dans le tableau params à l'index posts
-->
<?php foreach($params['tag']->getPosts() as $post) : ?>
    <div class="card mb-3">
        <div class="card-body">
            <h4> <a href="/posts/<?= $post->id?>"><?= $post->title;?></a> </h4>
        </div>
    </div>
<?php endforeach;?> 