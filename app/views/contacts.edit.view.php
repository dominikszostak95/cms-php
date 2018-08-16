<?php require('partials/panel.head.php'); ?>

<?php require('partials/checkPermission.php'); ?>

<?php ($_SESSION['role_id'] == 1) ? require('partials/nav.view.php') : require('partials/nav.u.view.php') ?>

    <div class="col col-lg-6">
        <h3>Edytuj kontakt</h3>
        <form method="POST" action="/contacts/edit">
            <div class="form-group">
                <input type="hidden" class="form-control" name="id" id="id" value="<?= $_GET['id'] ?>"/>
            </div>

            <div class="form-group">
                <label for="firma">Firma:</label>
                <select name="company">
                    <?php foreach ($data['companies'] as $company) : ?>
                        <option <?php if ($company->id == $data['contact'][0]->company_id) { ?> selected="selected" <?php } ?> value="<?= $company->id ?>"> <?= $company->cname ?> </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="nazwa">Imie i nazwisko:</label>
                <input type="text" class="form-control" id="name" name="name" maxlength="50" value="<?= $data['contact'][0]->name ?>" required>
            </div>

            <div class="form-group">
                <label for="telefon">Telefon:</label>
                <input type="text" class="form-control" id="phone" name="phone" pattern="[0-9]+" value="<?= $data['contact'][0]->phone ?>" maxlength="15" required>
            </div>

            <div class="form-group">
                <label for="miasto">Email:</label>
                <input type="email" class="form-control" id="email" name="email" maxlength="100" value ="<?= $data['contact'][0]->email ?>" required>
            </div>

            <div class="form-group">
                <input type="checkbox" name="processing" value="tak" <?php if ($data['contact'][0]->processing == 1) { ?> checked <?php } ?>>Zgoda na przetwarzanie danych osobowych<br>
                <input type="checkbox" name="ads" value="tak" <?php if ($data['contact'][0]->ads == 1) { ?> checked <?php } ?>>Zgoda na otrzymywanie materiałów reklamowych
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Zatwierdź</button>
            </div>

        </form>
    </div>

<?php require('partials/footer.php'); ?>