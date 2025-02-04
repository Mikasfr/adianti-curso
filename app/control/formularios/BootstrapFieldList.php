<?php

use Adianti\Control\TPage;
use Adianti\Widget\Form\TCombo;
use Adianti\Widget\Form\TEntry;
use Adianti\Widget\Form\TDate;
use Adianti\Widget\Form\TFieldList;
use Adianti\Wrapper\BootstrapFormBuilder;

class BootstrapFieldList extends TPage{
  public function __construct()
  {
    parent::__construct();
    $this->form = new BootstrapFormBuilder('meu_form');
    $this->form->setFormTitle('Lista de campos');

    $combo = new TCombo('combo[]');
    $texto = new TEntry('texto[]');
    $numero = new TEntry('valor[]');
    $data = new TDate('dt_registro[]');

    $combo->enableSearch();
    $combo->addItems(['a' => 'opcao A', 'b' => 'opcao B']);
    $combo->setSize('100%');
    $this->form->setFieldSizes('100%');

    $numero->setNumericMask(2, ',', '.', true);
    $numero->style = 'text-align:right';

    $fieldlist = new TFieldList;
    $fieldlist->width = '100%';
    $fieldlist->addField('<b>Combo</b>',  $combo,   ['width' => '25%']);
    $fieldlist->addField('<b>Texto</b>',  $texto,   ['width' => '25%']);
    $fieldlist->addField('<b>Numero</b>', $numero,  ['width' => '25%']);
    $fieldlist->addField('<b>Data</b>',   $data,    ['width' => '25%']);
    $fieldlist->addField('<b>Comb o</b>',  $combo,   ['width' => '25%']);

    $fieldlist->enableSorting();
    $this->form->addContent([$fieldlist]);
    $fieldlist->addHeader();
    $fieldlist->addDetail(new stdClass);
    $fieldlist->addDetail(new stdClass);
    $fieldlist->addDetail(new stdClass);
    $fieldlist->addDetail(new stdClass);
    $fieldlist->addDetail(new stdClass);
    $fieldlist->addCloneAction();
    parent::add($this->form);
  }
}

?>