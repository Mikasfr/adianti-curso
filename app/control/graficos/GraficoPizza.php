<?php

use Adianti\Control\TPage;
use Adianti\Widget\Template\THtmlRenderer;

class GraficoPizza extends TPage{
    public function __construct()
    {
        parent::__construct();

        $html = new THtmlRenderer('app/resources/google_pie_chart.html');

        $valor = 55;

        $data = [];
        $data[] = ['Pessoa', 'Valors']; 
        $data[] = ['Pedro', 40]; 
        $data[] = ['Maria', 30]; 
        $data[] = ['João', $valor];  

        $html->enableSection('main', [  'data' => json_encode($data),
                                        'width' => '100%',
                                        'height' => '300px',
                                        'title' => 'Vendas',
                                        'uniqid' => uniqid()]);

        parent::add($html);
    }
}

?>