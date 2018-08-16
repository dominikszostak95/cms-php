<?php require('partials/panel.head.php'); ?>

<?php require('partials/checkPermission.php'); ?>

<?php ($_SESSION['role_id'] == 1) ? require('partials/nav.view.php') : require('partials/nav.u.view.php') ?>

    <div class="col col-lg-6">
        <h3>Dodaj kontakt</h3>
        <form method="POST" action="/contacts/add" enctype="multipart/form-data">
            <div class="form-group">
                <label for="firma">Firma:</label>
                <select name="company">
                    <?php foreach ($data['companies'] as $company) : ?>
                        <option value="<?= $company->id ?>"> <?= $company->cname ?> </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="name">Imie:</label>
                <input type="text" class="form-control" id="name" name="name" maxlength="100" required>
            </div>

            <div class="form-group">
                <label for="stanowisko">Stanowisko:</label>
                <input type="text" class="form-control" id="role" name="role" maxlength="100" required>
            </div>

            <div class="form-group">
                <label for="telefon">Telefon:</label>
                <input type="text" class="form-control" id="phone" name="phone" pattern="[0-9]+" placeholder="np. 48799866544" maxlength="15" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" class="form-control" id="email" name="email" placeholder="np. przykladowafirma@gmail.com" maxlength="60" required>
            </div>

            <div class="form-group">
                <input type="file" name="image" />
            </div>

            <div class="form-group">
                <select name="trader">
                    <?php if ($_SESSION['role_id'] == 1) : ?>
                        <?php foreach ($data['traders'] as $trader) : ?>
                            <option value="<?= $trader->id ?>"><?= $trader->name ?></option>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <option value="<?= $_SESSION['id'] ?>"><?= $_SESSION['name'] ?></option>
                    <?php endif; ?>
                </select>
            </div>

            <div class="form-group">
                <input type="checkbox" name="processing" value="dane">Zgoda na przetwarzanie danych osobowych<br>
                <input type="checkbox" name="ads" value="reklamy">Zgoda na otrzymywanie materiałów reklamowych
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Dodaj kontakt</button>
            </div>

        </form>
    </div>

<?php require('partials/footer.php'); ?>