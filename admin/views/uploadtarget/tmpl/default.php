<?php
defined('_JEXEC') or die('Restricted access');
JHtml::_('behavior.formvalidator');
?>

<form action="<?php echo JRoute::_('index.php?option=com_attendancelist&view=uploadtarget'); ?>"
         method="post" name="adminForm" id="adminForm" enctype="multipart/form-data">
    <input type="file" name="importfile" id="importfile" />
    <input type="submit" value="Upload" name="submit" />

    <?php echo JHtml::_('form.token'); ?>
</form>