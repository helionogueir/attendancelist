<?php defined('_JEXEC') or die('Restricted Access'); ?>
<select class="form-control" id="quiz-<?php echo $quiz->id; ?>" name="quiz-<?php echo $quiz->id; ?>">
    <option value="">COM_ATTENDANCELIST_LABEL_SELECT</option>
    <?php if (is_array($rowSet) && count($rowSet)): ?>
        <?php foreach ($rowSet as $row): ?>
            <option value="<?php echo $row->id; ?>"><?php echo $row->alternative; ?></option>
        <?php endforeach; ?>
    <?php endif; ?>
</select>