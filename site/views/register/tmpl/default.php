<?php
defined('_JEXEC') or die('Restricted Access');
$rowOpen = false;
?>
<br>
<div class="well attendancelist">
    <div class="page-header">
        <h2 class="attendancelist-title"><?php echo JText::_('COM_ATTENDANCELIST_REGISTER_TITLE'); ?></h2>
    </div>
    <form class="form-horizontal">
        <div class="form-group form-group-lg">
            <div class="colxs-12 col-md-12 col-lg-12">
                <input class="form-control attendancelist-input-text" type="text" id="search" placeholder="<?php echo JText::_('COM_ATTENDANCELIST_REGISTER_SEARCH_DESC'); ?>">
            </div>
        </div>
    </form>
</div>