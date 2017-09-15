<?php
defined('_JEXEC') or die('Restricted Access');
$rowOpen = false;
?>
<div class="row attendancelist-categorytargets-item">
    <?php if (!empty($targets)) : ?>
        <?php foreach ($targets as $i => $target) : ?>
            <?php if ($rowOpen) : $rowOpen = false; ?><div class="row attendancelist-categorytargets-item"><?php endif; ?>
                <div class="col-xs-6 col-md-6 col-lg-6">
                    <div class="checkbox">
                        <label class="attendancelist-categorytargets-label<?php echo (in_array($target->id, $checked) ? " attendancelist-categorytargets-label-checked" : null); ?>">
                            <input
                                type="checkbox"
                                id="categorytargets-id-<?php echo $target->id; ?>"
                                name="categorytargets[id][<?php echo $target->id; ?>]"
                                class="attendancelist-categorytargets-input"
                                <?php echo (in_array($target->id, $checked) ? "checked" : null); ?>
                                value="1">
                            <h4 class="attendancelist-categorytargets-header"><?php echo $target->title; ?><small>(<?php echo $target->code; ?>)</small></h4>
                            <?php if (!empty($target->obs)): ?><small><?php echo $target->obs; ?></small><?php endif; ?>
                            <?php foreach ($this->findCategoryParents($target->category_id, $request["level"]) as $parent): ?>
                                <h5 class="attendancelist-categorytargets-header"><?php echo $parent->name; ?><small>(<?php echo $parent->code; ?>)</small></h5>
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