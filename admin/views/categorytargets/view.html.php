<?php

defined('_JEXEC') or die('Restricted access');

/**
 * Attendance List View Attendance Categories
 * @author William Douglas da Silva <williamds.silva@gmail.com>
 * @version 2017.09.04
 */
class AttendanceListViewCategoryTargets extends JViewLegacy {

    public function display($tpl = null) {
        $app = JFactory::getApplication();
        $context = "attendancelist.list.admin.categorytarget";
        $this->items = $this->get('Items');
        $this->state = $this->get('State');
        $this->filter_order = $app->getUserStateFromRequest($context . 'filter_order', 'filter_order', 'name', 'cmd');
        $this->filter_order_Dir = $app->getUserStateFromRequest($context . 'filter_order_Dir', 'filter_order_Dir', 'asc', 'cmd');
        $this->filterForm = $this->get('FilterForm');
        $this->activeFilters = $this->get('ActiveFilters');
        $this->pagination = $this->get('Pagination');
        if (count($errors = $this->get('Errors'))) {
            JError::raiseError(500, implode('<br />', $errors));
            return false;
        }
        $this->addToolBar();
        parent::display($tpl);
        $this->setDocument();
    }

    protected function addToolBar() {
        JToolBarHelper::title(JText::_('COM_ATTENDANCELIST_FUNCTIONALITY_CATEGORY_TARGET'), 'attendancelist');
        //JToolbarHelper::addNew('categorytarget.add');
        //JToolbarHelper::editList('categorytarget.edit');
        JToolbarHelper::link('/administrator/index.php?option=com_attendancelist&view=uploadtarget&layout=default', 'Enviar CSV Alunos');
    }

    protected function setDocument() {
        $document = JFactory::getDocument();
        $document->setTitle(JText::_('COM_ATTENDANCELIST_ADMINISTRATION'));
    }

}
