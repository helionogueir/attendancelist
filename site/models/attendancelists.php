<?php

defined('_JEXEC') or die('Restricted access');

/**
 * Attendance List Model Attendance Lists
 * @author Helio Nogueira <helio.nogueir@gmail.com>
 * @version 2017.09.01
 */
class AttendanceListModelAttendanceLists extends JModelList {

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

    protected function getListQuery() {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select(implode(",", $this->_fields))
                ->from($db->quoteName('#__attendancelist'));
        $query->where("published = '1'");
        $orderCol = $this->state->get('list.ordering', 'name');
        $orderDirn = $this->state->get('list.direction', 'asc');
        $query->order($db->escape($orderCol) . ' ' . $db->escape($orderDirn));
        $limit = $this->setState('list.limit', 100);
        $query->limit($limit);
        return $query;
    }

}
