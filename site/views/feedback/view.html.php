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
        $id = $jinput->get->get("id");
        if (!(bool) $id || count($errors = $this->get('Errors'))) {
            JError::raiseError(500, implode('<br />', $errors));
            return false;
        }
        $model = $this->getModel("Quizes");
        $this->quizes = $model->getQuizesByAttendancelistId($id);
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

    protected function setDocument() {
        $document = JFactory::getDocument();
        $document->addStyleSheet(JURI::base(true) . '/components/com_attendancelist/assets/master.class.css');
        $document->addStyleSheet(JURI::base(true) . '/components/com_attendancelist/assets/register.class.css');
        $document->setTitle(JText::_('COM_ATTENDANCELIST_FEEDBACK_TITLE'));
    }

    private function addModels() {
        $this->setModel(JModelLegacy::getInstance("Quizes", "AttendanceListModel"));
        $this->setModel(JModelLegacy::getInstance("QuizAlternatives", "AttendanceListModel"));
    }

}
