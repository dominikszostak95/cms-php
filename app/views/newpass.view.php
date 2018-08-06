<?php require('partials/panel.head.php'); ?>

<?php

session_start();

if (isset($_SESSION['loggedIn'])) {
    redirect('panel');
}

?>

<div class="center-screen">
    <h1>Wprowadź nowe hasło: </h1>
    <form onSubmit="return validate()" method="POST" action="/newpass">

        <div class="form-group">
            <input type="hidden" class="form-control" name="id" id="id" value="<?= $_GET['id'] ?>"/>
        </div>

        <div class="form-group">
            <label for="password">Nowe hasło: </label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>

        <div class="form-group">
            <label for="password">Powtórz hasło: </label>
            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Resetuj hasło</button>
        </div>

    </form>
</div>

<script>
    function validate(){
        if (!document.getElementById("password").value==document.getElementById("confirm_password").value) {
            window.alert("Passwords do no match");
        }
        return document.getElementById("password").value==document.getElementById("confirm_password").value;
    }
</script>

<?php require('partials/footer.php'); ?>
