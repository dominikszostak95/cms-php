<?php require('partials/panel.head.php'); ?>

<?php require('partials/checkPermission.php'); ?>

<?php ($_SESSION['role_id'] == 1) ? require('partials/nav.view.php') : require('partials/nav.u.view.php') ?>

    <div class="col col-lg-6">
        <h3>Dasboard: </h3>
        <p><b>Liczba nowych użytkowników w ostatnich 7 dniach: </b><?= $data['lastWeekUsers'][0]->liczba ?></p>
        <p><b>Liczba nowych firm w ostatnich 7 dniach: </b><?= $data['lastWeekCompanies'][0]->liczba ?></p>
    </div>

<?php require('partials/footer.php'); ?>

