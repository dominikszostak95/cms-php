<?php require('partials/head.view.php'); ?>

<?php

session_start();

if (isset($_SESSION['loggedIn'])) {
    redirect('panel');
}

?>

<form class="form-signin" method="POST" action="/login">
    <h1 class="h3 mb-3 font-weight-normal">Zaloguj się</h1>
    <label for="email" class="sr-only">Email</label>
    <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
    <label for="password" class="sr-only">Hasło</label>
    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Zaloguj</button>
    <br>
    <p>
        <a href="reset">Zapomniałem hasła</a><br>
        <a href="register">Załóż konto</a>
    </p>
    <p class="mt-5 mb-3 text-muted">&copy; 2018</p>
</form>

<?php require('partials/footer.php'); ?>