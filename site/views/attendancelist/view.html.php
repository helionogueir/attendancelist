<?php

defined('_JEXEC') or die('Restricted access');

/**
 * Attendance List View Attendance List
 * @author Helio Nogueira <helio.nogueir@gmail.com>
 * @version 2017.09.01
 */
class AttendanceListViewAttendanceList extends JViewLegacy {

    public function display($tpl = null) {
        $this->msg = $this->get('Msg');
        if (count($errors = $this->get('Errors'))) {
            JLog::add(implode('<br />', $errors), JLog::WARNING, 'jerror');
            return false;
        }
        parent::display($tpl);
    }

}
