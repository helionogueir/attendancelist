<?php

defined('_JEXEC') or die('Restricted access');

/**
 * Attendance List View Category Target
 * @author Helio Nogueira <helio.nogueir@gmail.com>
 * @version 2017.09.01
 */
class AttendanceListViewCategoryTargets extends JViewLegacy {

    public function display($tpl = null) {
        $request = $this->prepareRequest();
        $search = $request["categorytargets"]["search"];
        $categories = $this->prepareCategories($request);
        $model = JModelLegacy::getInstance("CategoryTargets", "AttendanceListModel");
        $targets = $model->findAllBySearchAndCategories($categories, $search);
        $checked = $this->prepareCategoryTargets($request);
        $filename = JPATH_COMPONENT
                . DIRECTORY_SEPARATOR . "views"
                . DIRECTORY_SEPARATOR . "categorytargets"
                . DIRECTORY_SEPARATOR . "tmpl"
                . DIRECTORY_SEPARATOR . "step"
                . DIRECTORY_SEPARATOR . "items.php";
        include($filename);
        jexit();
    }

    public function findCategoryParents($category_id, $level) {
        $categories = Array();
        if (!empty($category_id)) {
            $model = JModelLegacy::getInstance("Categories", "AttendanceListModel");
            $model->findAllParents($category_id, $categories, $level);
        }
        return $categories;
    }

    public function renderStepBody(stdClass $step, stdClass $setting) {
        global $ATTENDANCELIST;
        $filename = JPATH_COMPONENT
                . DIRECTORY_SEPARATOR . "views"
                . DIRECTORY_SEPARATOR . "categorytargets"
                . DIRECTORY_SEPARATOR . "tmpl"
                . DIRECTORY_SEPARATOR . "step"
                . DIRECTORY_SEPARATOR . "default.php";
        if (file_exists($filename)) {
            include($filename);
            $document = JFactory::getDocument();
            $document->addStyleSheet("{$ATTENDANCELIST->http->view}/categorytargets/assets/style.css");
            $document->addScript("{$ATTENDANCELIST->http->view}/categorytargets/assets/script.js");
            $document->addScriptDeclaration("
$(document).ready(function () {
    $(\"form\", this).each(function () {
        (new com_attendancelist_categorytargets(this, '{$setting->behavior->level}')).prepare();
    });
});");
        }
    }

    private function prepareRequest() {
        $jinput = JFactory::getApplication()->input;
        $request = $jinput->post->getArray(Array(
            "attendancelist_id" => "int",
            "category" => "array",
            "categorytargets" => "array",
            "level" => "int"
        ));
        return $request;
    }

    private function prepareCategories(&$request) {
        $categories = Array();
        if (!empty($request["category"]) && !empty($request["category"]["id"]) && is_array($request["category"]["id"])) {
            foreach ($request["category"]["id"] as $rowSet) {
                $categories = array_merge($categories, array_keys($rowSet));
            }
        }
        return $categories;
    }

    private function prepareCategoryTargets(&$request) {
        $categorytargets = Array();
        if (!empty($request["categorytargets"]) && !empty($request["categorytargets"]["id"]) && is_array($request["categorytargets"]["id"])) {
            $categorytargets = array_keys($request["categorytargets"]["id"]);
        }
        return $categorytargets;
    }

}
