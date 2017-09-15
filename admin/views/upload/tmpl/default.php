<?php
defined('_JEXEC') or die('Restricted access');
JHtml::_('behavior.formvalidator');
?>

<fieldset>
    <legend><?php echo JText::_('COM_ATTENDANCELIST_LABEL_LIST_DESC') . ' ' . JText::_('COM_ATTENDANCELIST_FUNCTIONALITY_CATEGORIES'); ?></legend>
    <form action="<?php echo JRoute::_('index.php?option=com_attendancelist&view=upload'); ?>"
             method="post" name="adminForm" id="adminForm" enctype="multipart/form-data">
            <dl>
                <dd>
                    <select name="attendancelist" id="attendancelist">
                        <?php
                        $model = $this->getModel('upload');
                        $dados = $model->getattendancelist();
                        foreach ($dados as $field){
                            echo("<option value='{$field->id}'>{$field->name}</option>");
                        }
                        ?>
                    </select>
                </dd>
                <dd><input type="file" name="importfile" id="importfile" /> <input type="submit" value="Upload" name="submit" /></dd>
            </dl>
        <?php echo JHtml::_('form.token'); ?>
    </form>
</fieldset>