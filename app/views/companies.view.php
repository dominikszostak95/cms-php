<?php require('partials/panel.head.php'); ?>

<?php require('partials/checkPermission.php'); ?>

<?php ($_SESSION['role_id'] == 1) ? require('partials/nav.view.php') : require('partials/nav.u.view.php') ?>

    <div class="col col-lg-6">
        <h3>Firmy: </h3>
        <table>
            <form method="POST" action="/companies/delete">
                <select name="delete">
                    <option value="1">Usuń zaznaczone</option>
                    <option value="2">Usuń wszystkie</option>
                </select>
                <input type="submit" name="wykonaj" value="Wykonaj"/>
                <tr>
                    <td> </td>
                    <td>ID</td> <td>Nazwa firmy</td>
                    <td>Kontakt</td> <td>E-mail</td>
                    <td>Data utworzenia</td> <td>Handlowiec</td>
                    <td> </td>
                </tr>
                <?php foreach ($companies as $company) : ?>
                    <tr>
                        <td> <input type="checkbox" name="checkbox[]" value="<?= $company->id ?>"></td>
                        <td><?= $company->id ?></td> <td><?= $company->cname ?></td>
                        <td><a href="/contacts?id=<?= $company->id ?>">klik</a></td> <td><?= $company->email ?></td>
                        <td><?= $company->created_at ?></td> <td><?= $company->name ?></td>
                        <td><a href="/companies/edit?id=<?= $company->id ?>">Edytuj</a></td>
                    </tr>
                <?php endforeach; ?>
            </form>
        </table>
    </div>

    <script>
        $(document).ready(function(){
            $("#show").load("showka?id=" + $('#firma').val());
        });
    </script>

<?php require('partials/footer.php'); ?>