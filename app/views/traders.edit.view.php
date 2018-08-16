<?php require('partials/panel.head.php'); ?>

<?php require('partials/checkAdminPermission.php'); ?>

<?php require('partials/nav.view.php'); ?>

    <div class="col col-lg-6">
        <h3>Edytuj użytkowników</h3>
        <form method="POST" action="/traders/edit">

            <div class="form-group">
                <input type="hidden" class="form-control" name="data" id="data" value="<?= $_GET['id'] ?>"/>
            </div>

            <div class="form-group">
                <label for="role">Grupa:</label>
                <select name="role">
                    <option <?php if ($trader[0]->role_id == 1) { ?> selected="selected" <?php } ?> value="1">Administrator</option>
                    <option <?php if ($trader[0]->role_id == 2) { ?> selected="selected" <?php } ?> value="2">Handlowiec</option>
                </select>
            </div>

            <div class="form-group">
                <label for="nazwa">Nazwa:</label>
                <input type="text" class="form-control" id="name" name="name" maxlength="50" value="<?= $trader[0]->name ?>" required>
            </div>

            <div class="form-group">
                <label for="phone">Telefon:</label>
                <input type="text" class="form-control" id="phone" name="phone" pattern="[0-9]+" value="<?= $trader[0]->phone_number ?>" maxlength="15" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" maxlength="60" value="<?= $trader[0]->email ?>" required>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Zatwierdź</button>
            </div>

        </form>
    </div>

<?php require('partials/footer.php'); ?>