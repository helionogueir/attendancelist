<?php

defined('_JEXEC') or die('Restricted access');

/**
 * Attendance List View Category
 * @author Helio Nogueira <helio.nogueir@gmail.com>
 * @version 2017.09.01
 */
class AttendanceListViewCategory extends JViewLegacy {

    public function display($tpl = null) {
        return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
    }

    public function renderStepBody(stdClass $step, stdClass $setting) {
        global $ATTENDANCELIST;
        $filename = JPATH_COMPONENT
                . DIRECTORY_SEPARATOR . "views"
                . DIRECTORY_SEPARATOR . "category"
                . DIRECTORY_SEPARATOR . "tmpl"
                . DIRECTORY_SEPARATOR . "step"
                . DIRECTORY_SEPARATOR . "default.php";
        if (file_exists($filename)) {
            include($filename);
            $document = JFactory::getDocument();
            $document->addStyleSheet("{$ATTENDANCELIST->http->view}/category/assets/style.css");
            $document->addScript("{$ATTENDANCELIST->http->view}/category/assets/script.js");
        }
    }

}
