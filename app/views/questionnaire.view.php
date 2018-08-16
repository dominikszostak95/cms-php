 <?php foreach ($data['questions'] as $question) : ?>
     <div class="form-group">
                    <label for="content"> <?= $question->content ?> </label>
                    <?php foreach ($data['answers'] as $answer) : ?>
                        <?php if ($question->id == $answer->answer_id) : ?>
                            <?php if ($answer->type == 1) : ?>
                                <input type="radio" name="radio[<?= $question->id ?>]" value="<?= $answer->id ?>"> <?= $answer->content ?>
                            <?php elseif ($answer->type == 2) : ?>
                                <input type="checkbox" name="check[<?= $question->id ?>][]" value="<?= $answer->id ?>"> <?= $answer->content ?>
                            <?php elseif ($answer->type == 3) : ?>
                                <input type="text" name="text[<?= $question->id ?>][<?= $answer->id ?>]">
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
     </div>
 <?php endforeach; ?>

