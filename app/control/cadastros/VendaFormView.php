<?php

use Adianti\Control\TAction;
use Adianti\Control\TPage;
use Adianti\Database\TTransaction;
use Adianti\Widget\Base\TScript;
use Adianti\Widget\Container\TPanelGroup;
use Adianti\Widget\Datagrid\TDataGrid;
use Adianti\Widget\Datagrid\TDataGridColumn;
use Adianti\Widget\Dialog\TMessage;
use Adianti\Widget\Form\TLabel;
use Adianti\Widget\Util\TTextDisplay;
use Adianti\Wrapper\BootstrapDatagridWrapper;
use Adianti\Wrapper\BootstrapFormBuilder;

class VendaFormView extends TPage{
    public function __construct()
    {
        parent::__construct();
        parent::setTargetContainer('adianti_right_panel');

        $this->form = new BootstrapFormBuilder();
        $this->form->setFormTitle('Venda');

        $this->form->addHeaderActionLink('Fechar', new TAction([$this, 'onClose']), 'fa:times red');

        parent::add($this->form);

    }
    public function onView($param){

        try {
            TTransaction::open('local');
            $venda = new Venda($param['key']);
            $this->form->addFields([new TLabel('Código')],[new TTextDisplay($venda->id, '#333')]);
            $this->form->addFields([new TLabel('Data')],[new TTextDisplay($venda->dt_venda, '#333')]);
            $this->form->addFields([new TLabel('Total')],[new TTextDisplay($venda->total, '#333')]);
            $this->form->addFields([new TLabel('Cliente')],[new TTextDisplay($venda->cliente, '#333')]);
            $this->form->addFields([new TLabel('Obs')],[new TTextDisplay($venda->obs, '#333')]);
            
            $list = new BootstrapDatagridWrapper(new TDataGrid);
            $list->style = 'width:100%';

            $col_produto = new TDataGridColumn('produto->descricao', ' Produto', 'left');
            $col_preco = new TDataGridColumn('preco_venda', 'Preço', 'right');
            $col_qtde = new TDataGridColumn('quantidade', 'Quantidade', 'center');
            $col_desconto = new TDataGridColumn('desconto', 'Desconto', 'right');
            $col_total = new TDataGridColumn('total', 'Total', 'right');

            $list->addColumn($col_produto);
            $list->addColumn($col_preco);
            $list->addColumn($col_qtde);
            $list->addColumn($col_desconto);
            $list->addColumn($col_total); 

            $list->createModel();

            $itens = VendaItem::where('venda_id', '=', $venda->id)->load();
            $list->addItems($itens);

            $panel = new TPanelGroup('Itens');
            $panel->add($list);

            $this->form->addContent([$panel]);  

            TTransaction::close();
        } catch (Exception $e){
            new TMessage('error', $e->getMessage());
        }

    }

    public function onClose($param){
         TScript::create('Template.closeRightPanel()');
    }
}

?>