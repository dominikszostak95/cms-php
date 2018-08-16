<?php require('partials/panel.head.php'); ?>

<?php require('partials/checkPermission.php'); ?>

<?php ($_SESSION['role_id'] == 1) ? require('partials/nav.view.php') : require('partials/nav.u.view.php') ?>

    <div class="col col-lg-6">
        <h3>Wyniki ankiet: </h3>

            <div class="form-group">
                <select name="company" id="company">
                    <?php foreach ($data['companies'] as $company) : ?>
                        <option value="<?= $company->id ?>"><?= $company->cname ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

        <div class="form-group">
            <button type="button" id="results"  class="btn btn-primary">Zobacz wyniki</button>
        </div>

        <div id="show">

        </div>
    </div>
    <script>
        $(document).ready(function(){
            $("#results").on("click", function() {
                $("#show").load("showka?id=" + $('#company').val());
            });
        });
    </script>

<?php require('partials/footer.php'); ?>