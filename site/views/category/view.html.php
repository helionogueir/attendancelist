<?php

defined('_JEXEC') or die('Restricted access');

/**
 * Attendance List View Category
 * @author Helio Nogueira <helio.nogueir@gmail.com>
 * @version 2017.09.01
 */
class AttendanceListViewCategory extends JViewLegacy {

    protected $categories = Array();
    protected $level = 0;

    public function display($tpl = null) {
        $this->data = null;
        switch (JRequest::getString('task')) {
            case 'filter':
                $this->displayFilter();
                break;
            default:
                JError::raiseError(404);
                break;
        }
        jexit();
    }

    private function displayFilter() {
        $request = $this->prepareRequest();
        $model = JModelLegacy::getInstance("Categories", "AttendanceListModel");
        if (strlen($request["search"][$request["level"]]) >= 3) {
            $this->categories = $model->findCategoriesByNameAndParent($request["attendancelist_id"], $request["search"][$request["level"]], $request["parent"], $request["checked"]);
        }
        $this->checked = $request["checked"];
        $this->level = $request["level"];
        $this->categories = array_merge($model->findCategoriesById($request["checked"], $request["parent"]), $this->categories);
        parent::display("filter");
    }

    private function prepareRequest() {
        $jinput = JFactory::getApplication()->input;
        $request = $jinput->post->getArray(Array(
            "attendancelist_id" => "int",
            "level" => "int",
            "search" => "array",
            "category" => "array"
        ));
        $this->prepareParent($request);
        $this->prepareChecked($request);
        return $request;
    }

    private function prepareParent(&$request) {
        $request["parent"] = Array('0');
        if (!empty($request["level"])) {
            $level = (intval($request["level"]) - 1);
            if (!empty($request["category"][$level]) && is_array($request["category"][$level])) {
                $request["parent"] = array_keys($request["category"][$level]);
            }
        }
    }

    private function prepareChecked(&$request) {
        $level = intval($request["level"]);
        if (!empty($request["category"][$level]) && is_array($request["category"][$level])) {
            $request["checked"] = array_keys($request["category"][$level]);
        } else {
            $request["checked"] = Array();
        }
    }

}
