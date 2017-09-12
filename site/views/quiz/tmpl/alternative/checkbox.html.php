<?php defined('_JEXEC') or die('Restricted Access'); ?>
<?php if (is_array($rowSet) && count($rowSet)): ?>
    <?php foreach ($rowSet as $row): ?>
        <div class="checkbox">
            <label>
                <input type="checkbox" id="quiz-<?php echo $quiz->id; ?>-<?php echo $row->id; ?>" name="quiz-<?php echo $quiz->id; ?>[<?php echo $row->id; ?>]" value="1">
                <span><?php echo $row->alternative; ?></span>
            </label>
        </div>
    <?php endforeach; ?>
<?php endif; ?>