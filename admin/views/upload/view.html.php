<?php

defined('_JEXEC') or die('Restricted access');

/**
 * Attendance List View Attendance Categories
 * @author William Douglas da Silva <williamds.silva@gmail.com>
 * @version 2017.09.04
 */
class AttendanceListViewUpload extends JViewLegacy {

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

        $title = JText::_('COM_ATTENDANCELIST_LABEL_UPLOAD');

        JToolbarHelper::title($title, 'upload');
        JToolbarHelper::save('upload.save', 'JTOOLBAR_UPLOAD');
        JToolbarHelper::cancel('upload.cancel', 'JTOOLBAR_CANCEL');
    }

    protected function setDocument() {
        $document = JFactory::getDocument();
        $document->setTitle(JText::_('COM_ATTENDANCELIST_CATEGORIE_TARGET_CREATING'));
    }

}
