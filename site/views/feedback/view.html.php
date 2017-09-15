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

    public function save() {
        $jinput = JFactory::getApplication()->input;
        $request = $jinput->post->getArray(Array(
            "attendancelist_id" => "int",
            "feedback" => "array",
            "quiz" => "array",
            "categorytargets" => "array"
        ));
        $response = Array("code" => "404", "message" => JText::_("COM_ATTENDANCELIST_SAVE_ERROR"));
        if ($feedback_id = $this->saveFeedback($request["feedback"])) {
            $this->saveFeedbackQuizes($feedback_id, $request["quiz"]);
            $this->saveFeedbackPresence($feedback_id, $request["categorytargets"]);
            $response["code"] = 200;
            $response["message"] = JText::_("COM_ATTENDANCELIST_SAVE_SUCCESS");
        }
        echo json_encode($response);
        jexit();
    }

    private function saveFeedback($values) {
        $value = 0;
        $model = JModelLegacy::getInstance("Feedback", "AttendanceListModel");
        if ($id = $model->insert($values)) {
            $value = $id;
        }
        return $value;
    }

    private function saveFeedbackQuizes($feedback_id, $values) {
        $model = JModelLegacy::getInstance("FeedbackQuizes", "AttendanceListModel");
        $model->insertByQuizes($feedback_id, $values);
        return null;
    }

    private function saveFeedbackPresence($feedback_id, $values) {
        if (isset($values["id"])) {
            $model = JModelLegacy::getInstance("FeedbackPresence", "AttendanceListModel");
            foreach (array_keys($values["id"]) as $target_id) {
                $model->insert(Array(
                    "feedback_id" => $feedback_id,
                    "target_id" => $target_id
                ));
            }
        }
        return null;
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
