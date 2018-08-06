<?php require('partials/panel.head.php'); ?>

<?php require('partials/checkPermission.php'); ?>

<?php ($_SESSION['role_id'] == 1) ? require('partials/nav.view.php') : require('partials/nav.u.view.php') ?>

    <div class="col col-lg-6">
        <h3>Zdjęcia: </h3>
        <table>
            <form method="POST" action="/photos/delete">
                <select name="usun">
                    <option value="1">Usuń zaznaczone</option>
                    <option value="2">Usuń wszystkie</option>
                </select>
                <input type="submit" name="delete" value="Wykonaj"/>
            <tr>
                <td> </td>
                <td>ID</td>	<td>Nazwa pliku</td>
                <td>Plik</td> <td>Handlowiec</td>
                <td>Typ pliku</td> <td>Data dodania</td>
                <td> </td>
            </tr>
            <?php foreach ($photos as $photo) : ?>
                <tr>
                    <td> <input type="checkbox" name="checkbox[]" value="<?= $photo->id ?>"> </td>
                    <td><?= $photo->id ?></td> <td><?= $photo->nazwa ?></td>
                    <td><?= $photo->plik ?></td> <td><?= $photo->name ?></td>
                    <td><?= $photo->typ ?></td> <td><?= $photo->created_at ?></td>
                    <td> <a href="/photos/edit?id=<?= $photo->id ?>">Zmień nazwę</a> </td>
                </tr>
            <?php endforeach; ?>
            </form>
        </table>
    </div>

<?php require('partials/footer.php'); ?>