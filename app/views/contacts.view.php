<?php require('partials/panel.head.php'); ?>

<?php require('partials/checkPermission.php'); ?>

<?php ($_SESSION['role_id'] == 1) ? require('partials/nav.view.php') : require('partials/nav.u.view.php') ?>

    <div class="col col-lg-6">
        <h3>Kontakty: </h3>
        <table>
            <form method="POST" action="/contacts/delete">
                <select name="usun">
                    <option value="1">Usuń zaznaczone</option>
                    <option value="2">Usuń wszystkie</option>
                </select>
                <input type="submit" name="delete" value="Wykonaj"/>
            <tr>
                <td> </td>
                <td>ID</td>	<td>Nazwa firmy</td>
                <td>Imie i nazwisko</td> <td>Telefon</td>
                <td>Data rejestracji</td> <td>Handlowiec</td>
                <td> </td>
            </tr>
            <?php foreach ($contacts as $contact) : ?>
                <tr>
                    <td> <input type="checkbox" name="checkbox[]" value="<?= $contact->id ?>"> </td>
                    <td><?= $contact->id ?></td> <td><?= $contact->nazwa ?></td>
                    <td><?= $contact->cName ?></td> <td><?= $contact->telefon ?></td>
                    <td><?= $contact->created_at ?></td> <td><?= $contact->uName ?></td>
                    <td><a href=/contacts/edit?id=<?= $contact->id ?>>Edytuj</a></td>
                </tr>
            <?php endforeach; ?>
            </form>
        </table>
    </div>

<?php require('partials/footer.php'); ?>