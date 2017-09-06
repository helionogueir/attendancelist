<?php

defined('_JEXEC') or die('Restricted access');

/**
 * Attendance List Model Attendance Categorie
 * @author William Douglas da Silva <williamds.douglas@gmail.com>
 * @version 2017.09.04
 */
class AttendanceListModelUpload extends JModelAdmin {

    public function getTable($type = 'CategoryTarget', $prefix = 'AttendanceListTable', $config = array()) {
        return JTable::getInstance($type, $prefix, $config);
    }

    public function getForm($data = array(), $loadData = true) {
        $form = $this->loadForm(
				'com_attendancelist.upload', 'upload', array(
                'control' => 'jform',
                'load_data' => $loadData
            )
        );
        if (empty($form)) {
            return false;
        }
        return $form;
    }

    protected function loadFormData() {
        $data = JFactory::getApplication()->getUserState(
            'com_attendancelist.edit.upload.data', array()
        );
        if (empty($data)) {
            $data = $this->getItem();
        }
        return $data;
    }

}
