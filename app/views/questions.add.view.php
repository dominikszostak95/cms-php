<?php require('partials/panel.head.php'); ?>

<?php require('partials/checkPermission.php'); ?>

<?php ($_SESSION['role_id'] == 1) ? require('partials/nav.view.php') : require('partials/nav.u.view.php') ?>

    <div class="col col-lg-6">
        <h3>Dodaj pytanie: </h3>
        <form method="POST" action="/questions/add" enctype="multipart/form-data">

            <div class="form-group">
                <label for="tresc">Treść pytania: </label>
                <input type="text" class="form-control" id="tresc" name="tresc" maxlength="250" required>
            </div>

            <div class="form-group">
                <label for="kategoria">Kategoria: </label>
                <select name="kategoria">
                    <?php foreach ($categories as $category) : ?>
                        <option value="<?= $category->id ?>"><?= $category->kategoria ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="typ">Typy odpowiedzi:</label><br>
                <input type="radio" name="typ" value="1">Radio buttony<br>
                <input type="radio" name="typ" value="2">Check boxy<br>
                <input type="radio" name="typ" value="3">Input<br>
                <input type="radio" name="typ" value="4">Text area
            </div>

            <div class="form-group">
                <div class="field_wrapper">
                    <div>
                        <button type="button" class="add_input_button btn btn-primary" formnovalidate >Dodaj odpowiedź</button>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="status">Status:</label>
                <select name="status">
                    <option value="1">Włączone</option>
                    <option value="0">Wyłączone</option>
                </select>
            </div>


            <div class="form-group">
                <button type="submit" class="btn btn-primary">Dodaj pytanie</button>
            </div>
        </form>
    </div>

    <script>
        $(document).ready(function(){
            var max_fields = 10;
            var add_input_button = $('.add_input_button');
            var field_wrapper = $('.field_wrapper');
            var new_field_html = '<div><input type="text" name="input_field[]" value=""/><button class="remove_input_button" formnovalidate>Remove</button></div>';
            var input_count = 1;
// Add button dynamically
            $(add_input_button).click(function(){
                if(input_count < max_fields){
                    input_count++;
                    $(field_wrapper).append(new_field_html);
                }
            });
// Remove dynamically added button
            $(field_wrapper).on('click', '.remove_input_button', function(e){
                e.preventDefault();
                $(this).parent('div').remove();
                input_count--;
            });
        });
    </script>
<?php require('partials/footer.php'); ?>