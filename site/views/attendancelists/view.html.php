<?php

defined('_JEXEC') or die('Restricted access');

/**
 * Attendance List View Attendance Lists
 * @author Helio Nogueira <helio.nogueir@gmail.com>
 * @version 2017.09.01
 */
class AttendanceListViewAttendanceLists extends JViewLegacy {

    public function display($tpl = null) {
        $this->items = $this->get('Items');
        if (count($errors = $this->get('Errors'))) {
            JError::raiseError(500, implode('<br />', $errors));
            return false;
        }
        parent::display($tpl);
        $this->setDocument();
    }

    private function setDocument() {
        $document = JFactory::getDocument();
        $document->setTitle(JText::_('COM_ATTENDANCELIST_ATTENDANCELISTS_TITLE'));
    }

}
