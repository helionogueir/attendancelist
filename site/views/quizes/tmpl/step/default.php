<?php defined('_JEXEC') or die('Restricted Access'); ?>
<?php if (!empty($quizes)): ?>
    <div class="attendancelist-quizes">
        <?php foreach ($quizes as $quiz): ?>
            <div class="form-group row">
                <div class="colxs-12 col-md-12 col-lg-12">
                    <label class="attendancelist-quizes-label" for="quiz-<?php echo $quiz->id; ?>">
                        <h5><small>#<?php echo $quiz->position; ?></small><?php echo $quiz->question; ?></h5>
                    </label>
                    <?php if (!empty($quiz->obs)): ?><p><?php echo $quiz->obs; ?></p><?php endif; ?>
                    <?php $this->addQuizAlternatives($quiz); ?>
                </div>
            </div>
            <hr>
        <?php endforeach; ?>
    </div>
<?php endif; ?>