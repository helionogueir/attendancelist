<?php

defined('_JEXEC') or die('Restricted access');

/**
 * Attendance List Model Attendance Categorie
 * @author William Douglas da Silva <williamds.douglas@gmail.com>
 * @version 2017.09.04
 */
class AttendanceListTableCategoryTarget extends JTable {

    public function __construct(&$db) {
        parent::__construct('#__attendancelist_category_target', 'id', $db);
    }

}
