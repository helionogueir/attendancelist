<?php defined('_JEXEC') or die('Restricted Access'); ?>
<form action="index.php?option=com_attendancelist&view=attendancelists" method="post" id="adminForm" name="adminForm">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th width="5%"><?php echo JText::_('COM_ATTENDANCELIST_LABEL_NUM'); ?></th>
                <th width="85%"><?php echo JText::_('COM_ATTENDANCELIST_LABEL_NAME'); ?></th>
            </tr>
        </thead>
        <tfoot>
            <tr><td colspan="2"><?php echo $this->pagination->getListFooter(); ?></td></tr>
        </tfoot>
        <tbody>
            <?php if (!empty($this->items)) : ?>
                <?php
                foreach ($this->items as $i => $row) :
                    $link = JRoute::_('index.php?option=com_attendancelist&task=attendancelist.edit&id=' . $row->id);
                    ?>
                    <tr>
                        <td><?php echo $this->pagination->getRowOffset($i); ?></td>
                        <td><a href="<?php echo $link; ?>"><?php echo $row->name; ?></a></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
    <input type="hidden" name="task" value=""/>
    <input type="hidden" name="boxchecked" value="0"/>
    <?php echo JHtml::_('form.token'); ?>
</form>
