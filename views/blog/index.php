<h1>les derniers articles</h1>
<!--
    notre variable envoyé à la vue se trouve dans le tableau params à l'index posts
-->
<?php foreach($params['posts'] as $post) : ?>
    <div class="card mb-3">
        <div class="card-body">
            <h2><?= $post->title;?></h2>
            <div>
                <?php foreach($post->getTags() as $tag) : ?>
                    <span class="text text-primary"><?= $tag->name; ?></span>
                <?php endforeach; ?>
            </div>
            <small class="text text-info"><?= $post->getCreatedAt()?></small>
            <p><?= $post->getExcerpt()?></p>
            <?= $post->getButton();?>
        </div>
    </div>
<?php endforeach;?> 