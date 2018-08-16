<?php require('partials/panel.head.php'); ?>

<?php require('partials/checkPermission.php'); ?>

<?php ($_SESSION['role_id'] == 1) ? require('partials/nav.view.php') : require('partials/nav.u.view.php') ?>

    <div class="col col-lg-6">
        <h3>Edytuj firme</h3>
        <form method="POST" action="/companies/edit">

            <div class="form-group">
                <input type="hidden" class="form-control" name="id" id="id" value="<?= $_GET['id'] ?>"/>
            </div>

            <div class="form-group">
                <label for="nazwa">Nazwa:</label>
                <input type="text" class="form-control" id="cname"
                       name="cname" maxlength="50" value="<?= $company[0]->cname ?>" required>
            </div>

            <div class="form-group">
                <label for="adres">Adres:</label>
                <input type="text" class="form-control" id="address"
                       name="address" maxlength="100" value="<?= $company[0]->address ?>" required>
            </div>

            <div class="form-group">
                <label for="miasto">Miasto:</label>
                <input type="text" class="form-control" id="city"
                       name="city" maxlength="50" value ="<?= $company[0]->city ?>" required>
            </div>

            <div class="form-group">
                <label for="nip">NIP:</label>
                <input type="text" pattern="[0-9]+" class="form-control" id="nip"
                       name="nip"  minlength="10" maxlength="10" value="<?= $company[0]->nip ?>" required>
            </div>

            <div class="form-group">
                <label for="kraj">Kraj:</label>
                <input type="text" class="form-control" id="country"
                       name="country" maxlength="50" value="<?= $company[0]->country ?>" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email"
                       name="email" maxlength="60" value="<?= $company[0]->email ?>" required>
            </div>

            <div class="form-group">
                <input type="checkbox" name="processing" value="tak" <?php if ($company[0]->processing == 1) { ?>
                    checked <?php } ?>>Zgoda na przetwarzanie danych osobowych<br>
                <input type="checkbox" name="ads" value="tak" <?php if ($company[0]->ads == 1) { ?>
                    checked <?php } ?>>Zgoda na otrzymywanie materiałów reklamowych
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Zatwierdź</button>
            </div>

        </form>
    </div>

<?php require('partials/footer.php'); ?>