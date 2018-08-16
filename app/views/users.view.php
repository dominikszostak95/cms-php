<?php require('partials/panel.head.php'); ?>

<?php require('partials/checkAdminPermission.php'); ?>

<?php require('partials/nav.view.php'); ?>

    <div class="col col-lg-6">
        <h3>Handlowcy: </h3>
        <table>
            <form method="POST" action="/traders/delete">
                <select name="delete">
                    <option value="1">Usuń zaznaczone</option>
                    <option value="2">Usuń wszystkie</option>
                </select>
                <input type="submit" name="wykonaj" value="Wykonaj"/>
            <tr>
                <td> </td>
                <td>ID</td>	<td>E-mail</td>
                <td>Imie i nazwisko</td> <td>Telefon</td>
                <td>Data rejestracji</td> <td>Grupa</td>
                <td> </td>
            </tr>
            <?php foreach ($traders as $trader) : ?>
                <tr>
                    <td> <input type="checkbox" name="checkbox[]" value="<?= $trader->id ?>"> </td>
                    <td><?= $trader->id ?></td> <td><?= $trader->email ?></td>
                    <td><?= $trader->name ?></td> <td><?= $trader->phone_number ?></td>
                    <td><?= $trader->created_at ?></td> <td><?= ($trader->role_id == 1) ? 'Administrator' : 'Handlowiec' ?></td>
                    <td><a href="/traders/edit?id=<?= $trader->id ?>">Edytuj</a></td>
                </tr>
            <?php endforeach; ?>
            </form>
        </table>
    </div>

<?php require('partials/footer.php'); ?>