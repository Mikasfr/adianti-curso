<?php
class ModalForm extends TPage
{
    private $form;
    
    public function __construct()
    {
        parent::__construct();
        
        $this->form = new TModalForm('form_teste');
        $this->form->setFormTitle('Título');
        
        $codigo = new TEntry('codigo');
        $nome = new TEntry('nome');
        
        $codigo->placeholder = 'Código';
        $nome->placeholder = 'Nome';
        
        $this->form->addRowField('Código', $codigo, true);
        $this->form->addRowField('Nome', $nome, true);
        
        $this->form->addAction('Enviar', new TAction([$this, 'onSend']), '');
        
        $this->form->addFooterAction('Ação sencundária', new TAction([$this, 'onSend']), '');
        
        parent::add($this->form);
    }
    
    public function onSend($param)
    {
        var_dump($this->form->getData());
    }
}
