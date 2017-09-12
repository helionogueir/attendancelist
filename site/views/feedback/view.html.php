<?php

defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.modellist.quizes');

/**
 * Attendance List View Feedback
 * @author Helio Nogueira <helio.nogueir@gmail.com>
 * @version 2017.09.01
 */
class AttendanceListViewFeedback extends JViewLegacy {

    public function display($tpl = null) {
        $this->addModels();
        $jinput = JFactory::getApplication()->input;
        $this->attendancelist_id = $jinput->get->get("id");
        $this->addQuizes($this->attendancelist_id);
        if (!(bool) $this->attendancelist_id || count($errors = $this->get('Errors'))) {
            JError::raiseError(500, implode('<br />', $errors));
            return false;
        }
        parent::display($tpl);
        $this->setDocument();
    }

    public function addQuizAlternatives(&$quiz) {
        if (!empty($quiz->id) && !empty($quiz->type) && defined('JPATH_COMPONENT')) {
            $filename = JPATH_COMPONENT
                    . DIRECTORY_SEPARATOR . "views"
                    . DIRECTORY_SEPARATOR . "quiz"
                    . DIRECTORY_SEPARATOR . "tmpl"
                    . DIRECTORY_SEPARATOR . "alternative"
                    . DIRECTORY_SEPARATOR . "{$quiz->type}.html.php";
            if (file_exists($filename)) {
                $model = $this->getModel("QuizAlternatives");
                $rowSet = $model->getAltenativesByQuizId($quiz->id);
                include($filename);
                unset($rowSet);
            }
            unset($filename);
        }
    }

    public function addCategories() {
        $filename = JPATH_COMPONENT
                . DIRECTORY_SEPARATOR . "views"
                . DIRECTORY_SEPARATOR . "category"
                . DIRECTORY_SEPARATOR . "tmpl"
                . DIRECTORY_SEPARATOR . "category.html.php";
        if (file_exists($filename)) {
            include($filename);
        } else {
            die("OK");
        }
    }

    protected function setDocument() {
        $document = JFactory::getDocument();
        $document->addStyleSheet(JURI::base(true) . '/components/com_attendancelist/assets/master.class.css');
        $document->addStyleSheet(JURI::base(true) . '/components/com_attendancelist/assets/feedback/feedback.class.css');
        $document->addScript(JURI::base(true) . '/components/com_attendancelist/assets/jquery/jquery.min.js');
        $document->addScript(JURI::base(true) . '/components/com_attendancelist/assets/feedback/feedback.class.js');
        $document->setTitle(JText::_('COM_ATTENDANCELIST_FEEDBACK_TITLE'));
    }

    private function addModels() {
        $this->setModel(JModelLegacy::getInstance("Quizes", "AttendanceListModel"));
        $this->setModel(JModelLegacy::getInstance("QuizAlternatives", "AttendanceListModel"));
    }

    private function addQuizes($id) {
        $model = $this->getModel("Quizes");
        $this->quizes = $model->getQuizesByAttendancelistId($id);
        return (bool) count($this->quizes);
    }

}
