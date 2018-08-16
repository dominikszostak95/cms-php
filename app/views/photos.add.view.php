<?php require('partials/panel.head.php'); ?>

<?php require('partials/checkPermission.php'); ?>

<?php ($_SESSION['role_id'] == 1) ? require('partials/nav.view.php') : require('partials/nav.u.view.php') ?>

    <div class="col col-lg-6">
        <h3>Dodaj zdjęcie</h3>
        <form method="POST" action="/photos/add" enctype="multipart/form-data">

            <div class="form-group">
                <select name="trader">
                    <?php if ($_SESSION['role_id'] == 1) : ?>
                        <?php foreach ($traders as $trader) : ?>
                            <option value="<?= $trader->id ?>"><?= $trader->name ?></option>
                        <?php endforeach; ?>
                    <?php else : ?>
                            <option value="<?= $_SESSION['id'] ?>"><?= $_SESSION['name'] ?></option>
                    <?php endif; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="name">Nazwa:</label>
                <input type="text" class="form-control" id="name" name="name" maxlength="100" required>
            </div>

            <div class="form-group">
                <input type="file" name="image" />
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Dodaj zdjęcie</button>
            </div>

        </form>
    </div>

<?php require('partials/footer.php'); ?>