<?php

use Adianti\Control\TAction;
use Adianti\Control\TPage;
use Adianti\Registry\TSession;
use Adianti\Widget\Base\TElement;
use Adianti\Widget\Container\TPanel;
use Adianti\Widget\Container\TPanelGroup;
use Adianti\Widget\Datagrid\TDataGrid;
use Adianti\Widget\Datagrid\TDataGridAction;
use Adianti\Widget\Datagrid\TDataGridColumn;
use Adianti\Widget\Datagrid\TPageNavigation;
use Adianti\Widget\Form\TCombo;
use Adianti\Widget\Form\TEntry;
use Adianti\Widget\Form\TForm;
use Adianti\Widget\Util\TDropDown;
use Adianti\Wrapper\BootstrapDatagridWrapper;

class ClienteList extends TPage{
    private $datagrid;
    private $pageNavigation;

    use \Adianti\Base\AdiantiStandardListTrait;

    public function __construct()
    {
      parent::__construct();
      $this->setDatabase('local');
      $this->setActiveRecord('Cliente');
      $this->setDefaultOrder('id', 'asc');
      $this->addFilterField('id', '=', 'id');
      $this->addFilterField('nome', 'ilike', 'nome');
      $this->addFilterField('endereco', 'ilike', 'endereco');
      $this->addFilterField('(SELECT nome from cidade where cidade.id = cidade_id)', 'ilike', 'cidade');
      $this->addFilterField('genero', '=', 'genero');
  
      $this->setOrderCommand('city->name', '(select nome from cidade where cidade_id = cidade.id)');
      $this->datagrid = new BootstrapDatagridWrapper(new TDataGrid);
      $this->datagrid->style = 'width:100$';
      $col_id       = new TDataGridColumn('id', 'Código', 'center', '10%'); //atributos sendo dados/momeDaColuna/alinhamento/proporção na coluna
      $col_nome     = new TDataGridColumn('nome', 'Nome', 'left', '28%');
      $col_endereco = new TDataGridColumn('endereco', 'Endereço', 'left', '28%'); 
      $col_cidade   = new TDataGridColumn('{cidade->nome} ({cidade->estado->nome})', 'Cidade', 'left', '28%'); 
      $col_genero   = new TDataGridColumn('genero', 'Genero', 'left', '28%');
      
      $col_id->setAction(new TAction([$this, 'onReload']), ['order' => 'id']);
      $col_nome->setAction(new TAction([$this, 'onReload']), ['order' => 'nome']);
      $col_endereco->setAction(new TAction([$this, 'onReload']), ['order' => 'endereco']);  
      $col_cidade->setAction(new TAction([$this, 'onReload']), ['order' => 'city->name']);  

      $this->datagrid->addColumn($col_id);
      $this->datagrid->addColumn($col_nome);
      $this->datagrid->addColumn($col_endereco);
      $this->datagrid->addColumn($col_cidade);
      $this->datagrid->addColumn($col_genero);

      $col_genero->setTransformer(function($genero){
        return $genero == 'F' ? 'Feminino' : 'Masculino';
      });

      $action1 = new TDataGridAction(['ClienteForm', 'onEdit'], ['key' => '{id}', 'register_state'=>'false']);
      $action2 = new TDataGridAction([$this, 'onDelete'], ['key' => '{id}']);

      $this->datagrid->addAction($action1, 'Editar', 'fa:edit blue');
      $this->datagrid->addAction($action2, 'Excluir', 'fa:trash red');

      $this->pageNavigation = new TPageNavigation;
      $this->pageNavigation->setAction(new TAction([$this, 'onReload']));
      $this->pageNavigation->enableCounters();

      $this->datagrid->createModel();

      $this->form = new TForm;
      $this->form->add($this->datagrid);
      $id = new TEntry('id');
      $nome = new TEntry('nome');
      $endereco = new TEntry('endereco');
      $cidade = new TEntry('cidade');
      $genero = new TCombo('genero'); 

      $this->form->setData(TSession::getValue(__CLASS__.'_filter_data'));

      $genero->addItems(['M' => 'Masculino', 'F' => 'Feminino']);

      // exitOnEnter serve para que quando clicado enter seja executado a pesquisa direto a partir do campo que parou a digitação 

      $id->exitOnEnter();
      $nome->exitOnEnter();
      $endereco->exitOnEnter();
      $cidade->exitOnEnter();

      // tabindex faz com que nenhum campo seja focado assim que a pagina é carregada

      $id->tabindex = -1;
      $nome->tabindex = -1;
      $endereco->tabindex = -1;
      $cidade->tabindex = -1;
      $genero->tabindex = -1;

      $id->setExitAction(new TAction([$this, 'onSearch'], ['static' => '1']));
      $nome->setExitAction(new TAction([$this, 'onSearch'], ['static' => '1']));
      $endereco->setExitAction(new TAction([$this, 'onSearch'], ['static' => '1']));
      $cidade->setExitAction(new TAction([$this, 'onSearch'], ['static' => '1']));
      $genero->setChangeAction(new TAction([$this, 'onSearch'], ['static' => '1']));
      
      $tr = new TElement('tr');
      $this->datagrid->prependRow($tr); 

      $tr->add(TElement::tag('td', ''));
      $tr->add(TElement::tag('td', ''));
      $tr->add(TElement::tag('td', $id));
      $tr->add(TElement::tag('td', $nome));
      $tr->add(TElement::tag('td', $endereco));
      $tr->add(TElement::tag('td', $cidade));
      $tr->add(TElement::tag('td', $genero));

      $this->form->addField($id);
      $this->form->addField($nome);
      $this->form->addField($endereco);
      $this->form->addField($cidade);
      $this->form->addField($genero);

      $panel = new TPanelGroup;
      $panel->add($this->form);
      $panel->addFooter($this->pageNavigation);

      $dropdown = new TDropDown('Exportar', 'fa:list');
      $dropdown->setButtonClass('btn btn-default waves-effect dropdown-toggle');
      $dropdown->addAction('Salvar como PDF', new TAction([$this, 'onExportPDF'], ['register_state' => 'false', 'static'=>'1']), 'fa:file-pdf fa-fw blue');

      $panel->addHeaderWidget($dropdown);
      $panel->addHeaderActionLink('Novo', new TAction(['ClienteForm', 'onEdit'], ['register_state'=>'false']), 'fa:plus green');

      parent::add($panel);
    }
}


?>