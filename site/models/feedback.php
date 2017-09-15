<?php

defined('_JEXEC') or die('Restricted access');

/**
 * Attendance List Model Feddback
 * @author Helio Nogueira <helio.nogueir@gmail.com>
 * @version 2017.09.01
 */
class AttendanceListModelFeedback extends JModelItem {

    private $_fields = Array(
        'id',
        'user_id',
        'date',
        'timestart',
        'timefinish',
        'created',
        'modified',
        'published'
    );

    public function __construct($config = array()) {
        if (empty($config['filter_fields'])) {
            $config['filter_fields'] = $this->_fields;
        }
        parent::__construct($config);
    }

    public function insert(Array $values) {
        $id = 0;
        if (!empty($values["date"]) && !empty($values["timestart"]) && !empty($values["timefinish"])) {
            $this->prepareData($values);
            $db = JFactory::getDbo();
            $db->insertObject('#__attendancelist_feedback', $values);
            $id = $db->insertid();
        }
        return $id;
    }

    public function prepareData(&$values) {
        $date = "/^(\d{2})(\/)(\d{2})(\/)(\d{4})$/";
        $time = "/^(\d{2})(\:)(\d{2})$/";
        foreach ($values as $key => &$value) {
            switch ($key) {
                case "date":
                    if (preg_match($date, $value)) {
                        $value = preg_replace($date, "$5-$3-$1", $value);
                    } else {
                        $value = null;
                    }
                    break;
                case "timestart":
                case "timefinish":
                    if (preg_match($time, $value)) {
                        $value .= ":00";
                    } else {
                        $value = null;
                    }
                    break;
                default :
                    unset($values[$key]);
                    break;
            }
        }
        $values["user_id"] = JFactory::getUser()->id;
        $values["created"] = $values["modified"] = Date("Y-m-d H:i:s");
        $values["published"] = 1;
        $values = (object) $values;
    }

}
