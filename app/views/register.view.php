<?php require('partials/panel.head.php'); ?>

<?php

session_start();

if (isset($_SESSION['loggedIn'])) {
    redirect('panel');
}

?>

<div class="center-screen">
    <h1>Rejestracja</h1>
    <form method="POST" action="/register">

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" maxlength="50" placeholder="np. jan@kowalski.com" required>
        </div>

        <div class="form-group">
            <label for="name">Imie i nazwisko:</label>
            <input type="text" class="form-control" id="name" name="name" maxlength="100" required>
        </div>

        <div class="form-group">
            <label for="phone">Telefon:</label>
            <input type="text" class="form-control" id="phone" name="phone" pattern="[0-9]+" maxlength="20" placeholder="np. 48786886693" required>
        </div>

        <div class="form-group">
            <label for="password">Hasło:</label>
            <input type="password" class="form-control" id="password" name="password" maxlength="100" required>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Rejestruj</button>
        </div>

    </form>
</div>

<?php require('partials/footer.php'); ?>
