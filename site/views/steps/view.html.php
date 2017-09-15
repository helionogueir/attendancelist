<?php

defined('_JEXEC') or die('Restricted access');

/**
 * Attendance List View Steps
 * @author Helio Nogueira <helio.nogueir@gmail.com>
 * @version 2017.09.01
 */
class AttendanceListViewSteps extends JViewLegacy {

    public function display($tpl = null) {
        return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
    }

    public function render($attendancelist_id) {
        $filename = JPATH_COMPONENT
                . DIRECTORY_SEPARATOR . "views"
                . DIRECTORY_SEPARATOR . "steps"
                . DIRECTORY_SEPARATOR . "tmpl"
                . DIRECTORY_SEPARATOR . "default.php";
        if (file_exists($filename)) {
            $model = JModelLegacy::getInstance("Steps", "AttendanceListModel");
            $steps = $model->findAllByAttendancelistId($attendancelist_id);
            include($filename);
            unset($steps);
        }
    }

    public function prepareStepBody(stdClass $step) {
        $setting = $this->prepareStepSetting($step);
        $classObject = $this->prepareStepViewClass($setting);
        if (is_object($classObject)) {
            $classObject->renderStepBody($step, $setting);
        }
    }

    private function prepareStepSetting(stdClass $step) {
        $setting = new stdClass();
        if (!empty($step->setting)) {
            $setting = json_decode($step->setting);
            if (json_last_error() != JSON_ERROR_NONE) {
                $setting = new stdClass();
            }
        }
        return $setting;
    }

    private function prepareStepViewClass(stdClass $setting) {
        $classObject = null;
        if (!empty($setting->view)) {
            $document = JFactory::getDocument();
            $controller = JControllerLegacy::getInstance("");
            $classObject = $controller->getView($setting->view, $document->getType());
            if (!in_array("renderStepBody", get_class_methods($classObject))) {
                $classObject = null;
            }
        }
        return $classObject;
    }

}
