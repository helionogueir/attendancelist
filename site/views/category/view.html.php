<?php

defined('_JEXEC') or die('Restricted access');

/**
 * Attendance List View Category
 * @author Helio Nogueira <helio.nogueir@gmail.com>
 * @version 2017.09.01
 */
class AttendanceListViewCategory extends JViewLegacy {

    protected $categories = null;
    protected $level = 0;

    public function display($tpl = null) {
        $this->data = null;
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
        $search = $level = $jinput->post->get("search");
        if (strlen($search) >= 3) {
            $this->level = $level = $jinput->post->get("level");
            $model = JModelLegacy::getInstance("Categories", "AttendanceListModel");
            $this->categories = $model->findCategoriesByNameAndParent($jinput->post->get("attendancelist_id"), $search, $this->level);
        }
        parent::display("filter");
    }

}
