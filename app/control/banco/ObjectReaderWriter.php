<?php
class ObjectReaderWriter extends TPage
{
    public function __construct()
    {
        parent::__construct();
        
        try
        {
            TTransaction::open('curso');
            
            /*
            TTransaction::setLoggerFunction( function($mensagem) {
                print $mensagem . '<br>';
            });
            */
            
            TTransaction::dump();
            /*
            $cliente = new Cliente;
            $cliente->nome = 'Cliente teste cripto 4';
            $cliente->endereco = 'Rua tal nova 4';
            $cliente->categoria_id = 1;
            $cliente->cidade_id = 1;
            $cliente->store();
            */
            
            $cliente = Cliente::find(45);
            print $cliente->id;
            print ' - ';
            print $cliente->nome;
            print ' - ';
            print $cliente->endereco;
            
            TTransaction::close();
        }
        catch (Exception $e)
        {
            new TMessage('error', $e->getMessage());
        }
    }
}