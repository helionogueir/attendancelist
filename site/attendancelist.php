<?php

/**
 * Site Home
 * @author Helio Nogueira <helio.nogueir@gmail.com>
 * @version 2017.09.01
 */
defined('_JEXEC') or die('Restricted access');
$user = JFactory::getUser();
if (empty($user->id)) {
    JFactory::getApplication()->redirect("index.php");
} else {
    $controller = JControllerLegacy::getInstance('AttendanceList');
    $controller->execute(JFactory::getApplication()->input->get('task'));
    $controller->redirect();
}