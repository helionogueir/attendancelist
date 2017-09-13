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
				'com_attendancelist.uploadtarget', 'upload', array(
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
        $db = JFactory::getDbo();

        // Busca no banco de dados o registro da linha
        $table = $db->quoteName('#__attendancelist_category');
        $fields = $db->quoteName(['id', 'name', 'obs', 'published']);

        //if($line->parent == 'NULL'){
        if(is_null($line->parent) || $line->parent == 'NULL'){// Caso seja NULL, é um cadastro de UNIDADE
            $condition = "  code = '{$line->code}' ";
        }elseif($line->parent != ''){// Se o parent existir, buscar o id do registro
            $condition = "  code = '{$line->parent}'";
        }else{// Ja cadastrado. Code e Parent existem
            $condition = "  code = '{$line->parent}' AND parent = '{$line->idParent}'";
        }

        $query = $db->getQuery(true);
        $query->select($fields)
            ->from($table)
            ->where($condition);

        $db->setQuery($query)->execute();
        $numRows = $db->getNumRows();
        if($numRows > 0){
            $retorno = $db->loadObjectList();
            $line->id = $retorno[0]->id;
            $line->nameAtual = $retorno[0]->name;
            $line->obsAtual = $retorno[0]->obs;
            $line->publishedAtual = $retorno[0]->published;
            $line->idParent = $retorno[0]->id;
            $update = $this->updateDados($line);
            $dados['id'] = $line->id;
            $dados['status'] = $update;
        }elseif($line->parent != '' && $numRows < 1){
            $dados['idParent'] = 'erro';
            $dados['status'] = 'Registro Pai não existe';
        }else{
            $lastID = $this->insertDados($line);
            $dados['idParent'] = $lastID;
            $dados['status'] = 'Cadastrado';
        }

//        echo("<pre>");
//        print_r($dados);
//        exit("</pre>");

        return $dados;
    }

    public function updateDados($line){

        $db = JFactory::getDbo();
        $query = $db->getQuery(true);

        $retorno = "Registro Existe";
        date_default_timezone_set('America/Sao_Paulo');
        $nvName = $line->name;
        $nvObs = $line->obs;
        $dateTime = date('Y-m-d H:i:s');
        $nvPublished = $line->published;

        $publishedAtual = $line->publishedAtual;
        $nameAtual = $line->nameAtual;
        $obsAtual = $line->obsAtual;

        if(!empty($name) && ($nvPublished != $publishedAtual || $nvName != $nameAtual) || $nvObs != $obsAtual) {

            $fields = [
                $db->quoteName('name') . '=' . $db->quote($nvName),
                $db->quoteName('obs') . '=' . $db->quote($nvObs),
                $db->quoteName('modified') . '=' . $db->quote($dateTime),
                $db->quoteName('published') . '=' . $db->quote($nvPublished)];

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
        $idParent = (!empty($line->idParent) ? $line->idParent : NULL);
        $dateTime = date('Y-m-d H:i:s');

        $colums = ['code', 'attendancelist_id', 'name', 'obs', 'parent', 'created', 'modified', 'published'];
        $values = [ $db->quote($line->code),
                    1,
                    $db->quote($line->name),
                    $db->quote($obs),
                    $db->quote($idParent),
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

    public function importCSV($line){
        $db = JFactory::getDbo();

        // Busca no banco de dados o registro da linha
        $table = $db->quoteName('#__attendancelist_category');
        $fields = $db->quoteName(['id', 'code', 'name', 'parent']);
        $condition = ' code = "' . $line->code . '" ';

        $query = $db->getQuery(true);
        $query->select($fields)
            ->from($table)
            ->where($condition);

        $db->setQuery($query)->execute();

        $numRows = $db->getNumRows();
        $resultado = $db->loadObjectList();
        // -----------------------------------------------
        /**
         * Achou o Registro?
         *  - Verifica se
         */


        $query->clear();
        if($numRows < 1 && !empty($line->code) && !empty($line->name)){
            $columns = array('code', 'name', 'parent', 'created');
            $values = ("'{$line->code}', '{$line->name}', NULL, now()");

            $query->insert($table)
                ->columns($db->quoteName($columns))
                ->values($values);

            return $db->setQuery($query)->execute();
            //$lastRowId = $db->insertid();
        }

        echo("<pre>");
        var_dump([$line, $numRows, $resultado, $resultado[0]->name]);
        echo("</pre>");
        exit('<hr />');

        return false;
//        $query
//            ->select($db->quoteName(['id', 'code', 'parent', 'name']))
//            ->from($db->quoteName('#__attendancelist_category'));
//            //->where('(code = '. $code .')');
    }

}
