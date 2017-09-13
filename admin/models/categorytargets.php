<?php

defined('_JEXEC') or die('Restricted access');

/**
 * Attendance List Model Attendance Categories
 * @author William Douglas da Silva <williamds.douglas@gmail.com>
 * @version 2017.09.04
 */
class AttendanceListModelCategoryTargets extends JModelList {

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

    protected function getListQuery() {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);

        $query
            ->select($db->quoteName('T.ID', 'id'))
            ->select($db->quoteName('C.code', 'code_categoria'))
            ->select($db->quoteName('C.name', 'categoria'))
            ->select($db->quoteName('T.code', 'code_target'))
            ->select($db->quoteName('T.title', 'title'))
            ->select($db->quoteName('T.obs', 'obs'))
            ->select($db->quoteName('T.published', 'published'))
            ->from($db->quoteName('#__attendancelist_category_target', 'T'))
            ->join('INNER', $db->quoteName('#__attendancelist_category', 'C') . ' ON ' . $db->quoteName('T.category_id') . ' = ' . $db->quoteName('C.id'))
            ->where('(T.published IN (0,1))')
            ->order('T.title ASC');
        return $query;
    }

}
