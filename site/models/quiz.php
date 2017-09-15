<?php

defined('_JEXEC') or die('Restricted access');

/**
 * Attendance List Model Quiz
 * @author Helio Nogueira <helio.nogueir@gmail.com>
 * @version 2017.09.01
 */
class AttendanceListModelQuiz extends JModelItem {

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

    public function findRowById($id) {
        $data = Array();
        if (!empty($id)) {
            $db = JFactory::getDbo();
            $query = $db->getQuery(true);
            $query->select(implode(",", $this->_fields))
                    ->from($db->quoteName('#__attendancelist_quiz'));
            $query->where('published = 1');
            $query->where("id = '{$id}'");
            $db->setQuery($query);
            $data = $db->loadObject();
        }
        return $data;
    }

}
