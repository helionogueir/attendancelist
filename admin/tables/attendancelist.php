<?php

defined('_JEXEC') or die('Restricted access');

/**
 * Attendance List Model Attendance List
 * @author Helio Nogueira <helio.nogueir@gmail.com>
 * @version 2017.09.01
 */
class AttendanceListTableAttendanceList extends JTable {

    public function __construct(&$db) {
        parent::__construct('#__attendancelist', 'id', $db);
    }

}
