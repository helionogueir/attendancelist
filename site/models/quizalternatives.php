<?php

defined('_JEXEC') or die('Restricted access');

/**
 * Attendance List Model Quiz Alternatives
 * @author Helio Nogueira <helio.nogueir@gmail.com>
 * @version 2017.09.01
 */
class AttendanceListModelQuizAlternatives extends JModelItem {

    private $_fields = Array(
        'id',
        'quiz_id',
        'position',
        'alternative',
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

    public function findAllByQuizId($quiz_id, Array $alternatives = Array()) {
        $data = Array();
        if (!empty($quiz_id)) {
            $db = JFactory::getDbo();
            $query = $db->getQuery(true);
            $query->select(implode(",", $this->_fields))
                    ->from($db->quoteName('#__attendancelist_quiz_alternative'));
            $query->where('published = 1');
            $query->where("quiz_id = '{$quiz_id}'");
            if (count($alternatives)) {
                $query->where("id IN ('" . implode("','", $alternatives) . "')");
            }
            $orderCol = $this->state->get('list.ordering', 'position');
            $orderDirn = $this->state->get('list.direction', 'asc');
            $query->order($db->escape($orderCol) . ' ' . $db->escape($orderDirn));
            $db->setQuery($query);
            $data = $db->loadObjectList();
        }
        return $data;
    }

}
