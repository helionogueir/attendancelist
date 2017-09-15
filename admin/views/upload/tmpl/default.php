<?php
defined('_JEXEC') or die('Restricted access');
JHtml::_('behavior.formvalidator');
?>

<fieldset>
    <legend><?php echo JText::_('COM_ATTENDANCELIST_LABEL_LIST_DESC') . ' ' . JText::_('COM_ATTENDANCELIST_FUNCTIONALITY_CATEGORIES'); ?></legend>
    <form method="post" name="adminForm" id="adminForm" enctype="multipart/form-data">
        <!-- action="< ?php echo JRoute::_('index.php?option=com_attendancelist&view=upload'); ?>" -->
            <dl>
                <dd>
                    <select name="attendancelist" id="attendancelist">
                        <option value="-">Selecione a lista</option>
                        <?php
                        $model = $this->getModel('upload');
                        $dados = $model->getattendancelist();
                        foreach ($dados as $field){
                            echo("<option value='{$field->id}'>{$field->name}</option>");
                        }
                        ?>
                    </select>
                </dd>
                <dd>
                    <input type="file" name="importfile" id="importfile" />
                    <input type="button" value="Upload" id="btnSubmit" name="btnSubmit" />
                </dd>
            </dl>
        <?php echo JHtml::_('form.token'); ?>
    </form>
</fieldset>
<div id="saida" style="width: 90%;height: 200px;overflow: auto; "></div>