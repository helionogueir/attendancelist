<?php defined('_JEXEC') or die('Restricted Access'); ?>
<div class="form-group form-group-lg row">
    <div class="col-xs-12 col-md-6 col-lg-6">
        <label for="feedback-date"><?php echo JText::_('COM_ATTENDANCELIST_FEEDBACK_LABEL_DATE'); ?></label>
        <input
            type="text"
            id="feedback-date"
            name="feedback[date]"
            maxlength="10"
            class="form-control attendancelist-form-require attendancelist-form-date"
            placeholder="<?php echo JText::_('COM_ATTENDANCELIST_FEEDBACK_LABEL_DATE_DESC'); ?>">
    </div>
    <div class="col-xs-6 col-md-3 col-lg-3">
        <label for="feedback-timestart"><?php echo JText::_('COM_ATTENDANCELIST_FEEDBACK_LABEL_STARTTIME'); ?></label>
        <input
            type="text"
            id="feedback-timestart"
            name="feedback[timestart]"
            maxlength="5"
            class="form-control attendancelist-form-require attendancelist-form-time-24"
            placeholder="<?php echo JText::_('COM_ATTENDANCELIST_FEEDBACK_LABEL_STARTTIME_DESC'); ?>">
    </div>
    <div class="col-xs-6 col-md-3 col-lg-3">
        <label for="feedback-timefinish"><?php echo JText::_('COM_ATTENDANCELIST_FEEDBACK_LABEL_FINISHTIME'); ?></label>
        <input
            type="text"
            id="feedback-timefinish"
            name="feedback[timefinish]"
            maxlength="5"
            class="form-control attendancelist-form-require attendancelist-form-time-24"
            placeholder="<?php echo JText::_('COM_ATTENDANCELIST_FEEDBACK_LABEL_FINISHTIME_DESC'); ?>">
    </div>
</div>