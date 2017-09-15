<?php
defined('_JEXEC') or die('Restricted access');
JHtml::_('behavior.formvalidator');
?>
<fieldset>
    <legend><?php echo JText::_('COM_ATTENDANCELIST_LABEL_LIST_DESC') . ' ' . JText::_('COM_ATTENDANCELIST_FUNCTIONALITY_CATEGORY_TARGET'); ?></legend>


    <form method="post" name="adminForm" id="adminForm" enctype="multipart/form-data">
        <!-- action="< ?php echo JRoute::_('index.php?option=com_attendancelist&view=uploadtarget'); ?>" -->
        <input type="file" name="importfile" id="importfile" />
        <input type="button" value="Upload" id="btnSubmit" name="btnSubmit" />

        <?php echo JHtml::_('form.token'); ?>
    </form>
</fieldset>
<div id="saida" style="width: 90%;height: 200px;overflow: auto; "></div>