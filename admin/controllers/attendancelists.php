<?php

defined('_JEXEC') or die('Restricted access');

/**
 * Attendance List Controller Attendance Lists
 * @author Helio Nogueira <helio.nogueir@gmail.com>
 * @version 2017.09.01
 */
class AttendanceListControllerAttendanceLists extends JControllerAdmin {

    public function getModel($name = 'AttendanceList', $prefix = 'AttendanceListModel', $config = array('ignore_request' => true)) {
        $model = parent::getModel($name, $prefix, $config);
        return $model;
    }

}
