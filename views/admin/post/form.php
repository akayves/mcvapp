<h1> <?= $params['post']->title ?? 'Créer un nouvel article'; ?></h1>
<form action="<?= isset($params['post']) ? "/admin/posts/edit/{$params['post']->id}" : "/admin/posts/create" ?>" method="post">

    <div class="form-group mt-3">
        <label for="title">titre de l'article</label>
        <input class="form-control" type="text" name="title" id="title" value="<?= $params['post']->title ?? ''; ?>">
    </div>

    <div class="form-group mt-3">
        <label for="content">contenu de l'article</label>
        <textarea name="content" class="form-control" id="content" cols="30" rows="10"><?= $params['post']->content ?? ''; ?></textarea>
    </div>

    <div class="form-group mt-3">
        <label for="tags">Les tags des articles</label>
        <select multiple name="tags[]" id="tags" class="form-control">
            <?php foreach($params['tags'] as $tag ) :?>
                <option value="<?= $tag->id; ?>" 

                <?php if(isset($params['post'])) :?>
                    <?php foreach($params['post']->getTags() as $postTags) {
                        echo ($tag->id === $postTags->id) ? 'selected' : '';
                    }?>
                <?php endif; ?>

                ><?= $tag->name; ?></option>
            <?php endforeach; ?>
        </select>
    </div>    

    <div class="mt-3">
    <button type="submit" class="btn btn-primary"><?= isset($params['post']) ? 'enregistrer les modifications' : 'enregistrer mon articlle' ?> </button>
    </div>
    
</form>