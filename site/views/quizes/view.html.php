<?php

defined('_JEXEC') or die('Restricted access');

/**
 * Attendance List View Quizes
 * @author Helio Nogueira <helio.nogueir@gmail.com>
 * @version 2017.09.01
 */
class AttendanceListViewQuizes extends JViewLegacy {

    public function display($tpl = null) {
        return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
    }

    public function renderStepBody(stdClass $step, stdClass $setting) {
        global $ATTENDANCELIST;
        $filename = JPATH_COMPONENT
                . DIRECTORY_SEPARATOR . "views"
                . DIRECTORY_SEPARATOR . "quizes"
                . DIRECTORY_SEPARATOR . "tmpl"
                . DIRECTORY_SEPARATOR . "step"
                . DIRECTORY_SEPARATOR . "default.php";
        if (file_exists($filename)) {
            $model = JModelLegacy::getInstance("Quizes", "AttendanceListModel");
            $quizes = $model->findAllByAttendancelistId($step->attendancelist_id);
            include($filename);
            unset($quizes);
            $document = JFactory::getDocument();
            $document->addStyleSheet("{$ATTENDANCELIST->http->view}/quizes/assets/style.css");
        }
    }

    public function addQuizAlternatives(&$quiz) {
        if (!empty($quiz->id) && !empty($quiz->type)) {
            $filename = JPATH_COMPONENT
                    . DIRECTORY_SEPARATOR . "views"
                    . DIRECTORY_SEPARATOR . "quizes"
                    . DIRECTORY_SEPARATOR . "tmpl"
                    . DIRECTORY_SEPARATOR . "step"
                    . DIRECTORY_SEPARATOR . "alternative"
                    . DIRECTORY_SEPARATOR . "{$quiz->type}.php";
            if (file_exists($filename)) {
                $model = JModelLegacy::getInstance("QuizAlternatives", "AttendanceListModel");
                $alternatives = $model->findAllByQuizId($quiz->id);
                $setting = $this->prepareQuizSetting($quiz);
                include($filename);
                unset($alternatives);
                unset($setting);
            }
        }
    }

    private function prepareQuizSetting(stdClass $quiz) {
        $setting = new stdClass();
        if (!empty($quiz->setting)) {
            $setting = json_decode($quiz->setting);
            if (json_last_error() != JSON_ERROR_NONE) {
                $setting = new stdClass();
            }
        }
        return $setting;
    }

}
