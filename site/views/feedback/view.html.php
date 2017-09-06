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
        $this->quiz = $this->get("Items", "Quizes");
        if (!(bool) $id || count($errors = $this->get('Errors'))) {
            JError::raiseError(500, implode('<br />', $errors));
            return false;
        }
        parent::display($tpl);
        $this->setDocument();
    }

    protected function setDocument() {
        $document = JFactory::getDocument();
        $document->addStyleSheet(JURI::root(true) . '/components/com_attendancelist/assets/master.class.css');
        $document->addStyleSheet(JURI::root(true) . '/components/com_attendancelist/assets/register.class.css');
        $document->setTitle(JText::_('COM_ATTENDANCELIST_FEEDBACK_TITLE'));
    }

    private function addModels() {
        $this->setModel(JModelLegacy::getInstance("Quizes", "AttendanceListModel"));
    }

}
