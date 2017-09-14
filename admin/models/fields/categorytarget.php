<?php

defined('_JEXEC') or die('Restricted access');

JFormHelper::loadFieldClass('list');

/**
 * J Form Field Student
 * @author William Douglas da Silva <williamds.douglas@gmail.com>
 * @version 2017.09.04
 */
class JFormFieldCategoryTarget extends JFormFieldList {

    protected $type = 'Categorytarget';

    protected function getOptions() {
        $db = JFactory::getDBO();
        $query = $db->getQuery(true);
        $query->select('id,title');
        $query->from('#__attendancelist_category_target');
        $db->setQuery((string) $query);
        $messages = $db->loadObjectList();
        $options = array();
        if ($messages) {
            foreach ($messages as $message) {
                $options[] = JHtml::_('select.option', $message->id, $message->title);
            }
        }
        return array_merge(parent::getOptions(), $options);
    }

}
