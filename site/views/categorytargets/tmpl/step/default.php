<?php defined('_JEXEC') or die('Restricted Access'); ?>
<div class="attendancelist-categorytargets">
    <div class="form-group form-group-lg row">
        <div class="col-xs-12 col-md-12 col-lg-12">
            <label for="categorytargets-search"><?php echo JText::_('COM_ATTENDANCELIST_CATEGORY_LABEL_SEARCH'); ?></label>
            <input
                type="text"
                id="categorytargets-search"
                name="categorytargets[search]"
                maxlength="255"
                class="form-control"
                <?php if (!empty($setting->behavior->placeholder)): ?>placeholder="<?php echo $setting->behavior->placeholder; ?>"<?php endif; ?>>
        </div>
    </div>
    <div class="attendancelist-categorytargets-items attendancelist-form-require-checkbox" data-label="<?php echo $step->title; ?>">
        <?php
        $filename = JPATH_COMPONENT
                . DIRECTORY_SEPARATOR . "views"
                . DIRECTORY_SEPARATOR . "categorytargets"
                . DIRECTORY_SEPARATOR . "tmpl"
                . DIRECTORY_SEPARATOR . "step"
                . DIRECTORY_SEPARATOR . "items.php";
        include($filename);
        ?>
    </div>
</div>