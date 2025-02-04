<?php
class FormImageUploader extends TPage
{
    private $form;
    
    public function __construct()
    {
        parent::__construct();
        
        $this->form = new BootstrapFormBuilder;
        $this->form->setFormTitle('Captura e corte de imagem');
        
        $imagecropper = new TImageCropper('imagecropper'); 
        $imagecapture = new TImageCapture('imagecapture');
        
        $imagecropper->setSize(300, 150);
        $imagecropper->setCropSize(300, 150);
        $imagecropper->setAllowedExtensions( ['gif', 'png', 'jpg', 'jpeg'] );
    
        $imagecapture->setSize(300, 200);
        $imagecapture->setCropSize(300, 200);
        
        $this->form->addFields( [new TLabel('Image cropper')], [$imagecropper] );
        $this->form->addFields( [new TLabel('Image capture')], [$imagecapture] );
        
        $this->form->addAction( 'Enviar', new TAction( [$this, 'onShow'] ), 'far:check-circle');
        
        parent::add($this->form);
    }
    
    public static function onShow($param)
    {
        new TMessage('info', 'Image cropper: tmp/' . $param['imagecropper'] . '<br>' . 
                             'Image capture: tmp/' . $param['imagecapture'] );
    }
}
