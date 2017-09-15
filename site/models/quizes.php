<?php

defined('_JEXEC') or die('Restricted access');

/**
 * Attendance List Model Quizes
 * @author Helio Nogueira <helio.nogueir@gmail.com>
 * @version 2017.09.01
 */
class AttendanceListModelQuizes extends JModelItem {

    private $_fields = Array(
        'id',
        'attendancelist_id',
        'position',
        'type',
        'question',
        'obs',
        'setting',
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

    public function findAllByAttendancelistId($attendancelist_id) {
        $data = Array();
        if (!empty($attendancelist_id)) {
            $db = JFactory::getDbo();
            $query = $db->getQuery(true);
            $query->select(implode(",", $this->_fields))
                    ->from($db->quoteName('#__attendancelist_quiz'));
            $query->where('published = 1');
            $query->where("attendancelist_id = '{$attendancelist_id}'");
            $orderCol = $this->state->get('list.ordering', 'position');
            $orderDirn = $this->state->get('list.direction', 'asc');
            $query->order($db->escape($orderCol) . ' ' . $db->escape($orderDirn));
            $db->setQuery($query);
            $data = $db->loadObjectList();
        }
        return $data;
    }

}
