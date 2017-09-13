<?php defined('_JEXEC') or die('Restricted Access'); ?>
<?php if (!empty($quiz) && !empty($alternatives)): ?>
    <?php foreach ($alternatives as $alternative): ?>
        <div class="checkbox">
            <label>
                <input type="checkbox" id="quiz-<?php echo $quiz->id; ?>-<?php echo $alternative->id; ?>" name="quiz-<?php echo $quiz->id; ?>[<?php echo $alternative->id; ?>]" value="1">
                <span><?php echo $alternative->alternative; ?></span>
            </label>
        </div>
    <?php endforeach; ?>
<?php endif; ?>