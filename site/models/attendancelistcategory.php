<?php

defined('_JEXEC') or die('Restricted access');

/**
 * Attendance List Model Attendance Lists Category
 * @author Helio Nogueira <helio.nogueir@gmail.com>
 * @version 2017.09.01
 */
class AttendanceListModelAttendanceListCategory extends JModelList {

    private $_fields = Array(
        'id',
        'attendancelist_id',
        'code',
        'parent',
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
                ->from($db->quoteName('#__attendancelist_category'));
        $search = $this->getState('filter.search');
        if (!empty($search)) {
            $like = $db->quote('%' . $search . '%');
            $query->where('name LIKE ' . $like);
        }
        $published = $this->getState('filter.published');
        if (is_numeric($published)) {
            $query->where('published = ' . (int) $published);
        } elseif ($published === '') {
            $query->where('(published IN (0, 1))');
        }
        $orderCol = $this->state->get('list.ordering', 'name');
        $orderDirn = $this->state->get('list.direction', 'asc');
        $query->order($db->escape($orderCol) . ' ' . $db->escape($orderDirn));
        return $query;
    }

}
