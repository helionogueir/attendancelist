<?php defined('_JEXEC') or die('Restricted Access'); ?>
<form action="index.php?option=com_attendancelist&view=categories" method="post" id="adminForm" name="adminForm">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th width="2%"><?php echo JText::_('COM_ATTENDANCELIST_LABEL_NUM'); ?></th>
                <th width="2%"><?php echo JHtml::_('grid.checkall'); ?></th>
                <th width="5%"><?php echo JText::_('COM_ATTENDANCELIST_LABEL_CODE'); ?></th>
                <th><?php echo JText::_('COM_ATTENDANCELIST_LABEL_NAME'); ?></th>
                <th><?php echo JText::_('COM_ATTENDANCELIST_LABEL_OBS'); ?></th>
                <th width="5%"><?php echo JText::_('COM_ATTENDANCELIST_FUNCTIONALITY_PUBLISHED'); ?></th>
            </tr>
        </thead>

        <tbody>
            <?php if (!empty($this->items)) : ?>
                <?php
                foreach ($this->items as $i => $row) :
                    $link = JRoute::_('index.php?option=com_attendancelist&task=category.edit&id=' . $row->id);
                    ?>
                    <tr>
                        <td><?php echo $this->pagination->getRowOffset($i); ?></td>
                        <td><?php echo JHtml::_('grid.id', $i, $row->id); ?></td>
                        <td><a href="<?php echo $link; ?>"><?php echo $row->code; ?></a></td>
                        <td><a href="<?php echo $link; ?>"><?php echo $row->name; ?></a></td>
                        <td><?php echo $row->obs; ?></td>
                        <td align="center"><?php echo JHtml::_('jgrid.published', $row->published, $i, 'categories.', true, 'cb'); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>

        <tfoot>
            <tr>
                <td colspan="6"><?php echo $this->pagination->getListFooter(); ?></td>
            </tr>
        </tfoot>
    </table>
    <input type="hidden" name="task" value=""/>
    <input type="hidden" name="boxchecked" value="0"/>
    <?php echo JHtml::_('form.token'); ?>
</form>
