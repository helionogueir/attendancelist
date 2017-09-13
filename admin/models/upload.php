<?php

defined('_JEXEC') or die('Restricted access');

/**
 * Attendance List Model Attendance Categorie
 * @author William Douglas da Silva <williamds.douglas@gmail.com>
 * @version 2017.09.04
 */
class AttendanceListModelUpload extends JModelAdmin {

    public function getTable($type = 'CategoryTarget', $prefix = 'AttendanceListTable', $config = array()) {
        return JTable::getInstance($type, $prefix, $config);
    }

    public function getForm($data = array(), $loadData = true) {
        $form = $this->loadForm(
				'com_attendancelist.upload', 'upload', array(
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
            'com_attendancelist.default.upload.data', array()
        );
        if (empty($data)) {
            $data = $this->getItem();
        }
        return $data;
    }

    public function getRegistroLine($line){

        $retorno['status'] = 'Nada foi feito';
        $dadosPai = 0;
        // Busca no banco de dados o registro da linha

        if(empty($line->parent)) {// Nivel ZERO - PAI
            $line->parent = 0;
        }elseif(!isset($line->idParent)){
            $linhaPai = new stdClass();
            $linhaPai->code = $line->parent;
            $linhaPai->parent = 0;
            $dados = $this->consultaPai($linhaPai);
            if(!$dados){
                $retorno['status'] = 'ERRO. Código informado não existe';
                $retorno['id'] = 'erro';
                return $retorno;
            }
            $line->parent = $dados->id;
        }

        $dados = $this->consultaPai($line);

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

    // Consulta a categoria PAI
    public function consultaPai($line){
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
    public function consultaPaiRecursivo($line){
        if(!isset($line->idParent)) {
            $linhaPai = new stdClass();
            $linhaPai->code = $line->parent;
            $linhaPai->parent = 0;
        }else{
            $linhaPai = new stdClass();
            $linhaPai->code = $line->parent;
            $linhaPai->parent = $line->idParent;;
        }
        return $this->consultaPai($linhaPai);
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
                $db->quoteName('name') . '=' . $db->quote($name),
                $db->quoteName('obs') . '=' . $db->quote($obs),
                $db->quoteName('modified') . '=' . $db->quote($dateTime),
                $db->quoteName('published') . '=' . $db->quote($published)];

            $conditions = [$db->quoteName('id') . '=' . $line->id];

            $query
                ->update($db->quoteName("#__attendancelist_category"))
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

        $colums = ['code', 'attendancelist_id', 'name', 'obs', 'parent', 'created', 'modified', 'published'];
        $values = [ $db->quote($line->code),
                    1,
                    $db->quote($line->name),
                    $db->quote($obs),
                    $db->quote($line->parent),
                    $db->quote($dateTime),
                    $db->quote($dateTime),
                    1
                  ];

//        echo("<pre>");
//        echo(implode(',', $values));
//        var_dump([$colums, $values]);
//        print_r([$colums, $values]);
//        exit("</pre>");

        $query
            ->insert($db->quoteName("#__attendancelist_category"))
            ->columns($colums)
            ->values(implode(',', $values));

        $db->setQuery($query)->execute();
        return $db->insertid();
    }
}
