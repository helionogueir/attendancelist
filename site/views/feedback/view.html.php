<?php

defined('_JEXEC') or die('Restricted access');

/**
 * Attendance List View Feedback
 * @author Helio Nogueira <helio.nogueir@gmail.com>
 * @version 2017.09.01
 */
class AttendanceListViewFeedback extends JViewLegacy {

    public function display($tpl = null) {
        global $ATTENDANCELIST;
        $model = JModelLegacy::getInstance("AttendanceList", "AttendanceListModel");
        $this->attendancelist = $model->getAttendancelistById(JFactory::getApplication()->input->get('id'));
        if (empty($this->attendancelist->name) || count($errors = $this->get('Errors'))) {
            JError::raiseError(500, implode('<br />', $errors));
            return false;
        }
        parent::display($tpl);
        $document = JFactory::getDocument();
        $document->setTitle(JText::_($this->attendancelist->name));
        $document->addStyleSheet("{$ATTENDANCELIST->http->view}/feedback/assets/style.css");
        $document->addScript("{$ATTENDANCELIST->http->view}/feedback/assets/script.js");
    }

    public function render($attendancelist_id) {
        $document = JFactory::getDocument();
        $controller = JControllerLegacy::getInstance("");
        $view = $controller->getView("steps", $document->getType());
        $view->render($attendancelist_id);
    }

    public function renderStepBody(stdClass $step, stdClass $setting) {
        $filename = JPATH_COMPONENT
                . DIRECTORY_SEPARATOR . "views"
                . DIRECTORY_SEPARATOR . "feedback"
                . DIRECTORY_SEPARATOR . "tmpl"
                . DIRECTORY_SEPARATOR . "step"
                . DIRECTORY_SEPARATOR . "default.php";
        if (file_exists($filename)) {
            include($filename);
        }
    }

}
