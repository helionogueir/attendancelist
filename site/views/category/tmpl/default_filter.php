<?php
defined('_JEXEC') or die('Restricted Access');
$rowOpen = false;
?>
<?php if (!empty($this->categories)) : ?>
    <div class="row attendancelist-category-item">
        <?php foreach ($this->categories as $i => $category) : ?>
            <?php if ($rowOpen) : $rowOpen = false; ?><div class="row attendancelist-category-item"><?php endif; ?>
                <div class="col-xs-6 col-md-6 col-lg-6">
                    <div class="checkbox">
                        <label class="attendancelist-category-item-label">
                            <input type="checkbox" id="category-<?php echo $category->id; ?>" name="category[<?php echo $this->level; ?>][<?php echo $category->id; ?>]" value="1">
                            <span><?php echo $category->name; ?></span>
                            <small>(<?php echo $category->code; ?>)</small>
                            <p class="text-justify"><?php echo $category->obs; ?></p>
                        </label>
                    </div>
                </div>
                <?php if ((bool) $i && (ceil(($i + 1) % 2) == 0)) : $rowOpen = true; ?></div><?php endif; ?>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <?php
    $filename = JPATH_COMPONENT
            . DIRECTORY_SEPARATOR . "views"
            . DIRECTORY_SEPARATOR . "category"
            . DIRECTORY_SEPARATOR . "tmpl"
            . DIRECTORY_SEPARATOR . "filter"
            . DIRECTORY_SEPARATOR . "notfound.php";
    include($filename);
    ?>
<?php endif; ?>