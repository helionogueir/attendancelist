<?php

defined('_JEXEC') or die('Restricted access');

/**
 * Attendance List Model Categories
 * @author Helio Nogueira <helio.nogueir@gmail.com>
 * @version 2017.09.01
 */
class AttendanceListModelCategories extends JModelItem {

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

    public function findCategoriesByNameAndParent($attendancelist_id, $search, $parent = '0') {
        $data = Array();
        $parent = (!empty($parent)) ? $parent : '0';
        if (!empty($attendancelist_id) && !empty($search)) {
            $db = JFactory::getDbo();
            $query = $db->getQuery(true);
            $query->select(implode(",", $this->_fields))
                    ->from($db->quoteName('#__attendancelist_category'));
            $query->where('published = 1');
            $query->where("attendancelist_id = '{$attendancelist_id}'");
            $query->where('name LIKE ' . $db->quote('%' . $search . '%'));
            $query->where("parent = '{$parent}'");
            $orderCol = $this->state->get('list.ordering', 'id');
            $orderDirn = $this->state->get('list.direction', 'asc');
            $query->order($db->escape($orderCol) . ' ' . $db->escape($orderDirn));
            $db->setQuery($query);
            $data = $db->loadObjectList();
        }
        return $data;
    }

}
