<?php defined('_JEXEC') or die('Restricted Access'); ?>
<?php if (!empty($labels)): ?>
    <?php foreach ($labels as $label): ?>
        <div class="panel panel-default attendancelist-level-<?php echo $label->level; ?>">
            <div class="panel-heading">
                <h3 class="panel-title"><?php echo $label->title; ?></h3>
            </div>
            <div class="panel-body attendancelist-panel">
                <?php if (!empty($label->obs)): ?><p><?php echo $label->obs; ?></p><?php endif; ?>
                <div class="form-group form-group-lg row">
                    <div class="col-xs-12 col-md-12 col-lg-12">
                        <input class="form-control attendancelist-input-text" type="text" id="attendancelist-level-<?php echo $label->level; ?>" placeholder="<?php echo JText::_('COM_ATTENDANCELIST_CATEGORY_LABEL_SEARCH'); ?>">
                    </div>
                </div>
                <div class="attendancelist-category-items">
                    <?php
                    $filename = JPATH_COMPONENT
                            . DIRECTORY_SEPARATOR . "views"
                            . DIRECTORY_SEPARATOR . "category"
                            . DIRECTORY_SEPARATOR . "tmpl"
                            . DIRECTORY_SEPARATOR . "filter"
                            . DIRECTORY_SEPARATOR . "notfound.php";
                    include($filename);
                    ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>