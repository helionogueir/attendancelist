<?php

defined('_JEXEC') or die('Restricted access');

/**
 * Attendance List Model Category Targets
 * @author Helio Nogueira <helio.nogueir@gmail.com>
 * @version 2017.09.01
 */
class AttendanceListModelCategoryTargets extends JModelItem {

    private $_fields = Array(
        'id',
        'category_id',
        'code',
        'title',
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

    public function findAllBySearchAndCategories(Array $categories, $search = null) {
        $data = Array();
        if (count($categories)) {
            $db = JFactory::getDbo();
            $query = $db->getQuery(true);
            $query->select(implode(",", $this->_fields))
                    ->from($db->quoteName('#__attendancelist_category_target'));
            $query->where('published = 1');
            $query->where("category_id IN ('" . implode("','", $categories) . "')");
            if (!empty($search)) {
                $searchfield = $query->concatenate(Array("code", "' '", "title"));
                $query->where("{$searchfield} LIKE " . $db->quote('%' . $search . '%'));
            }
            $orderCol = $this->state->get('list.ordering', 'title');
            $orderDirn = $this->state->get('list.direction', 'asc');
            $query->order($db->escape($orderCol) . ' ' . $db->escape($orderDirn));
            $db->setQuery($query);
            $data = $db->loadObjectList();
        }
        return $data;
    }

}
