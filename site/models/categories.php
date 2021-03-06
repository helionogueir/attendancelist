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

    public function findAllParents($parent, Array &$categories, &$level = null) {
        if ((bool) $parent) {
            $db = JFactory::getDbo();
            $query = $db->getQuery(true);
            $query->select(implode(",", $this->_fields))
                    ->from($db->quoteName('#__attendancelist_category'));
            $query->where('published = 1');
            $query->where("id = " . $query->quote($parent));
            $db->setQuery($query);
            if ($rowSet = $db->loadObjectList()) {
                $row = end($rowSet);
                if (!empty($row->id) && !isset($categories[$row->id])) {
                    $categories[$row->id] = $row;
                    if ((is_null($level) || $level) && !empty($row->parent)) {
                        $level--;
                        $this->findAllParents($row->parent, $categories);
                    }
                }
            }
        }
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

    public function findCategoriesByNameAndParent($attendancelist_id, $search, Array $parent, Array $ignoreId = Array(), $limit = 0) {
        $data = Array();
        if (!empty($attendancelist_id) && count($parent)) {
            $db = JFactory::getDbo();
            $query = $db->getQuery(true);
            $query->select(implode(",", $this->_fields))
                    ->from($db->quoteName('#__attendancelist_category'));
            $query->where('published = 1');
            $query->where("attendancelist_id = '{$attendancelist_id}'");
            $query->where("parent IN ('" . implode("','", $parent) . "')");
            if (!empty($search)) {
                $searchfield = $query->concatenate(Array("code", "' '", "name"));
                $query->where("{$searchfield} LIKE " . $db->quote('%' . $search . '%'));
            }
            if (count($ignoreId)) {
                $query->where("id NOT IN ('" . implode("','", $ignoreId) . "')");
            }
            $orderCol = $this->state->get('list.ordering', 'name');
            $orderDirn = $this->state->get('list.direction', 'asc');
            $query->order($db->escape($orderCol) . ' ' . $db->escape($orderDirn));
            if (!empty($limit)) {
                $query->setLimit($limit);
            }
            $db->setQuery($query);
            $data = $db->loadObjectList();
        }
        return $data;
    }

}
