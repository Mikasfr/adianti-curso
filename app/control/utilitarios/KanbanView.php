<?php

use Adianti\Control\TAction;
use Adianti\Control\TPage;
use Adianti\Core\AdiantiCoreTranslator;
use Adianti\Database\TTransaction;
use Adianti\Widget\Dialog\TMessage;
use Adianti\Widget\Dialog\TQuestion;
use Adianti\Widget\Util\TKanban;

class KanbanView extends TPage{
    private $form;
    public function __construct(){
      parent::__construct();      
          parent::__construct();
          TTransaction::open('local');
          $colunas = KanbanColuna::orderBy('gti002_serial')->load();
          $tarefas = KanbanTarefaModel::orderBy('gti003_serial')->load();
          TTransaction::close();

          $kanban = new TKanban;
          $kanban->setStageHeight('80vh');
          
          foreach ($colunas as $key => $coluna){
            $kanban->addStage($coluna->gti002_serial, $coluna->gti002_coluna, $coluna);

          }

          foreach($tarefas as $key => $tarefa){
            $kanban->addItem($tarefa->gti003_serial, $tarefa->gti002_serial, $tarefa->gti003_tarefa, $tarefa->gti003_obs, 'black', $tarefa);
          } 

          $kanban->addStageAction('Edit', new TAction(['KanbanStageForm', 'onEdit']), 'far:edit blue fa-fw');

          //$kanban->addItem(123, 1, 'teste', 'teste');
          $kanban->setStageDropAction(new TAction([__CLASS__, 'onUpdateStageDrop']));
          $kanban->setItemDropAction(new TAction([__CLASS__, 'onUpdateItemDrop']));
          
          parent::add($kanban);
    }

    public function onLoad($param)
    {
    
    }
    public static function onStageDrop() {

    }
    public static function onItemDrop() {

    }
    public static function onUpdateStageDrop($param)
    {
        if (empty($param['order']))
        {
            return;
        }
        
        try
        {
            TTransaction::open('local');
            
            foreach ($param['order'] as $key => $id)
            {
                $sequence = ++ $key;
    
                $coluna = new KanbanColuna($id);
                $coluna->gti002_serial = $sequence;
    
                $coluna->store();
            }
            
            TTransaction::close();
        }
        catch (Exception $e)
        {
            new TMessage('error', $e->getMessage());
        }
    }
    public static function onUpdateItemDrop($param)
    {
        if (empty($param['order']))
        {
            return;
        }
        try
        {
            TTransaction::open('local');
    
            foreach ($param['order'] as $key => $id)
            {
                $sequence = ++$key;
    
                $item = new KanbanTarefaModel($id);
                $item->gti003_serial = $sequence;
                $item->gti002_serial = $param['gti002_serial'];
                $item->store();
            }
            
            TTransaction::close();
        }
        catch (Exception $e)
        {
            new TMessage('error', $e->getMessage());
        }
    }
  
}
?>