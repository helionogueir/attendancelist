<?php defined('_JEXEC') or die('Restricted Access'); ?>
<?php if (!empty($quiz)): ?>
    <textarea
        id="quiz-<?php echo $quiz->id; ?>"
        name="quiz[<?php echo $quiz->id; ?>]"
        data-label="<?php echo JText::_($quiz->question); ?>"
        class="form-control<?php echo (!empty($setting->class) ? " {$setting->class}" : null) ?>"></textarea>
<?php endif; ?>