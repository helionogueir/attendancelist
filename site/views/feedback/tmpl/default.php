<?php defined('_JEXEC') or die('Restricted Access'); ?>
<br>
<div class="well">
    <div class="page-header">
        <h3><?php echo $this->attendancelist->name; ?></h3>
        <?php if (!empty($this->attendancelist->obs)): ?><h4 class="attendancelist-subtitle"><?php echo $this->attendancelist->obs; ?></h4><?php endif; ?>
    </div>
    <form class="form-horizontal" onsubmit="return false;">
        <input type="hidden" name="attendancelist_id" value="<?php echo $this->attendancelist->id; ?>">
        <?php $this->render($this->attendancelist->id); ?>
        <hr>
        <div class="buttons">
            <button
                type="button"
                class="btn btn-default btn-lg"
                onclick="(new com_attendancelist_validate(this.form)).validate();"><?php echo JText::_('COM_ATTENDANCELIST_LABEL_SAVE'); ?></button>
        </div>
    </form>
</div>