<?php

defined('_JEXEC') or die('Restricted access');

/**
 * Attendance List Controller
 * @author Helio Nogueira <helio.nogueir@gmail.com>
 * @version 2017.09.01
 */
class AttendanceListController extends JControllerLegacy {

    protected $default_view = 'attendancelists';

    public function __construct($config = array()) {
        global $ATTENDANCELIST;
        $ATTENDANCELIST = new stdClass();
        $ATTENDANCELIST->http = new stdClass();
        $ATTENDANCELIST->http->component = JURI::base(true) . '/components/com_attendancelist';
        $ATTENDANCELIST->http->view = "{$ATTENDANCELIST->http->component}/views";
        parent::__construct($config);
    }

    public function display($cachable = false, $urlparams = array()) {
        global $ATTENDANCELIST;
        $document = JFactory::getDocument();
        $document->addScript("{$ATTENDANCELIST->http->view}/assets/jquery/jquery.min.js");
        $document->addScript("{$ATTENDANCELIST->http->view}/assets/validate/mask.class.js");
        $document->addScript("{$ATTENDANCELIST->http->view}/assets/validate/validate.class.js");
        $document->addScriptDeclaration("
var attendancelist = new Object({
    \"http\": { \"component\":\"{$ATTENDANCELIST->http->component}\" },
    \"message\": {
        \"validate:response:invalid\": \"" . JText::_("COM_ATTENDANCELIST_VALIDATE_RESPONSE_INVALID") . "\"
    }
});");
        parent::display($cachable, $urlparams);
    }

    public function save() {
        $valid = false;
        $document = JFactory::getDocument();
        if ($viewName = $this->input->get('view')) {
            $view = $this->getView($viewName, $document->getType());
            if (in_array("save", get_class_methods($view))) {
                $valid = true;
                $view->save();
            }
        }
        if (!$valid) {
            JError::raiseError(500, implode('<br />', $errors));
            return false;
        }
    }

}
