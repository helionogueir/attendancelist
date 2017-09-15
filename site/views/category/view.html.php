<?php

defined('_JEXEC') or die('Restricted access');

/**
 * Attendance List View Category
 * @author Helio Nogueira <helio.nogueir@gmail.com>
 * @version 2017.09.01
 */
class AttendanceListViewCategory extends JViewLegacy {

    public function display($tpl = null) {
        $categories = Array();
        $request = $this->prepareRequest();
        $attendancelist_id = $request["attendancelist_id"];
        $search = $request["category"]["search"][$request["level"]];
        $parent = $this->prepareParent($request);
        $checked = $this->prepareChecked($request);
        $model = JModelLegacy::getInstance("Categories", "AttendanceListModel");
        if (strlen($search) >= 3) {
            $categories = $model->findCategoriesByNameAndParent($attendancelist_id, $search, $parent, $checked);
        }
        $categories = array_merge($model->findCategoriesByIdAndParent($checked, $parent), $categories);
        $filename = JPATH_COMPONENT
                . DIRECTORY_SEPARATOR . "views"
                . DIRECTORY_SEPARATOR . "category"
                . DIRECTORY_SEPARATOR . "tmpl"
                . DIRECTORY_SEPARATOR . "step"
                . DIRECTORY_SEPARATOR . "items.php";
        include($filename);
        jexit();
    }

    public function findCategoryParents($category) {
        $categories = Array();
        if (!empty($category->parent)) {
            $model = JModelLegacy::getInstance("Categories", "AttendanceListModel");
            $model->findAllParents($category->parent, $categories);
        }
        return $categories;
    }

    public function renderStepBody(stdClass $step, stdClass $setting) {
        global $ATTENDANCELIST;
        $filename = JPATH_COMPONENT
                . DIRECTORY_SEPARATOR . "views"
                . DIRECTORY_SEPARATOR . "category"
                . DIRECTORY_SEPARATOR . "tmpl"
                . DIRECTORY_SEPARATOR . "step"
                . DIRECTORY_SEPARATOR . "default.php";
        if (file_exists($filename)) {
            include($filename);
            $document = JFactory::getDocument();
            $document->addStyleSheet("{$ATTENDANCELIST->http->view}/category/assets/style.css");
            $document->addScript("{$ATTENDANCELIST->http->view}/category/assets/script.js");
            $document->addScriptDeclaration("
$(document).ready(function () {
    $(\"form\", this).each(function () {
        (new com_attendancelist_category(this, '{$setting->behavior->limit}')).prepare();
    });
});");
        }
    }

    private function prepareRequest() {
        $jinput = JFactory::getApplication()->input;
        $request = $jinput->post->getArray(Array(
            "attendancelist_id" => "int",
            "level" => "int",
            "category" => "array"
        ));
        return $request;
    }

    private function prepareParent(&$request) {
        $parent = Array();
        if (!empty($request["level"])) {
            $level = (intval($request["level"]) - 1);
            if (!empty($request["category"]["id"][$level]) && is_array($request["category"]["id"][$level])) {
                $parent = array_keys($request["category"]["id"][$level]);
            }
        } else {
            $parent = Array('0');
        }
        return $parent;
    }

    private function prepareChecked(&$request) {
        $checked = Array();
        $level = intval($request["level"]);
        if (!empty($request["category"]["id"][$level]) && is_array($request["category"]["id"][$level])) {
            $checked = array_keys($request["category"]["id"][$level]);
        }
        return $checked;
    }

}
