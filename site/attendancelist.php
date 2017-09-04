<?php

/**
 * Site Home
 * @author Helio Nogueira <helio.nogueir@gmail.com>
 * @version 2017.09.01
 */
defined('_JEXEC') or die('Restricted access');
$controller = JControllerLegacy::getInstance('AttendanceList');
$input = JFactory::getApplication()->input;
$controller->execute($input->getCmd('task'));
$controller->redirect();
