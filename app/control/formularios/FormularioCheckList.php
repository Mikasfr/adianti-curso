<?php

use Adianti\Control\TAction;
use Adianti\Control\TPage;
use Adianti\Database\TTransaction;
use Adianti\Widget\Container\THBox;
use Adianti\Widget\Form\TCheckList;
use Adianti\Widget\Form\TEntry;
use Adianti\Widget\Form\TLabel;
use Adianti\Wrapper\BootstrapFormBuilder;

class FormularioCheckList extends TPage{
    public function __construct()
    {
        parent::__construct();
        
        $this->form = new BootstrapFormBuilder();
        $this->form->setFormTitle('checklist');

        $id = new TEntry('id');
        $nome = new TEntry('nome');
        $lista = new TCheckList('lista_produtos');

        $lista->addColumn('id',          'id',             'center', '10%');  
        $lista->addColumn('descricao',   'Descricao',      'left',   '50%');  
        $lista->addColumn('preco_venda', 'Valor de venda', 'left',   '50%');  
        $lista->setHeight(250);
        $lista->makeScrollable();

        $input = new TEntry('busca');
        $input->placeholder = 'Busca...';
        $input->setSize('100%');

        $lista->enableSearch($input, 'id, descricao');

        $hbox = new THBox;
        $hbox->style = 'border-bottom:1px solid grey; padding-bottom:20px';
        $hbox->add(new TLabel('Produtos'));
        $hbox->add($input)->style = 'float:right; width:30%';

        $this->form->addContent([$hbox]);        
        $this->form->addFields([new TLabel('id')], [$id]);
        $this->form->addFields([new TLabel('Nome')], [$nome]);
        $this->form->addFields([new TLabel('Produtos')], [$lista]);

        // TTransaction::open('local');
        // $produtos = Produto::all();
        // TTransaction::close();

        $lista->addItems(Produto::allInTransaction('local'));
        $this->form->addAction('Enviar', new TAction([$this, 'onSend']), 'fa:save');
        parent::add($this->form);
    }

    public function onSend($param){
        $data = $this->form->getData();

        $this->form->setData($data);
        echo '<pre>';
        var_dump($data);
        echo '</pre>';
    }

}

?>