<?php

defined('_JEXEC') or die('Restricted access');

/**
 * Attendance List Model Attendance List
 * @author Helio Nogueira <helio.nogueir@gmail.com>
 * @version 2017.09.01
 */
class AttendanceListModelAttendanceList extends JModelItem {

    private $_fields = Array(
        'id',
        'code',
        'name',
        'obs',
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

    public function getAttendancelistById($attendancelist_id) {
        $data = null;
        if (!empty($attendancelist_id)) {
            $db = JFactory::getDbo();
            $query = $db->getQuery(true);
            $query->select(implode(",", $this->_fields))
                    ->from($db->quoteName('#__attendancelist'));
            $query->where('published = 1');
            $query->where("id = '{$attendancelist_id}'");
            $orderCol = $this->state->get('list.ordering', 'id');
            $orderDirn = $this->state->get('list.direction', 'asc');
            $query->order($db->escape($orderCol) . ' ' . $db->escape($orderDirn));
            $db->setQuery($query);
            $data = $db->loadObjectList();
        }
        return (is_array($data)) ? end($data) : $data;
    }

}
