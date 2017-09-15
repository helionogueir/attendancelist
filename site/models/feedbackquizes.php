<?php

defined('_JEXEC') or die('Restricted access');

/**
 * Attendance List Model Feedback Quizes
 * @author Helio Nogueira <helio.nogueir@gmail.com>
 * @version 2017.09.01
 */
class AttendanceListModelFeedbackQuizes extends JModelItem {

    private $_fields = Array(
        'id',
        'feedback_id',
        'question',
        'answer'
    );
    private $tablename = '#__attendancelist_feedback_quiz';

    public function __construct($config = array()) {
        if (empty($config['filter_fields'])) {
            $config['filter_fields'] = $this->_fields;
        }
        parent::__construct($config);
    }

    public function insertByQuizes($feedback_id, Array $values) {
        $insert = new stdClass();
        $insert->feedback_id = $feedback_id;
        $quiz = JModelLegacy::getInstance("Quiz", "AttendanceListModel");
        $quizAlternatives = JModelLegacy::getInstance("QuizAlternatives", "AttendanceListModel");
        foreach ($values as $quiz_id => $value) {
            $insert->question = null;
            $insert->answer = "";
            if ($row = $quiz->findRowById($quiz_id)) {
                $insert->question = $row->question;
                switch ($row->type) {
                    case "textarea":
                        $insert->answer = $value;
                        break;
                    default :
                        $value = is_array($value) ? array_keys($value) : Array($value);
                        if ($rowSet = $quizAlternatives->findAllByQuizId($quiz_id, $value)) {
                            $answer = Array();
                            foreach ($rowSet as $row) {
                                $answer[] = $row->alternative;
                            }
                            $insert->answer = implode(',', $answer);
                        }
                        break;
                }
            }
            $this->insert($insert);
        }
        return null;
    }

    public function insert($values) {
        $id = 0;
        if (!empty($values->feedback_id) && !empty($values->question) && !empty($values->answer)) {
            $db = JFactory::getDbo();
            $db->insertObject($this->tablename, $values);
            $id = $db->insertid();
        }
        return $id;
    }

    public function findRowByID($id) {
        $data = Array();
        if (!empty($id)) {
            $db = JFactory::getDbo();
            var_dump(get_class_methods($db));
            die;
            $query = $db->getQuery(true);
            $query->select(implode(",", $this->_fields))
                    ->from($db->quoteName($this->tablename));
            $query->where('published = 1');
            $query->where("quiz_id = '{$quiz_id}'");
            $orderCol = $this->state->get('list.ordering', 'position');
            $orderDirn = $this->state->get('list.direction', 'asc');
            $query->order($db->escape($orderCol) . ' ' . $db->escape($orderDirn));
            $db->setQuery($query);
            $data = $db->loadObjectList();
        }
        return $data;
    }

}
