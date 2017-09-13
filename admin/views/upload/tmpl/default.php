<?php
defined('_JEXEC') or die('Restricted access');
JHtml::_('behavior.formvalidator');
?>
<form action="<?php echo JRoute::_('index.php?option=com_attendancelist&view=upload'); ?>"
         method="post" name="adminForm" id="adminForm" enctype="multipart/form-data">
    <input type="file" name="importfile" id="importfile" />
    <input type="submit" value="Upload" name="submit" />

    <!-- a href="< ?php echo JRoute::_('index.php?option=com_attendancelist&view=helloworlds'); ?>" class="btn btn-default" style="margin-left:100px;">Go Back</a -->

    <?php echo JHtml::_('form.token'); ?>
</form>