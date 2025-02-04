<?php
class TreeView extends TPage
{
    public function __construct()
    {
        parent::__construct();
        
        $data = array();
        $data['Brazil']['RS'][10] = 'Lajeado';
        $data['Brazil']['RS'][20] = 'Cruzeiro do Sul';
        $data['Brazil']['RS'][30] = 'Porto Alegre';
        $data['Brazil']['SP'][40] = 'São Paulo';
        $data['Brazil']['SP'][50] = 'Osasco';
        $data['Brazil']['MG'][60] = 'Belo Horizonte';
        $data['Brazil']['MG'][70] = 'Ipatinga';
        
        
        $scroll = new TScroll;
        $scroll->setSize(300, 400);
        $scroll->style = 'margin-right: 5px';
        
        $treeview = new TTreeView;
        $treeview->setSize(290);
        
        $treeview->setItemAction( new TAction([$this, 'onSelect']));
        $treeview->fromArray($data);
        
        $form = new BootstrapFormBuilder('form_test');
        $form->setFormTitle('Formulário teste');
        
        $chave = new TEntry('chave');
        $valor = new TEntry('valor');
        
        $form->addContent( [new TLabel('Chave')]);
        $form->addFields( [$chave] );
        $form->addContent( [new TLabel('Valor')]);
        $form->addFields( [$valor] );
        
        $scroll->add($treeview);
        
        $hbox = THBox::pack($scroll, $form);
        $hbox->style = 'display:inline-flex';
        
        parent::add($hbox);
    }
    
    public static function onSelect($param)
    {
    
        $obj = new stdClass;
        $obj->chave = $param['key'];
        $obj->valor = $param['value'];
        
        TForm::sendData('form_test', $obj);
        //new TMessage('info', json_encode($param));
    }
}