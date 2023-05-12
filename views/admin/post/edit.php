<h1>Modifier <?= $params['post']->title; ?></h1>
<form action="/admin/posts/edit/<?= $params['post']->id; ?>" method="post">

    <div class="form-group mt-3">
        <label for="title">titre de l'article</label>
        <input class="form-control" type="text" name="title" id="title" value="<?= $params['post']->title; ?>">
    </div>

    <div class="form-group mt-3">
        <label for="content">contenu de l'article</label>
        <textarea name="content" class="form-control" id="content" cols="30" rows="10"><?= $params['post']->content; ?></textarea>
    </div>

    <div class="mt-3">
    <button type="submit" class="btn btn-primary">enregistrer les modifications</button>
    </div>
    
</form>