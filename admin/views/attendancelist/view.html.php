<?php

defined('_JEXEC') or die('Restricted access');

/**
 * Attendance List View Attendance List
 * @author Helio Nogueira <helio.nogueir@gmail.com>
 * @version 2017.09.01
 */
class AttendanceListViewAttendanceList extends JViewLegacy {

    protected $form = null;

    public function display($tpl = null) {
        $this->form = $this->get('Form');
        $this->item = $this->get('Item');
        $this->script = $this->get('Script');
        if (count($errors = $this->get('Errors'))) {
            JError::raiseError(500, implode('<br />', $errors));
            return false;
        }
        $this->addToolBar();
        parent::display($tpl);
        $this->setDocument();
    }

    protected function addToolBar() {
        $input = JFactory::getApplication()->input;
        $input->set('hidemainmenu', true);
        $isNew = ($this->item->id == 0);
        if ($isNew) {
            $title = JText::_('COM_ATTENDANCELIST_FUNCTIONALITY_NEW_LIST');
        } else {
            $title = JText::_('COM_ATTENDANCELIST_FUNCTIONALITY_EDIT_LIST');
        }
        JToolbarHelper::title($title, 'attendancelist');
        JToolbarHelper::save('attendancelist.save');
        JToolbarHelper::cancel(
                'attendancelist.cancel', $isNew ? 'JTOOLBAR_CANCEL' : 'JTOOLBAR_CLOSE'
        );
    }

    protected function setDocument() {
        $isNew = ($this->item->id < 1);
        $document = JFactory::getDocument();
        $document->setTitle($isNew ? JText::_('COM_ATTENDANCELIST_ATTENDANCELIST_CREATING') :
                        JText::_('COM_ATTENDANCELIST_ATTENDANCELIST_EDITING'));
    }

}
