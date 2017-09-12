<?php defined('_JEXEC') or die('Restricted Access'); ?>
<?php if (!empty($quizes)): ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo JText::_('COM_ATTENDANCELIST_FEEDBACK_LABEL_QUIZ'); ?></h3>
        </div>
        <div class="panel-body attendancelist-panel">
            <?php foreach ($quizes as $quiz): ?>
                <div class="row attendancelist-input-group">
                    <div class="colxs-12 col-md-12 col-lg-12">
                        <div class="form-group">
                            <label for="quiz-<?php echo $quiz->id; ?>">
                                <small>#<?php echo $quiz->position; ?></small>
                                <?php echo $quiz->question; ?>
                            </label>
                            <?php if (!empty($quiz->obs)): ?><p><?php echo $quiz->obs; ?></p><?php endif; ?>
                            <?php $this->addQuizAlternatives($quiz); ?>
                        </div>
                        <hr>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>