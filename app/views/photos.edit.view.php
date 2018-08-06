<?php require('partials/panel.head.php'); ?>

<?php require('partials/checkPermission.php'); ?>

<?php ($_SESSION['role_id'] == 1) ? require('partials/nav.view.php') : require('partials/nav.u.view.php') ?>

    <div class="col col-lg-6">
        <h3>Edytuj zdjęcie</h3>
        <form method="POST" action="/photos/edit">

            <div class="form-group">
                <label for="nazwa">Nazwa:</label>
                <input type="text" class="form-control" id="nazwa" name="nazwa" maxlength="50" value="<?= $photo[0]->nazwa ?>" required>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Zatwierdź</button>
            </div>

        </form>
    </div>

<?php require('partials/footer.php'); ?>