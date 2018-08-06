<?php require('partials/panel.head.php'); ?>

<?php require('partials/checkPermission.php'); ?>

<?php ($_SESSION['role_id'] == 1) ? require('partials/nav.view.php') : require('partials/nav.u.view.php') ?>

    <div class="col col-lg-6">
        <h3>Edytuj kontakt</h3>
        <form method="POST" action="/contacts/edit">
            <div class="form-group">
                <input type="hidden" class="form-control" name="data" id="data" value="<?= $_GET['id'] ?>"/>
            </div>

            <div class="form-group">
                <label for="firma">Firma:</label>
                <select name="firma">
                    <?php foreach ($dane['companies'] as $company) : ?>
                        <option <?php if ($company->id == $dane['contact'][0]->company_id) { ?> selected="selected" <?php } ?> value="<?= $company->id ?>"> <?= $company->nazwa ?> </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="nazwa">Imie i nazwisko:</label>
                <input type="text" class="form-control" id="name" name="name" maxlength="50" value="<?= $dane['contact'][0]->name ?>" required>
            </div>

            <div class="form-group">
                <label for="telefon">Telefon:</label>
                <input type="text" class="form-control" id="telefon" name="telefon" pattern="[0-9]+" value="<?= $dane['contact'][0]->telefon ?>" maxlength="15" required>
            </div>

            <div class="form-group">
                <label for="miasto">Email:</label>
                <input type="email" class="form-control" id="email" name="email" maxlength="100" value ="<?= $dane['contact'][0]->email ?>" required>
            </div>

            <div class="form-group">
                <input type="checkbox" name="dane" value="tak" <?php if ($dane['contact'][0]->przetwarzanie == 1) { ?> checked <?php } ?>>Zgoda na przetwarzanie danych osobowych<br>
                <input type="checkbox" name="reklamy" value="tak" <?php if ($dane['contact'][0]->reklamy == 1) { ?> checked <?php } ?>>Zgoda na otrzymywanie materiałów reklamowych
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Zatwierdź</button>
            </div>

        </form>
    </div>

<?php require('partials/footer.php'); ?>