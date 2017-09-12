<?php defined('_JEXEC') or die('Restricted Access'); ?>
<br>
<div class="well attendancelist">
    <div class="page-header">
        <h2 class="attendancelist-title"><?php echo $this->attendancelist->name; ?></h2>
        <?php if (!empty($this->attendancelist->obs)): ?><h4 class="attendancelist-subtitle"><?php echo $this->attendancelist->obs; ?></h4><?php endif; ?>
    </div>
    <form class="form-horizontal">
        <input type="hidden" name="attendancelist_id" value="<?php echo $this->attendancelist->id; ?>">
        <!-- <FEEDBACK> -->
        <div class="form-group form-group-lg row">
            <div class="col-xs-12 col-md-12 col-lg-12">
                <label for=title"><?php echo JText::_('COM_ATTENDANCELIST_FEEDBACK_LABEL_TITLE'); ?></label>
                <input class="form-control attendancelist-input-text" type="text" name="title" id="title" placeholder="<?php echo JText::_('COM_ATTENDANCELIST_FEEDBACK_LABEL_TITLE_DESC'); ?>">
            </div>
        </div>
        <div class="form-group form-group-lg row">
            <div class="col-xs-12 col-md-6 col-lg-6">
                <label for=date"><?php echo JText::_('COM_ATTENDANCELIST_FEEDBACK_LABEL_DATE'); ?></label>
                <input class="form-control attendancelist-input-text" type="text" name="date" id="date" placeholder="<?php echo JText::_('COM_ATTENDANCELIST_FEEDBACK_LABEL_DATE_DESC'); ?>">
            </div>
            <div class="col-xs-12 col-md-3 col-lg-3">
                <label for=timestart"><?php echo JText::_('COM_ATTENDANCELIST_FEEDBACK_LABEL_STARTTIME'); ?></label>
                <input class="form-control attendancelist-input-text" type="text" name="timestart" id="timestart" placeholder="<?php echo JText::_('COM_ATTENDANCELIST_FEEDBACK_LABEL_STARTTIME_DESC'); ?>">
            </div>
            <div class="col-xs-12 col-md-3 col-lg-3">
                <label for=timefinish"><?php echo JText::_('COM_ATTENDANCELIST_FEEDBACK_LABEL_FINISHTIME'); ?></label>
                <input class="form-control attendancelist-input-text" type="text" name="timefinish" id="timefinish" placeholder="<?php echo JText::_('COM_ATTENDANCELIST_FEEDBACK_LABEL_FINISHTIME_DESC'); ?>">
            </div>
        </div>
        <!-- </FEEDBACK> -->
        <!-- <QUIZ> --><?php echo $this->addQuizes($this->attendancelist->id); ?><!-- </QUIZ> -->
        <!-- <LABELS> --><?php $this->addLabels($this->attendancelist->id); ?><!-- </LABELS> -->
    </form>
</div>