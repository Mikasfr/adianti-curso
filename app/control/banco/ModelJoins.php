<?php
class ModelJoins extends TPage
{
    public function __construct()
    {
        parent::__construct();
        
        try
        {
            TTransaction::open('curso');
            TTransaction::dump();
            
            $data = Cliente::join('venda', ['cliente.id' => 'venda.cliente_id'])
                           ->groupBy('cliente_id, nome')
                           ->countBy('venda.id', 'count');
            
            echo '<pre>';
            var_dump($data);
            
            TTransaction::close();
        }
        catch (Exception $e)
        {
            new TMessage('error', $e->getMessage());
        }
    }
}