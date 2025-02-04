<?php

use Adianti\Control\TAction;
use Adianti\Database\TTransaction;
use Adianti\Validator\TRequiredValidator;
use Adianti\Widget\Base\TScript;
use Adianti\Widget\Container\TVBox;
use Adianti\Widget\Form\TEntry;
use Adianti\Widget\Form\TLabel;
use Adianti\Widget\Wrapper\TDBMultiSearch;
use Adianti\Wrapper\BootstrapFormBuilder;

class QuadroForm extends TPage{
  protected $form;

  function __construct()
  {
    parent::__construct();
    parent::setTargetContainer('adianti_right_panel');

    // criando o formulario

    $this->form = new BootstrapFormBuilder('form_quadro');
    $this->form->setFormTitle('Quadro');
    $this->form->setClientValidation(true);

    // criando o form fields
    $id = new TEntry('id');
    $nome = new TEntry('nome');
    $usuarios = new TDBMultiSearch('usuarios', 'local', 'SystemUsers', 'id', 'name');
    $usuarios->setMinLength(0);

    //add os campos

    $this->form->addFields([new TLabel('Id')], [$id]);
    $this->form->addFields([new TLabel('Nome')], [$nome]);
    $this->form->addFields([new TLabel('Usuários')], [$usuarios]);

    $nome->addValidation('Nome', new TRequiredValidator);

    // setando o tamanho dos campos
    $id->setSize('100%');
    $nome->setSize('100%');

    $id->setEditable(FALSE);

    //criando as ações do formulario 
    $btn = $this->form->addAction(_t('Save'), new TAction([$this, 'onSave']), 'fa:save');
    $btn->class = 'btn btn-sm btn-primary';
    $this->form->addActionLink(_t('New'), new TAction([$this, 'onEdit']), 'fa:eraser yellow');
    $this->form->addHeaderActionLink(_t('Close'), new TAction([$this, 'onClose']), 'fa:times red');

    //vertical box container
    $container = new TVBox;
    $container->style = 'width: 100%';

    $container->add($this->form);

    parent::add($container);
  }

  public static function onClose($param){
    TScript::create("Template.closeRightPanel()");
  }

  public function onSave($param){
    try{
      TTransaction::open('local');
      $this->form->validate();
      
      $object = new Quadro;
      $object->fromArray((array) $data);
      $object->store();
    }
  }
}


?>