<?php

defined('_JEXEC') or die('Restricted access');

/**
 * Attendance List Controller Attendance Categorie
 * @author William Douglas da Silva <williamds.douglas@gmail.com>
 * @version 2017.09.04
 */
class AttendanceListControllerCategories extends JControllerAdmin {

    public function getModel($name = 'Category', $prefix = 'AttendanceListModel', $config = array('ignore_request' => true)) {
        $model = parent::getModel($name, $prefix, $config);
        return $model;
    }

}
