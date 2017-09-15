<?php

defined('_JEXEC') or die('Restricted access');

/**
 * Attendance List View Attendance Categories
 * @author William Douglas da Silva <williamds.silva@gmail.com>
 * @version 2017.09.04
 */
class AttendanceListViewUpload extends JViewLegacy {

    protected $form = null;
    public $retorno = null;

    public function display($tpl = null) {
        $files = JFactory::getApplication()->input->files;
        $file = $files->get('importfile');

        if( !empty($file['name']) ) {
            JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

            $lista = $_POST['attendancelist'];
            $extensao = pathinfo($file['name'], PATHINFO_EXTENSION);
            if($extensao == 'csv'){
                $this->import_file($file, $lista);
            }
            exit;
        }

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

    public function import_file($file, $lista)
    {
        $x = 0;
        $this->retorno = '';
        $fileObjeto = new SplFileObject($file['tmp_name']);
        $fileObjeto->setFlags(SplFileObject::READ_CSV);
        $fileObjeto->setCsvControl(';');

        foreach ($fileObjeto as $row){
            flush();// Somente para acompanhar o processo de desenvolvimento

            if($x == 0 || empty($row[0])){
                $x++;
                continue;
            }
            $x++;

            $line = new stdClass();
            $line->code = (!empty($row[0]) ? $row[0] : 'erro');
            $line->name = (!empty($row[1]) ? $row[1] : 'erro');
            $line->parent = (empty($row[2]) ? NULL : trim($row[2]));
            $line->obs = (empty($row[3]) ? NULL : trim($row[3]));
            $line->published = (isset($row[4])  ? trim($row[4]) : 1);
            $line->lista = $lista;
            if($line->code == 'erro' || $line->name == 'erro'){
                exit("Codigo e Nome são obrigatorios. Linha: {$x}");
            }
            $this->importCSV($line);

            $dadosLinha = implode(';',$row);
            echo "{$x}|{$line->retorno['status']}|{$dadosLinha}<br />";
            //$this->retorno .= "[ {$x} ] - Code: {$line->code}, Name: {$line->name}, Parent: {$line->parent}, Obs: {$line->obs}, Published: {$line->published}, {$line->retorno['status']}<br />";
            ob_flush();
        }
    }

    public function importCSV($line){
        $model	= $this->getModel('upload');

        $vetParent = array_map('trim',explode(',', $line->parent));
        if(count($vetParent) > 1) {
            $retorno = $this->getPaiRecursivo($line, $vetParent);
            if((!$retorno)){
                $line->retorno['status'] = 'erro';
                return;
            }
        }

        $retorno = $model->getRegistroLine($line);

        if((!$retorno) || isset($retorno['id']) && $retorno['id'] == 'erro'){
            $line->retorno = $retorno;
            return;
        }
        $line->retorno = $retorno;
    }

    public function getPaiRecursivo($line, $vetParent){
        $model	= $this->getModel('upload');
        $resultado = false;
        foreach ($vetParent as $parent) {// Percorre o PARENT e busca cada um dos nós
            $line->parent = $parent;
            $resultado = $model->consultaPaiRecursivo($line);
            if($resultado) {
                $line->idParent = $resultado->id;
            }
        }
        if($resultado){
            $line->parent = $line->idParent;
        }
        return $resultado;
    }

    protected function addToolBar() {
        $input = JFactory::getApplication()->input;
        $input->set('hidemainmenu', true);

        $title = JText::_('COM_ATTENDANCELIST_LABEL_UPLOAD');

        JToolbarHelper::title($title, 'upload');
        JToolbarHelper::link('/administrator/index.php?option=com_attendancelist&view=categories', 'Voltar');
    }

    protected function setDocument() {
        $document = JFactory::getDocument();
        $document->setTitle(JText::_('COM_ATTENDANCELIST_CATEGORIE_TARGET_CREATING'));
        $document->addScript( "/administrator/components/com_attendancelist/views/upload/submitbutton.js" );
    }

}
