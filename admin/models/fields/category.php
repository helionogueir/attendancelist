<?php

defined('_JEXEC') or die('Restricted access');

JFormHelper::loadFieldClass('list');

/**
 * J Form Field Attendance List
 * @author William Douglas da Silva <williamds.douglas@gmail.com>
 * @version 2017.09.04
 */
class JFormFieldAttendanceList extends JFormFieldList {

    protected $type = 'Category';

    protected function getOptions() {
        $db = JFactory::getDBO();
        $query = $db->getQuery(true);
        $query->select('id,name');
        $query->from('#__attendancelist_category');
        $db->setQuery((string) $query);
        $messages = $db->loadObjectList();
        $options = array();
        if ($messages) {
            foreach ($messages as $message) {
                $options[] = JHtml::_('select.option', $message->id, $message->name);
            }
        }
        return array_merge(parent::getOptions(), $options);
    }

}
