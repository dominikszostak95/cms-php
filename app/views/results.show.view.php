
<?php foreach ($data['questions'] as $question) : ?>
    <div class="form-group">
        <label for="tresc"> <?= $question->content ?> </label>
        <?php foreach ($data['answers'] as $answer) : ?>
            <?php if ($question->id == $answer->answer_id) : ?>
                <?php if ($answer->type == 1) : ?>
                    <?php foreach ($data['users_answers'] as $uAnswer) : ?>
                        <?php if ($uAnswer->answer_id == $answer->id ) : ?>
                            <input type="radio" name="radio[<?= $question->id ?>]" value="<?= $answer->id ?>" checked onclick="return false;"> <?= $answer->content ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php elseif ($answer->type == 2) : ?>
                    <?php foreach ($data['users_answers'] as $uAnswer) : ?>
                        <?php if ($uAnswer->answer_id == $answer->id ) : ?>
                            <input type="checkbox" name="check[<?= $question->id ?>][]" value="<?= $answer->id ?>" checked onclick="return false;"> <?= $answer->content ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php elseif ($answer->type == 3) : ?>
                    <?php foreach ($data['text_answers'] as $tAnswer) : ?>
                        <?php if ($tAnswer->answer_id == $answer->answer_id ) : ?>
                            <input type="text" name="text[<?= $question->id ?>][<?= $answer->id ?>]" value="<?= $tAnswer->answer ?>" readonly>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
<?php endforeach; ?>

