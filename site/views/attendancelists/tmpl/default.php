<?php
defined('_JEXEC') or die('Restricted Access');
$rowOpen = false;
?>
<br>
<div class="well">
    <div class="page-header">
        <h3><?php echo JText::_('COM_ATTENDANCELIST_ATTENDANCELISTS_TITLE'); ?></h3>
    </div>
    <div class="row">
        <?php if (!empty($this->items)) : ?>
            <?php foreach ($this->items as $i => $row) : ?>
                <?php $link = JRoute::_('index.php?option=com_attendancelist&view=feedback&id=' . $row->id); ?>
                <?php if ($rowOpen) : $rowOpen = false; ?><div class="row"><?php endif; ?>
                    <div class="col-xs-4 col-md-4 col-lg-4">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <h5><?php echo $row->name; ?></h5>
                                <p class="text-justify"><?php echo $row->obs; ?></p>
                                <hr>
                                <p class="text-center">
                                    <a class="btn btn-default" href="<?php echo $link; ?>" role="button">
                                        <?php echo JText::_('COM_ATTENDANCELIST_LABEL_ACCESS'); ?>
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <?php if ((bool) $i && (ceil(($i + 1) % 3) == 0)) : $rowOpen = true; ?></div><?php endif; ?>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-xs-12 col-md-12 col-lg-12">
                <h4 class="text-center">
                    <?php echo JText::_('COM_ATTENDANCELIST_ATTENDANCELISTS_NOTFOUND'); ?>
                </h4>
                <p class="text-center">
                    <?php echo JText::_('COM_ATTENDANCELIST_LABEL_THANKS'); ?>
                </p>
            </div>
        <?php endif; ?>
    </div>
</div>