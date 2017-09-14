<?php

defined('_JEXEC') or die('Restricted access');

/**
 * Attendance List Model Attendance Categorie
 * @author William Douglas da Silva <williamds.douglas@gmail.com>
 * @version 2017.09.04
 */
class AttendanceListModelUploadtarget extends JModelAdmin {

    public function getTable($type = 'CategoryTarget', $prefix = 'AttendanceListTable', $config = array()) {
        return JTable::getInstance($type, $prefix, $config);
    }

    public function getForm($data = array(), $loadData = true) {
        $form = $this->loadForm(
				'com_attendancelist.uploadtarget', 'uploadtarget', array(
                'control' => 'jform',
                'load_data' => $loadData
            )
        );
        if (empty($form)) {
            return false;
        }
        return $form;
    }

    protected function loadFormData() {
        $data = JFactory::getApplication()->getUserState(
            'com_attendancelist.default.uploadtarget.data', array()
        );
        if (empty($data)) {
            $data = $this->getItem();
        }
        return $data;
    }

    public function getRegistroLine($line){

        $retorno['status'] = 'Nada foi feito';
        
        // Busca no banco de dados o registro da linha

        $dados = $this->consultaTarget($line);

        if(!$dados){
            $this->insertDados($line);
            $retorno['status'] = 'Cadastrado';
        }else{
            $line->id = $dados->id;
            $this->updateDados($line);
            $retorno['status'] = 'Atualizado';
        }

        return $retorno;
    }
    public function consultaTarget($line){
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);

        $retorno[0] = false;

        $table = $db->quoteName('#__attendancelist_category_target');
        $fields = $db->quoteName(['id', 'category_id', 'code', 'title', 'obs', 'published']);
        $condition = " code = '{$line->code}' AND category_id = {$line->parent}";

        $query->select($fields)
            ->from($table)
            ->where($condition);

        $db->setQuery($query)->execute();
        $numRows = $db->getNumRows();
        if($numRows > 0){
            $retorno = $db->loadObjectList();
        }
        return $retorno[0];
    }


    public function getattendancelist(){
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);

        $table = $db->quoteName('#__attendancelist');
        $fields = $db->quoteName(['id', 'code', 'name', 'obs', 'published']);
        $condition = " published = 1";
        $query->select($fields)
            ->from($table)
            ->where($condition);
        return $query;
        //$db->setQuery($query)->execute();

    }

    // Consulta a categoria PAI
    public function consultaCategory($line){
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);

        $retorno[0] = false;

        $table = $db->quoteName('#__attendancelist_category');
        $fields = $db->quoteName(['id', 'name', 'obs', 'published']);
        $condition = " code = '{$line->code}' AND parent = {$line->parent}";

        $query->select($fields)
            ->from($table)
            ->where($condition);

        $db->setQuery($query)->execute();
        $numRows = $db->getNumRows();
        if($numRows > 0){
            $retorno = $db->loadObjectList();
        }
        return $retorno[0];
    }

    // Consulta a categoria FILHO
    public function consultaCategoryRecursivo($line){
        if(!isset($line->idParent)) {
            $linhaPai = new stdClass();
            $linhaPai->code = $line->parent;
            $linhaPai->parent = 0;
        }else{
            $linhaPai = new stdClass();
            $linhaPai->code = $line->parent;
            $linhaPai->parent = $line->idParent;;
        }
        return $this->consultaCategory($linhaPai);
    }

    public function updateDados($line){

        $db = JFactory::getDbo();
        $query = $db->getQuery(true);

        $retorno = "Registro Existe";
        date_default_timezone_set('America/Sao_Paulo');
        $name = $line->name;
        $obs = $line->obs;
        $dateTime = date('Y-m-d H:i:s');
        $published = $line->published;

        if(!empty($name)) {

            $fields = [
                $db->quoteName('title') . '=' . $db->quote($name),
                $db->quoteName('obs') . '=' . $db->quote($obs),
                $db->quoteName('modified') . '=' . $db->quote($dateTime),
                $db->quoteName('published') . '=' . $db->quote($published)];

            $conditions = [$db->quoteName('id') . '=' . $line->id];

            $query
                ->update($db->quoteName("#__attendancelist_category_target"))
                ->set($fields)
                ->where($conditions);

            $db->setQuery($query)->execute();
            $retorno = "Atualizado";
        }
        return $retorno;
    }

    public function insertDados($line){

        $db = JFactory::getDbo();
        $query = $db->getQuery(true);

        date_default_timezone_set('America/Sao_Paulo');
        $obs = isset($line->obs) ? $line->obs : '';
        $dateTime = date('Y-m-d H:i:s');

        $colums = ['category_id', 'code', 'title', 'obs', 'created', 'modified', 'published'];
        $values = [ $db->quote($line->parent),
                    $db->quote($line->code),
                    $db->quote($line->name),
                    $db->quote($obs),
                    $db->quote($dateTime),
                    $db->quote($dateTime),
                    1
                  ];
        $query
            ->insert($db->quoteName("#__attendancelist_category_target"))
            ->columns($colums)
            ->values(implode(',', $values));

        $db->setQuery($query)->execute();
        return $db->insertid();
    }
}
