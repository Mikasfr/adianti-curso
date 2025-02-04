<?php
class TransacaoFake extends TPage
{
    public function __construct()
    {
        parent::__construct();
        
        try
        {
            TTransaction::openFake('curso');
            
            Produto::create( [
                'descricao' => 'CABO HDMI 2',
                'estoque' => 5,
                'preco_venda' => 20,
                'unidade' => 'PC'
            ]);
            
            throw new Exception('teste');
            
            Produto::create( [
                'descricao' => 'CABO HDMI 2',
                'estoque' => 5,
                'preco_venda' => 20,
                'unidade' => 'PC'
            ]);
            
            TTransaction::close();
        }
        catch (Exception $e)
        {
            new TMessage('error', $e->getMessage());
        }
    }
}