<?php
class BarcodeQRCode extends TPage
{
    public function __construct()
    {
        parent::__construct();
        
        $barcode = new TBarcodeDisplay('1231723897');
        $barcode->setType('code128');
        $barcode->setHeight(100);
        
        $qrcode = new TQRCodeDisplay('Olá mundo 123');
        $qrcode->setHeight(350);
        
        $panel = new TPanelGroup('Barcode e qrcode');
        $panel->add(new TLabel('Barcode'));
        $panel->add('<br>');
        $panel->add($barcode);
        
        $panel->add('<br>');
        $panel->add(new TLabel('QRCode'));
        $panel->add('<br>');
        $panel->add($qrcode);
        
        parent::add($panel);
    }
}
