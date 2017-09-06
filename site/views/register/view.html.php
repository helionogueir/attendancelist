<?php

defined('_JEXEC') or die('Restricted access');

/**
 * Attendance List View Register
 * @author Helio Nogueira <helio.nogueir@gmail.com>
 * @version 2017.09.01
 */
class AttendanceListViewRegister extends JViewLegacy {

    public function display($tpl = null) {
        if (count($errors = $this->get('Errors'))) {
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
        $document->setTitle(JText::_('COM_ATTENDANCELIST_REGISTER_TITLE'));
    }

}
