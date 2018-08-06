<?php require('partials/panel.head.php'); ?>

<?php

session_start();

if (isset($_SESSION['loggedIn'])) {
    redirect('panel');
}

?>

<div class="center-screen">
    <h1>Przypomnij hasło</h1>
    <form method="POST" action="/reset">

        <div class="form-group">
            <label for="email">E-mail: </label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Przypomnij</button>
        </div>
    </form>
</div>

<?php require('partials/footer.php'); ?>
