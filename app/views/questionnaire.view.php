 <?php foreach ($dane['questions'] as $question) : ?>
     <div class="form-group">
                    <label for="tresc"> <?= $question->tresc ?> </label>
                    <?php foreach ($dane['answers'] as $answer) : ?>
                        <?php if ($question->id == $answer->id_pytania) : ?>
                            <?php if ($answer->typ == 1) : ?>
                                <input type="radio" name="radio[<?= $question->id ?>]" value="<?= $answer->id ?>"> <?= $answer->tresc ?>
                            <?php elseif ($answer->typ == 2) : ?>
                                <input type="checkbox" name="check[<?= $question->id ?>][]" value="<?= $answer->id ?>"> <?= $answer->tresc ?>
                            <?php elseif ($answer->typ == 3) : ?>
                                <input type="text" name="text[<?= $question->id ?>][<?= $answer->id ?>]">
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
     </div>
 <?php endforeach; ?>

