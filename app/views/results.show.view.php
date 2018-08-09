
<?php foreach ($data['questions'] as $question) : ?>
    <div class="form-group">
        <label for="tresc"> <?= $question->tresc ?> </label>
        <?php foreach ($data['answers'] as $answer) : ?>
            <?php if ($question->id == $answer->id_pytania) : ?>
                <?php if ($answer->typ == 1) : ?>
                    <?php foreach ($data['users_answers'] as $uAnswer) : ?>
                        <?php if ($uAnswer->id_odpowiedzi == $answer->id ) : ?>
                            <input type="radio" name="radio[<?= $question->id ?>]" value="<?= $answer->id ?>" checked onclick="return false;"> <?= $answer->tresc ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php elseif ($answer->typ == 2) : ?>
                    <?php foreach ($data['users_answers'] as $uAnswer) : ?>
                        <?php if ($uAnswer->id_odpowiedzi == $answer->id ) : ?>
                            <input type="checkbox" name="check[<?= $question->id ?>][]" value="<?= $answer->id ?>" checked onclick="return false;"> <?= $answer->tresc ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php elseif ($answer->typ == 3) : ?>
                    <?php foreach ($data['text_answers'] as $tAnswer) : ?>
                        <?php if ($tAnswer->id_pytania == $answer->id_pytania ) : ?>
                            <input type="text" name="text[<?= $question->id ?>][<?= $answer->id ?>]" value="<?= $tAnswer->odpowiedz ?>" readonly>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
<?php endforeach; ?>

