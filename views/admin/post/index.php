<h1>Administration des articles</h1>

<?php if(isset($_GET['success'])): ?>
    <div class="alert alert-success">Vous êtes connecté! </div>
<?php endif; ?>

<a href="/admin/posts/create" class="btn btn-success my-3">Créer un nouvel article</a>
<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Titre</th>
            <th scope="col">Publié le</th>
            <th scope="col">action</th>
        </tr>
    </thead>
    <tbody>

        <?php $count=1; foreach($params['posts'] as $post) : ?>
        <tr>
            <td scope="row"> <?= $count ?> </td>
            <td> <?= $post->title; ?> </td>
            <td> <?= $post->getCreatedAt(); ?></td>
            <td>
                <a href="/admin/posts/edit/<?= $post->id?>" class="btn btn-warning">Modifier</a>
                <form action="/admin/posts/delete/<?= $post->id ?>" method="post" class="d-inline">
                    <button type="submit" class="btn btn-danger">Supprimer</button>
                </form>
                
            </td>
        </tr>
        
        <?php $count++; endforeach; ?>
    </tbody>
</table>