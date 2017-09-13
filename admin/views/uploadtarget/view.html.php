<?php

defined('_JEXEC') or die('Restricted access');

/**
 * Attendance List View Attendance Categories
 * @author William Douglas da Silva <williamds.silva@gmail.com>
 * @version 2017.09.04
 */
class AttendanceListViewUploadtarget extends JViewLegacy {

    protected $form = null;
    public $retorno = null;

    public function display($tpl = null) {
        $files = JFactory::getApplication()->input->files;
        $file = $files->get('importfile');

        if( !empty($file['name']) ) {
            JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

            $extensao = pathinfo($file['name'], PATHINFO_EXTENSION);
            if($extensao == 'csv'){
                $this->import_file($file);
            }
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

    public function import_file($file)
    {
        $x = 0;
        $this->retorno = '';
        $fileObjeto = new SplFileObject($file['tmp_name']);
        $fileObjeto->setFlags(SplFileObject::READ_CSV);
        $fileObjeto->setCsvControl(';');

        foreach ($fileObjeto as $row){
            // flush();// Somente para acompanhar o processo de desenvolvimento

            if($x == 0 || empty($row[0])){
                $x++;
                continue;
            }
            $x++;

            $line = new stdClass();
            $line->code = (!empty($row[0]) ? $row[0] : 'erro');
            $line->name = (!empty($row[1]) ? $row[1] : 'erro');
            $line->parent = (empty($row[2]) ? NULL : trim($row[2]));
            $line->obs = (isset($row[3]) ? trim($row[3]) : NULL);
            $line->published = (isset($row[4]) ? trim($row[4]) : 1);
            if($line->code == 'erro' || $line->name == 'erro'){
                exit("Codigo e Nome são obrigatorios. Linha: {$x}");
            }
            $this->importCSV($line);

            $this->retorno .= "[ {$x} ] - Code: {$line->code}, Name: {$line->name}, Parent: {$line->parent}, Obs: {$line->obs}, Published: {$line->published}, {$line->retorno['status']}<br />";

            //ob_flush();
        }
    }

    public function importCSV($line){
        $model	= $this->getModel('upload');

        $vetParent = array_map('trim',explode(',', $line->parent));
        if(count($vetParent) > 1) {
            foreach ($vetParent as $parent) {// Percorre o PARENT e busca cada um dos nós
                $line->parent = $parent;
                $this->importCSV($line);
            }
        }else{
            $retorno = $model->getRegistroLine($line);

            if(isset($retorno['idParent']) && $retorno['idParent'] == 'erro'){
                $line->retorno = $retorno;
                return;
            }
            $line->retorno = $retorno;
        }

    }

    protected function addToolBar() {
        $input = JFactory::getApplication()->input;
        $input->set('hidemainmenu', true);

        $title = JText::_('COM_ATTENDANCELIST_LABEL_UPLOAD');

        JToolbarHelper::title($title, 'upload');
        JToolbarHelper::link('/administrator/index.php?option=com_attendancelist&view=categorytargets', 'Voltar');
    }

    protected function setDocument() {
        $document = JFactory::getDocument();
        $document->setTitle(JText::_('COM_ATTENDANCELIST_CATEGORIE_TARGET_CREATING'));
    }

}
