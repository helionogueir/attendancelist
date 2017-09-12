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
        $model = JModelLegacy::getInstance("AttendanceList", "AttendanceListModel");
        $this->attendancelist = $model->getAttendancelistById(JRequest::getString('id'));
        if (!(bool) $this->attendancelist || count($errors = $this->get('Errors'))) {
            JError::raiseError(500, implode('<br />', $errors));
            return false;
        }
        parent::display($tpl);
        $this->setDocument();
    }

    public function addQuizes($attendancelist_id) {
        if (defined('JPATH_COMPONENT')) {
            $filename = JPATH_COMPONENT
                    . DIRECTORY_SEPARATOR . "views"
                    . DIRECTORY_SEPARATOR . "quiz"
                    . DIRECTORY_SEPARATOR . "tmpl"
                    . DIRECTORY_SEPARATOR . "template.php";
            if (file_exists($filename)) {
                $model = JModelLegacy::getInstance("Quizes", "AttendanceListModel");
                $quizes = $model->getQuizesByAttendancelistId($attendancelist_id);
                include($filename);
                unset($quizes);
            }
        }
    }

    public function addQuizAlternatives(&$quiz) {
        if (!empty($quiz->id) && !empty($quiz->type) && defined('JPATH_COMPONENT')) {
            $filename = JPATH_COMPONENT
                    . DIRECTORY_SEPARATOR . "views"
                    . DIRECTORY_SEPARATOR . "quiz"
                    . DIRECTORY_SEPARATOR . "tmpl"
                    . DIRECTORY_SEPARATOR . "alternative"
                    . DIRECTORY_SEPARATOR . "{$quiz->type}.php";
            if (file_exists($filename)) {
                $model = JModelLegacy::getInstance("QuizAlternatives", "AttendanceListModel");
                $alternatives = $model->getAltenativesByQuizId($quiz->id);
                include($filename);
                unset($alternatives);
            }
        }
    }

    public function addLabels($attendancelist_id) {
        if (defined('JPATH_COMPONENT')) {
            $filename = JPATH_COMPONENT
                    . DIRECTORY_SEPARATOR . "views"
                    . DIRECTORY_SEPARATOR . "category"
                    . DIRECTORY_SEPARATOR . "tmpl"
                    . DIRECTORY_SEPARATOR . "template.php";
            if (file_exists($filename)) {
                $model = JModelLegacy::getInstance("CategoryLabels", "AttendanceListModel");
                $labels = $model->getLabelByAttendancelistId($attendancelist_id);
                include($filename);
                unset($labels);
            }
            unset($filename);
        }
    }

    protected function setDocument() {
        $document = JFactory::getDocument();
        $document->addStyleSheet(JURI::base(true) . '/components/com_attendancelist/assets/master.class.css');
        $document->addStyleSheet(JURI::base(true) . '/components/com_attendancelist/assets/feedback/feedback.class.css');
        $document->addStyleSheet(JURI::base(true) . '/components/com_attendancelist/assets/category/category.class.css');
        $document->addScript(JURI::base(true) . '/components/com_attendancelist/assets/jquery/jquery.min.js');
        $document->addScript(JURI::base(true) . '/components/com_attendancelist/assets/category/category.class.js');
        $document->addScript(JURI::base(true) . '/components/com_attendancelist/assets/feedback/feedback.class.js');
        $document->setTitle(JText::_('COM_ATTENDANCELIST_FEEDBACK_TITLE'));
    }

}
