<?php
class LikertScale extends TPage
{
    private $form;
    
    public function __construct()
    {
        parent::__construct();
        
        $this->form = new BootstrapFormBuilder('form_likert');
        $this->form->setFormTitle('Escala likert');
        
        $items = [ '1' => 'Discordo totalmente',
                   '2' => 'Discordo',
                   '3' => 'Neutro',
                   '4' => 'Concordo',
                   '5' => 'Concordo totalmente' ];
                   
        $questao1 = new TLikertScale('questao1');
        $questao2 = new TLikertScale('questao2');
        $questao1->addItems($items);
        $questao2->addItems($items);
        
        $this->form->addFields( [new TLabel('Pergunta 1')]);
        $this->form->addFields( [$questao1] );
        $this->form->addContent( [''] );
        
        $this->form->addFields( [new TLabel('Pergunta 2')]);
        $this->form->addFields( [$questao2] );
        $this->form->addContent( [''] );
        
        $this->form->addAction('Enviar', new TAction([$this, 'onSend']));
        parent::add($this->form);
    }
    
    public function onSend($param)
    {
        var_dump($this->form->getData());
    }
    
}
