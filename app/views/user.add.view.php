<?php require('partials/panel.head.php'); ?>

<?php require('partials/checkAdminPermission.php'); ?>

<?php require('partials/nav.view.php'); ?>

    <div class="col col-lg-6">
        <h3>Dodaj handlowca</h3>
        <form method="POST" action="/traders/add">

            <div class="form-group">
                <label for="grupa">Grupa:</label>
                <select name="grupa">
                        <option value="2">Handlowiec</option>
                        <option value="1">Administrator</option>
                </select>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="np. jan@kowalski.com" maxlength="50" required>
            </div>

            <div class="form-group">
                <label for="name">Imie i nazwisko:</label>
                <input type="text" class="form-control" id="name" name="name" maxlength="100" required>
            </div>

            <div class="form-group">
                <label for="phone">Telefon:</label>
                <input type="text" class="form-control" id="phone" name="phone" placeholder="np. 48786392206" maxlength="20" required>
            </div>

            <div class="form-group">
                <label for="password">Hasło:</label>
                <input type="password" class="form-control" id="password" name="password" maxlength="100" required>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Dodaj handlowca</button>
            </div>

        </form>
    </div>

<?php require('partials/footer.php'); ?>