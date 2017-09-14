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

    public function findAllCategoryParentById($id, &$categories) {
        if ((bool) $id) {
            $db = JFactory::getDbo();
            $query = $db->getQuery(true);
            $query->select(implode(",", $this->_fields))
                    ->from($db->quoteName('#__attendancelist_category'));
            $query->where('published = 1');
            $query->where("id = " . $query->quote($id));
            $db->setQuery($query);
            $data = $db->loadObjectList();
        }
        return null;
    }

    public function findCategoriesByIdAndParent(Array $id, Array $parent) {
        $data = Array();
        if (count($id) && count($parent)) {
            $db = JFactory::getDbo();
            $query = $db->getQuery(true);
            $query->select(implode(",", $this->_fields))
                    ->from($db->quoteName('#__attendancelist_category'));
            $query->where('published = 1');
            $query->where("id IN ('" . implode("','", $id) . "')");
            $query->where("parent IN ('" . implode("','", $parent) . "')");
            $orderCol = $this->state->get('list.ordering', 'name');
            $orderDirn = $this->state->get('list.direction', 'asc');
            $query->order($db->escape($orderCol) . ' ' . $db->escape($orderDirn));
            $db->setQuery($query);
            $data = $db->loadObjectList();
        }
        return $data;
    }

    public function findCategoriesByNameAndParent($attendancelist_id, $search, Array $parent, Array $ignoreId = Array()) {
        $data = Array();
        if (!empty($attendancelist_id) && !empty($search) && count($parent)) {
            $db = JFactory::getDbo();
            $query = $db->getQuery(true);
            $query->select(implode(",", $this->_fields))
                    ->from($db->quoteName('#__attendancelist_category'));
            $query->where('published = 1');
            $query->where("attendancelist_id = '{$attendancelist_id}'");
            $searchfield = $query->concatenate(Array("code", "' '", "name"));
            $query->where("{$searchfield} LIKE " . $db->quote('%' . $search . '%'));
            $query->where("parent IN ('" . implode("','", $parent) . "')");
            if (count($ignoreId)) {
                $query->where("id NOT IN ('" . implode("','", $ignoreId) . "')");
            }
            $orderCol = $this->state->get('list.ordering', 'name');
            $orderDirn = $this->state->get('list.direction', 'asc');
            $query->order($db->escape($orderCol) . ' ' . $db->escape($orderDirn));
            $db->setQuery($query);
            $data = $db->loadObjectList();
        }
        return $data;
    }

}
