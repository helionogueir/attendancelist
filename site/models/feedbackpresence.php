<?php

defined('_JEXEC') or die('Restricted access');

/**
 * Attendance List Model Feedback Presence
 * @author Helio Nogueira <helio.nogueir@gmail.com>
 * @version 2017.09.01
 */
class AttendanceListModelFeedbackPresence extends JModelItem {

    private $_fields = Array(
        'id',
        'feedback_id',
        'target_id'
    );
    private $tablename = '#__attendancelist_feedback_presence';

    public function __construct($config = array()) {
        if (empty($config['filter_fields'])) {
            $config['filter_fields'] = $this->_fields;
        }
        parent::__construct($config);
    }

    public function insert($values) {
        $id = 0;
        if (!empty($values["feedback_id"]) && !empty($values["target_id"])) {
            $db = JFactory::getDbo();
            $values = (object) $values;
            $db->insertObject($this->tablename, $values);
            $id = $db->insertid();
        }
        return $id;
    }

}
