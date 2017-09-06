<?php

defined('_JEXEC') or die('Restricted access');

/**
 * Attendance List Controller Students
 * @author William Douglas da Silva <williamds.douglas@gmail.com>
 * @version 2017.09.04
 */
class AttendanceListControllerCategoryTargets extends JControllerAdmin {

    public function getModel($name = 'CategoryTarget', $prefix = 'AttendanceListModel', $config = array('ignore_request' => true)) {
        $model = parent::getModel($name, $prefix, $config);
        return $model;
    }

}
