<?php

defined('_JEXEC') or die('Restricted access');

/**
 * Attendance List Model Attendance List
 * @author Helio Nogueira <helio.nogueir@gmail.com>
 * @version 2017.09.01
 */
class AttendanceListModelAttendanceList extends JModelItem {

    protected $messages;

    public function getTable($type = 'AttendanceList', $prefix = 'AttendanceListTable', $config = array()) {
        return JTable::getInstance($type, $prefix, $config);
    }

    public function getMsg($id = 1) {
        if (!is_array($this->messages)) {
            $this->messages = array();
        }
        if (!isset($this->messages[$id])) {
            $jinput = JFactory::getApplication()->input;
            $id = $jinput->get('id', 1, 'INT');
            $table = $this->getTable();
            $table->load($id);
            $this->messages[$id] = $table->greeting;
        }

        return $this->messages[$id];
    }

}
