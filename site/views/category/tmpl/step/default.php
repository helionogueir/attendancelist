<?php defined('_JEXEC') or die('Restricted Access'); ?>
<?php if (isset($setting->level)) : ?>
    <div class="attendancelist-category attendancelist-category-<?php echo $setting->level ?>">
        <div class="form-group form-group-lg row">
            <div class="col-xs-12 col-md-12 col-lg-12">
                <label for=category-search-<?php echo $setting->level ?>"><?php echo JText::_('COM_ATTENDANCELIST_CATEGORY_LABEL_SEARCH'); ?></label>
                <input
                    type="text"
                    id="category-search-<?php echo $setting->level ?>"
                    name="category[search][<?php echo $setting->level ?>]"
                    maxlength="255"
                    class="form-control"
                    placeholder="<?php echo JText::_('COM_ATTENDANCELIST_CATEGORY_LABEL_SEARCH_DESC'); ?>">
            </div>
        </div>
        <div class="attendancelist-category-items">
            <?php
            $filename = JPATH_COMPONENT
                    . DIRECTORY_SEPARATOR . "views"
                    . DIRECTORY_SEPARATOR . "category"
                    . DIRECTORY_SEPARATOR . "tmpl"
                    . DIRECTORY_SEPARATOR . "step"
                    . DIRECTORY_SEPARATOR . "notfound.php";
            include($filename);
            ?>
        </div>
    </div>
<?php endif; ?>