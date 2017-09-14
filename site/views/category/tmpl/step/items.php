<?php
defined('_JEXEC') or die('Restricted Access');
$rowOpen = false;
?>
<div class="row attendancelist-category-item">
    <?php if (!empty($categories)) : ?>
        <?php foreach ($categories as $i => $category) : ?>
            <?php if ($rowOpen) : $rowOpen = false; ?><div class="row attendancelist-category-item"><?php endif; ?>
                <div class="col-xs-6 col-md-6 col-lg-6">
                    <div class="checkbox">
                        <label>
                            <input
                                type="checkbox"
                                id="category-id-<?php echo "{$request["level"]}-{$category->id}"; ?>"
                                name="category[id]<?php echo "[{$request["level"]}][{$category->id}]"; ?>"
                                class="attendancelist-category-id"
                                <?php echo (in_array($category->id, $checked) ? "checked" : null); ?>
                                value="1">
                            <span><?php echo $category->name; ?></span>
                            <small>(<?php echo $category->code; ?>)</small>
                        </label>
                    </div>
                </div>
                <?php if ((bool) $i && (ceil(($i + 1) % 2) == 0)) : $rowOpen = true; ?></div><?php endif; ?>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="col-xs-12 col-md-12 col-lg-12">
            <p class="text-center"><?php echo JText::_('COM_ATTENDANCELIST_CATEGORY_NOTFOUND'); ?></p>
        </div>
    <?php endif; ?>
</div>