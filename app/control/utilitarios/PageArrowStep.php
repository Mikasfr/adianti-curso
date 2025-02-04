<?php
class PageArrowStep extends TPage
{
    public function __construct()
    {
        parent::__construct();
        
        $step = new TPageStep;
        $step->addItem('Passo 1', new TAction(['CidadeList', 'onReload']));
        $step->addItem('Passo 2');
        $step->addItem('Passo 3');
        $step->select('Passo 2');
        
        $form = new BootstrapFormBuilder('teste');
        $form->setFormTitle('Teste Arrow');
        
        $arrow = new TArrowStep('step');
        $arrow->addItem('Passo 1', 1, '#fa7d00');
        $arrow->addItem('Passo 2', 2, '#0d9ddb');
        $arrow->addItem('Passo 3', 3, '#0fd927');
        
        $arrow->setCurrentKey(2);
        $arrow->setHeight(40);
        
        $form->addFields( [new TLabel('Step') ]);
        $form->addFields( [$arrow] );
        
        $form->addAction('Enviar', new TAction([$this, 'onSend']));
        
        $vbox = TVBox::pack($step, $form);
        $vbox->style = 'width:100%';
        parent::add($vbox);
    }
    
    
    public static function onSend($param)
    {
        new TMessage('info', 'Etapa : ' . $param['step']);
    }
}