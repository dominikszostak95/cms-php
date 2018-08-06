<?php require('partials/panel.head.php'); ?>

<?php require('partials/checkPermission.php'); ?>

<?php ($_SESSION['role_id'] == 1) ? require('partials/nav.view.php') : require('partials/nav.u.view.php') ?>

    <div class="col col-lg-6">
        <h3>Edytuj firme</h3>
        <form method="POST" action="/companies/edit">

            <div class="form-group">
                <label for="nazwa">Nazwa:</label>
                <input type="text" class="form-control" id="nazwa" name="nazwa" maxlength="50" value="<?= $company[0]->nazwa ?>" required>
            </div>

            <div class="form-group">
                <label for="adres">Adres:</label>
                <input type="text" class="form-control" id="adres" name="adres" maxlength="100" value="<?= $company[0]->adres ?>" required>
            </div>

            <div class="form-group">
                <label for="miasto">Miasto:</label>
                <input type="text" class="form-control" id="miasto" name="miasto" maxlength="50" value ="<?= $company[0]->miasto ?>" required>
            </div>

            <div class="form-group">
                <label for="nip">NIP:</label>
                <input type="text" pattern="[0-9]+" class="form-control" id="nip" minlength="10" maxlength="10" name="nip" value="<?= $company[0]->nip ?>" required>
            </div>

            <div class="form-group">
                <label for="kraj">Kraj:</label>
                <input type="text" class="form-control" id="kraj" name="kraj" maxlength="50" value="<?= $company[0]->kraj ?>" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" maxlength="60" value="<?= $company[0]->email ?>" required>
            </div>

            <div class="form-group">
                <input type="checkbox" name="dane" value="tak" <?php if ($company[0]->przetwarzanie == 1) { ?> checked <?php } ?>>Zgoda na przetwarzanie danych osobowych<br>
                <input type="checkbox" name="reklamy" value="tak" <?php if ($company[0]->reklamy == 1) { ?> checked <?php } ?>>Zgoda na otrzymywanie materiałów reklamowych
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Zatwierdź</button>
            </div>

        </form>
    </div>

<?php require('partials/footer.php'); ?>