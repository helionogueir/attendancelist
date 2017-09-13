<?php defined('_JEXEC') or die('Restricted Access'); ?>
<?php if (!empty($quiz)): ?>
    <textarea class="form-control attendancelist-input-textarea" id="quiz-<?php echo $quiz->id; ?>" name="quiz-<?php echo $quiz->id; ?>"></textarea>
<?php endif; ?>