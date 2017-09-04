<?php

defined('_JEXEC') or die('Restricted access');

/**
 * Attendance List Model Attendance List
 * @author Helio Nogueira <helio.nogueir@gmail.com>
 * @version 2017.09.01
 */
class AttendanceListModelAttendanceList extends JModelAdmin {

    public function getTable($type = 'AttendanceList', $prefix = 'AttendanceListTable', $config = array()) {
        return JTable::getInstance($type, $prefix, $config);
    }

    public function getForm($data = array(), $loadData = true) {
        $form = $this->loadForm(
                'com_attendancelist.attendancelist', 'attendancelist', array(
            'control' => 'jform',
            'load_data' => $loadData
                )
        );
        if (empty($form)) {
            return false;
        }
        return $form;
    }

    protected function loadFormData() {
        $data = JFactory::getApplication()->getUserState(
                'com_attendancelist.edit.attendancelist.data', array()
        );
        if (empty($data)) {
            $data = $this->getItem();
        }
        return $data;
    }

}
