<?php
defined('_JEXEC') or die('Restricted Access');
$rowOpen = false;
?>
<br>
<div class="well attendancelist">
    <div class="page-header">
        <h2 class="attendancelist-title"><?php echo JText::_('COM_ATTENDANCELIST_FEEDBACK_TITLE'); ?></h2>
    </div>
    <form class="form-horizontal">
        <div class="form-group form-group-lg row">
            <div class="colxs-12 col-md-12 col-lg-12">
                <input class="form-control attendancelist-input-text" type="text" name="title" id="title" placeholder="<?php echo JText::_('COM_ATTENDANCELIST_FEEDBACK_LABEL_TITLE_DESC'); ?>">
            </div>
        </div>
        <div class="form-group form-group-lg row">
            <div class="colxs-6 col-md-6 col-lg-6">
                <input class="form-control attendancelist-input-text" type="text" name="date" id="date" placeholder="<?php echo JText::_('COM_ATTENDANCELIST_FEEDBACK_LABEL_DATE_DESC'); ?>">
            </div>
            <div class="colxs-3 col-md-3 col-lg-3">
                <input class="form-control attendancelist-input-text" type="text" name="date" id="date" placeholder="<?php echo JText::_('COM_ATTENDANCELIST_FEEDBACK_LABEL_STARTTIME_DESC'); ?>">
            </div>
            <div class="colxs-3 col-md-3 col-lg-3">
                <input class="form-control attendancelist-input-text" type="text" name="date" id="date" placeholder="<?php echo JText::_('COM_ATTENDANCELIST_FEEDBACK_LABEL_FINISHTIME_DESC'); ?>">
            </div>
        </div>
    </form>
</div>