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

}