<?php
class ComandosDDL extends TPage
{
    public function __construct()
    {
        parent::__construct();
        
        try
        {
            $conn = TTransaction::open('curso');
            
            /*
            TDatabase::createTable( $conn, 'fornecedor',
                ['id' => 'int',
                 'nome' => 'varchar(100)',
                 'endereco' => 'varchar(100)']);
            */
            
            // TDatabase::addColumn( $conn, 'fornecedor', 'obs', 'varchar(500)', '');
            
            // TDatabase::dropColumn($conn, 'fornecedor', 'obs');
            
            //TDatabase::execute($conn, 'CREATE INDEX fornecedor_nome_idx ON fornecedor(nome)');
            
            //TDatabase::execute($conn, 'UPDATE produto SET preco_venda = preco_venda * 1.3');
            
            
            // TDatabase::dropTable($conn, 'fornecedor', true);
            
            TTransaction::close();
        }
        catch (Exception $e)
        {
            new TMessage('error', $e->getMessage());
        }
    }
}