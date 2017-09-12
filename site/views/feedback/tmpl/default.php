<?php defined('_JEXEC') or die('Restricted Access'); ?>
<br>
<div class="well attendancelist">
    <div class="page-header">
        <h2 class="attendancelist-title"><?php echo JText::_('COM_ATTENDANCELIST_FEEDBACK_TITLE'); ?></h2>
    </div>
    <form class="form-horizontal">
        <input type="hidden" name="attendancelist_id" value="<?php echo $this->attendancelist_id; ?>">
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
        <!-- <QUIZ> -->
        <?php if (is_array($this->quizes) && count($this->quizes)): ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo JText::_('COM_ATTENDANCELIST_FEEDBACK_LABEL_QUIZ'); ?></h3>
                </div>
                <div class="panel-body attendancelist-panel">
                    <?php foreach ($this->quizes as $quiz): ?>
                        <div class="row attendancelist-input-group">
                            <div class="colxs-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label for="quiz-<?php echo $quiz->id; ?>">
                                        <small>#<?php echo $quiz->position; ?></small>
                                        <?php echo $quiz->question; ?>
                                    </label>
                                    <?php $this->addQuizAlternatives($quiz); ?>
                                </div>
                                <hr>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
        <!-- </QUIZ> -->
        <!-- <CATEGORY> -->
        <div class="attendancelist-categories">
            <?php $this->addCategories(); ?>
        </div>
        <!-- </CATEGORY> -->
    </form>
</div>