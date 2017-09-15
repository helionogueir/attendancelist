<?php

defined('_JEXEC') or die('Restricted access');

/**
 * Attendance List View Page
 * @author Helio Nogueira <helio.nogueir@gmail.com>
 * @version 2017.09.01
 */
class AttendanceListViewPage extends JViewLegacy {

    public function display($tpl = null) {
        //global $ATTENDANCELIST;
        if (count($errors = $this->get('Errors'))) {
            JError::raiseError(500, implode('<br />', $errors));
            return false;
        }
        parent::display($tpl);
        //$document = JFactory::getDocument();
        //$document->addStyleSheet("{$ATTENDANCELIST->http->view}/finish/assets/style.css");
    }

}
