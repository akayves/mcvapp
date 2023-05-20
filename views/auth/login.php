<h1>Se connecter au panneau d'administration</h1>

<?php if(isset($_SESSION['errors'])) : ?>
    <?php foreach($_SESSION['errors'] as $errorsArray) : ?>
        <?php foreach($errorsArray as $errors): ?>
            <div class="alert alert-danger">
                <?php foreach($errors as $error) : ?>
                 <li><?= $error; ?></li>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    <?php endforeach; ?>
<?php endif; ?>
<?php session_destroy(); ?>

<form action="/login" method="post">
    <div class="form-group mt-3">
        <label for="username">nom d'utilisateur</label>
        <input class="form-control" type="text" name="username" id="username">
    </div>

    <div class="form-group mt-3">
        <label for="password">mot de passe</label>
        <input class="form-control" type="password" name="password" id="password">
    </div>

    <div class="mt-3">
    <button type="submit" class="btn btn-primary">Se connecter</button>
    </div>
    
</form>