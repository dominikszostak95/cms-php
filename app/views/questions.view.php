<?php require('partials/panel.head.php'); ?>

<?php require('partials/checkPermission.php'); ?>

<?php ($_SESSION['role_id'] == 1) ? require('partials/nav.view.php') : require('partials/nav.u.view.php') ?>

    <div class="col col-lg-6">
        <h3>Pytania: </h3>
        <table>
            <form method="POST" action="/questions/delete">
                <select name="usun">
                    <option value="1">Usuń zaznaczone</option>
                    <option value="2">Usuń wszystkie</option>
                </select>
                <input type="submit" name="delete" value="Wykonaj"/>
            <tr>
                <td> </td>
                <td>ID</td>	<td>Treść pytania</td>
                <td>Kolejność</td> <td>Status</td>
                <td> </td>
            </tr>
            <?php foreach ($questions as $question) : ?>
                <tr>
                    <td> <input type="checkbox" name="checkbox[]" value="<?= $question->id ?>"> </td>
                    <td><?= $question->id ?></td> <td><?= $question->tresc ?></td>
                    <td><?= $question->kolejnosc ?></td> <td><?= $question->status ?></td>
                    <td> <a href="/questions/edit?id=<?= $question->id ?>">Edytuj</a> </td>
                </tr>
            <?php endforeach; ?>
            </form>
        </table>
    </div>

<?php require('partials/footer.php'); ?>