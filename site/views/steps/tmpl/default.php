<?php defined('_JEXEC') or die('Restricted Access'); ?>
<?php if (!empty($steps)): ?>
    <?php foreach ($steps as $step): ?>
        <div class="panel panel-default attendancelist-step-<?php echo $step->position; ?>">
            <div class="panel-heading">
                <h3 class="panel-title"><?php echo $step->title; ?></h3>
            </div>
            <div class="panel-body">
                <?php if (!empty($step->obs)): ?><p><?php echo $step->obs; ?></p><?php endif; ?>
                <div class="attendancelist-step-body">
                    <?php $this->prepareStepBody($step); ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>