<?php require('partials/panel.head.php'); ?>

<?php require('partials/checkPermission.php'); ?>

<?php ($_SESSION['role_id'] == 1) ? require('partials/nav.view.php') : require('partials/nav.u.view.php') ?>

    <div class="col col-lg-6">
        <h3>Edytuj pytanie</h3>
        <form method="POST" action="/questions/edit">

            <div class="form-group">
                <input type="hidden" class="form-control" name="data" id="data" value="<?= $_GET['id'] ?>"/>
            </div>

            <div class="form-group">
                <label for="status">Status:</label>
                <select name="status">
                    <option <?php if ($data['question'][0]->status == 1) { ?> selected="selected" <?php } ?> value="1">Włączone</option>
                    <option <?php if ($data['question'][0]->status == 2) { ?> selected="selected" <?php } ?> value="2">Wyłączone</option>
                </select>
            </div>

            <div class="form-group">
                <label for="content">Treść:</label>
                <input type="text" class="form-control" id="content" name="content" maxlength="50" value="<?= $data['question'][0]->content ?>" required>
            </div>

            <div class="form-group">
                <label for="odpowiedzi">Odpowiedzi: </label>
                <?php foreach ($data['answers'] as $answer) : ?>
                    <input type="hidden" class="form-control" name="id[]" id="id" value="<?= $answer->id ?>"/>
                    <input type="text" class="form-control" id="text" name="text[]" maxlength="100" value ="<?= $answer->content ?>" required><br>
                <?php endforeach; ?>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Zatwierdź</button>
            </div>

        </form>
    </div>

<?php require('partials/footer.php'); ?>