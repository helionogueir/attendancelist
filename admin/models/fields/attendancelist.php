<?php

defined('_JEXEC') or die('Restricted access');

JFormHelper::loadFieldClass('list');

/**
 * J Form Field Attendance List
 * @author Helio Nogueira <helio.nogueir@gmail.com>
 * @version 2017.09.01
 */
class JFormFieldAttendanceList extends JFormFieldList {

    protected $type = 'AttendanceList';

    protected function getOptions() {
        $db = JFactory::getDBO();
        $query = $db->getQuery(true);
        $query->select('id,name');
        $query->from('#__attendancelist');
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
