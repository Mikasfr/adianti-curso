<?php
/**
 * FormComponentsView
 *
 * @version    1.0
 * @package    samples
 * @subpackage tutor
 * @author     Pablo Dall'Oglio
 * @copyright  Copyright (c) 2006 Adianti Solutions Ltd. (http://www.adianti.com.br)
 * @license    https://adiantiframework.com.br/license-tutor
 */
class FormComponentsView extends TPage
{
    private $form;
    
    /**
     * Class constructor
     * Creates the page
     */
    public function __construct()
    {
        parent::__construct();
        
        $this->form = new BootstrapFormBuilder;
        $this->form->setFormTitle('Form components');
        
        $entry     = new TEntry('entry');
        $numeric   = new TNumeric('numeric', 2, ',', '.', true);
        $date      = new TDate('date');
        $datetime  = new TDateTime('datetime');
        $time      = new TTime('time');
        $color     = new TColor('color');
        $icon      = new TIcon('icon');
        $password  = new TPassword('password');
        $spinner   = new TSpinner('spinner');
        $spinner2  = new TSpinner('spinner2');
        $slider    = new TSlider('slider');
        
        $entryc    = new TEntry('completion');
        $check     = new TCheckGroup('check');
        $radio     = new TRadioGroup('radio');
        $combo     = new TCombo('combo');
        $select    = new TSelect('select');
        $unique    = new TUniqueSearch('unique');
        $multi     = new TMultiSearch('multi');
        $multicombo= new TMultiCombo('multicombo');
        
        $db_entry  = new TDBEntry('completion2', 'samples', 'Category', 'name');
        $db_check  = new TDBCheckGroup('db_check', 'samples', 'Category', 'id', '{name} ({id})', 'id');
        $db_radio  = new TDBRadioGroup('db_radio', 'samples', 'Category', 'id', '{name} ({id})', 'id');
        $db_combo  = new TDBCombo('db_combo', 'samples', 'Category', 'id', '{name} ({id})', 'id');
        $db_select = new TDBSelect('db_select', 'samples', 'Category', 'id', '{name} ({id})',  'id');
        $db_unique = new TDBUniqueSearch('db_unique', 'samples', 'Category', 'id', 'name');
        $db_multi  = new TDBMultiSearch('db_multi', 'samples', 'Category', 'id', 'name');
        $db_multic = new TDBMultiCombo('db_multic', 'samples', 'Category', 'id', 'name');
        
        $text      = new TText('text');
        $html      = new THtmlEditor('html');
        
        $file      = new TFile('file');
        $multifile = new TMultiFile('multifile');
        
        $file->setAllowedExtensions( ['png', 'jpg'] );
        $multifile->setAllowedExtensions( ['png', 'jpg'] );
        
        $date->setMask('dd/mm/yyyy');
        $datetime->setMask('dd/mm/yyyy hh:ii');
        $spinner->setRange(0, 100, 0.1);
        $spinner2->setRange(0, 100, 0.1);
        $slider->setRange(0, 100, 0.1);
        $date->setSize('100%');
        $datetime->setSize('100%');
        $time->setSize('100%');
        $color->setSize('100%');
        $icon->setSize('100%');
        $spinner->setSize('100%');
        $spinner2->setSize('100%');
        $slider->setSize('100%');
        
        $spinner->setValue('40.4');
        $spinner2->setValue('40.4');
        $slider->setValue('40.4');
        
        $spinner2->enableStepper();
        
        // multientry
        // icon
        
        $entryc->placeholder = 'type for completion...';
        
        $db_unique->setMask('{name} ({id})');
        $db_multi->setMask('{name} ({id})');
        
        $options = [1=>'Option 1', 2 => 'Option 2', 3 => 'Option 3'];
        $entryc->setCompletion( array_values($options) );
        
        $unique->setMinLength(1);
        $multi->setMinLength(1);
        
        $db_unique->setMinLength(1);
        $db_multi->setMinLength(1);
        
        $check->addItems($options);
        $radio->addItems($options);
        $combo->addItems($options);
        $select->addItems($options);
        $unique->addItems($options);
        $multi->addItems($options);
        $multicombo->addItems($options);
        
        $check->setLayout('horizontal');
        $db_check->setLayout('horizontal');
        $radio->setLayout('horizontal');
        $db_radio->setLayout('horizontal');
        
        $text->setSize('100%', 170);
        $html->setSize('100%', 170);
        
        $this->form->appendPage('Single components');
        $this->form->addContent( [new TFormSeparator('Input components')] );
        $this->form->addFields( [ new TLabel('TEntry') ],   [ $entry ],   [ new TLabel('TNumeric') ],  [ $numeric ] );
        $this->form->addFields( [ new TLabel('TDate') ],    [ $date ],    [ new TLabel('TDateTime') ], [ $datetime ] );
        $this->form->addFields( [ new TLabel('TIcon') ],    [ $icon ],    [ new TLabel('TTime') ], [ $time ] );
        $this->form->addFields( [ new TLabel('TColor') ],   [ $color ],   [ new TLabel('TPassword') ], [ $password ] );
        $this->form->addFields( [ new TLabel('TSpinner') ], [ $spinner ], [ new TLabel('TSlider') ],   [ $slider ] );
        $this->form->addFields( [ new TLabel('TSpinner stepper') ], [ $spinner2 ], [], []  );
        
        $this->form->addContent( [new TFormSeparator('Selection components')] );
        $this->form->addFields( [ new TLabel('TEntry') ],  [ $entryc ],  [ new TLabel('TDBEntry') ],  [ $db_entry ] );
        $this->form->addFields( [ new TLabel('TCheckGroup') ],  [ $check ],   [ new TLabel('TDBCheckGroup') ],  [ $db_check ] );
        $this->form->addFields( [ new TLabel('TRadioGroup') ],  [ $radio ],   [ new TLabel('TDBRadioGroup') ],  [ $db_radio ] );
        $this->form->addFields( [ new TLabel('TCombo') ],  [ $combo ],   [ new TLabel('TDBCombo') ],  [ $db_combo ] );
        $this->form->addFields( [ new TLabel('TSelect') ], [ $select ],  [ new TLabel('TDBSelect') ], [ $db_select ] );
        $this->form->addFields( [ new TLabel('TMultiCombo') ],  [ $multicombo ],   [ new TLabel('TDBMultiCombo') ],  [ $db_multic ] );
        $this->form->addFields( [ new TLabel('TUniqueSearch') ], [ $unique ],  [ new TLabel('TDBUniqueSearch') ], [ $db_unique ] );
        $this->form->addFields( [ new TLabel('TMultiSearch') ],  [ $multi ],   [ new TLabel('TDBMultiSearch') ],  [ $db_multi ] );
        
        $this->form->appendPage('Multi line components');
        $this->form->addContent( [new TFormSeparator('Text components')] );
        $this->form->addFields( [ new TLabel('TText') ],   [ $text ] );
        $this->form->addFields( [ new TLabel('THtmlEditor') ],  [ $html ] );
        
        $this->form->appendPage('File upload components');
        $this->form->addContent( [new TFormSeparator('File components')] );
        $this->form->addFields( [ new TLabel('TFile') ],      [ $file ] );
        $this->form->addFields( [ new TLabel('TMultiFile') ], [ $multifile ] );
        
        $this->form->addAction('Send', new TAction(array($this, 'onSend')), 'far:check-circle green');
        
        // wrap the page content using vertical box
        $vbox = new TVBox;
        $vbox->style = 'width: 100%';
        $vbox->add(new TXMLBreadCrumb('menu.xml', __CLASS__));
        $vbox->add($this->form);

        parent::add($vbox);
    }
    
    /**
     * Post data
     */
    public function onSend($param)
    {
        $data = $this->form->getData();
        $this->form->setData($data);
        
        $win = TWindow::create('Result', 0.8, 0.8);
        $win->add( '<pre>' . print_r($data, true) . '</pre>' );
        $win->show();
    }
}
