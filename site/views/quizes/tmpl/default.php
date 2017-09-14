<?php defined('_JEXEC') or die('Restricted Access'); ?>
<br>
<div class="well">
    <div class="page-header">
        <h3><?php echo $this->attendancelist->name; ?></h3>
        <?php if (!empty($this->attendancelist->obs)): ?><h4 class="attendancelist-subtitle"><?php echo $this->attendancelist->obs; ?></h4><?php endif; ?>
    </div>
    <form class="form-horizontal">
        <input type="hidden" name="attendancelist_id" value="<?php echo $this->attendancelist->id; ?>">
        <?php $this->render($this->attendancelist->id); ?>
    </form>
</div>