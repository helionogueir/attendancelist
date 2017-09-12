<?php

defined('_JEXEC') or die('Restricted access');

/**
 * Attendance List View Category
 * @author Helio Nogueira <helio.nogueir@gmail.com>
 * @version 2017.09.01
 */
class AttendanceListViewCategory extends JViewLegacy {

    protected $data = null;

    public function display($tpl = null) {
        $this->data = null;
        $this->addModels();
        switch (JRequest::getString('task')) {
            case 'filter':
                $this->displayFilter();
                break;
            default:
                JError::raiseError(404);
                break;
        }
        jexit();
    }

    private function displayFilter() {
        $jinput = JFactory::getApplication()->input;
        $model = $this->getModel("Categories");
        $this->data = $model->getCategoriesByParent($jinput->post->get("attendancelist_id"));
        parent::display("filter");
    }

    private function addModels() {
        $this->setModel(JModelLegacy::getInstance("Categories", "AttendanceListModel"));
    }

}
