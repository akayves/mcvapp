<h1>les derniers articles</h1>
<!--
    notre variable envoyé à la vue se trouve dans le tableau params à l'index posts
-->
<?php foreach($params['posts'] as $post) : ?>
    <div class="card mb-3">
        <div class="card-body">
            <h2><?= $post->title;?></h2>
            <small><?= $post->created_at?></small>
            <p><?= $post->content?></p>
            <a class="btn btn-primary" href="/posts/<?= $post->id?>">lire plus</a>
        </div>
    </div>
<?php endforeach;?> 