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
                        <label class="attendancelist-category-label<?php echo (in_array($category->id, $checked) ? " attendancelist-category-label-checked" : null); ?>">
                            <input
                                type="checkbox"
                                id="category-id-<?php echo "{$request["level"]}-{$category->id}"; ?>"
                                name="category[id]<?php echo "[{$request["level"]}][{$category->id}]"; ?>"
                                class="attendancelist-category-input"
                                <?php echo (in_array($category->id, $checked) ? "checked" : null); ?>
                                value="1">
                            <h4 class="attendancelist-category-header"><?php echo $category->name; ?><small>(<?php echo $category->code; ?>)</small></h4>
                            <?php if (!empty($category->obs)): ?><small><?php echo $category->obs; ?></small><?php endif; ?>
                            <?php foreach ($this->findCategoryParents($category) as $parent): ?>
                                <h5 class="attendancelist-category-header"><?php echo $parent->name; ?><small>(<?php echo $parent->code; ?>)</small></h5>
                            <?php endforeach; ?>
                        </label>
                    </div>
                </div>
                <?php if ((bool) $i && (ceil(($i + 1) % 2) == 0)) : $rowOpen = true; ?></div><?php endif; ?>
        <?php endforeach; ?>
    <?php else: ?>
        <br>
        <div class="col-xs-12 col-md-12 col-lg-12">
            <p class="text-center"><?php echo JText::_('COM_ATTENDANCELIST_CATEGORY_NOTFOUND'); ?></p>
        </div>
    <?php endif; ?>
</div>