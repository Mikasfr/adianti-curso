<?php
class ComandosDML extends TPage
{
    public function __construct()
    {
        parent::__construct();
        
        try
        {
            $conn = TTransaction::open('curso');
            /*
            TDatabase::insertData($conn, 'fornecedor',
                [ 'id' => 1,
                  'nome' => 'fornece tudo 1']);
            */
            
            /*
            $criteria = TCriteria::create( ['unidade' => 'QT']);
            $values  = [ 'unidade' => 'PC' ];
            TDatabase::updateData($conn, 'produto', $values, $criteria);
            */
            
            // TDatabase::clearData($conn, 'fornecedor' /*, $criteria */);
            
            $funcao = function ($value, $row) {
                    return $value  * 2;
            };
            
            $mapping = [];
            $mapping[] = [ 'id', 'codigo'];
            $mapping[] = [ 'dt_venda', 'data_venda'];
            $mapping[] = [ 'total', 'grande_total', $funcao];
            
            $query = "SELECT * FROM venda WHERE dt_venda = ?";
            $dados = TDatabase::getData($conn, $query, $mapping, ['2015-03-14']);
            
            echo '<pre>';
            var_dump($dados);
            
            TTransaction::close();
        }
        catch (Exception $e)
        {
            new TMessage('error', $e->getMessage());
        }
    }
}