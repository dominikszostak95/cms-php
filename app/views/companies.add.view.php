<?php require('partials/panel.head.php'); ?>

<?php require('partials/checkPermission.php'); ?>

<?php ($_SESSION['role_id'] == 1) ? require('partials/nav.view.php') : require('partials/nav.u.view.php') ?>

    <div class="col col-lg-6">
        <h3>Dodaj firme</h3>
        <form method="POST" action="/companies/add">

            <div class="form-group">
                <label for="nazwa">Nazwa:</label>
                <input type="text" class="form-control" id="cname" name="cname" maxlength="50" required>
            </div>

            <div class="form-group">
                <label for="adres">Adres:</label>
                <input type="text" class="form-control" id="address" name="address" maxlength="100" required>
            </div>

            <div class="form-group">
                <label for="miasto">Miasto:</label>
                <input type="text" class="form-control" id="city" name="city" maxlength="50" required>
            </div>

            <div class="form-group">
                <label for="nip">NIP:</label>
                <input type="text" pattern="[0-9]+" class="form-control" id="nip" minlength="10" maxlength="10" name="nip" required>
            </div>

            <div class="form-group">
                <label for="kraj">Kraj:</label>
                <input type="text" class="form-control" id="country" name="country" maxlength="50" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" maxlength="60" placeholder="np. przykladowafirma@gmail.com" required>
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
                <input type="checkbox" name="processing" value="tak">Zgoda na przetwarzanie danych osobowych<br>
                <input type="checkbox" name="ads" value="tak">Zgoda na otrzymywanie materiałów reklamowych
            </div>

            <hr>

            <?php require('questionnaire.view.php'); ?>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Dodaj firme</button>
            </div>

        </form>
    </div>

<?php require('partials/footer.php'); ?>