<?php defined('_JEXEC') or die('Restricted Access'); ?>
<?php if (!empty($quiz) && !empty($alternatives)): ?>
    <select
        id="quiz-<?php echo $quiz->id; ?>"
        name="quiz[<?php echo $quiz->id; ?>]"
        data-label="<?php echo JText::_($quiz->question); ?>"
        class="form-control<?php echo (!empty($setting->class) ? " {$setting->class}" : null) ?>">
        <option value=""><?php echo JText::_('COM_ATTENDANCELIST_LABEL_SELECT'); ?></option>
        <?php foreach ($alternatives as $alternative): ?>
            <option value="<?php echo $alternative->id; ?>"><?php echo $alternative->alternative; ?></option>
        <?php endforeach; ?>
    </select>
<?php endif; ?>