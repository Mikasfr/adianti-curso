<?php

use Adianti\Database\TRecord;

class QuadroModel extends TRecord
{
    const TABLENAME = 'gti001';
    const PRIMARYKEY= 'gti001_serial';
    const IDPOLICY =  'serial'; // {max, serial}
    
    
    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        
        parent::addAttribute('gti001_quadro');
        parent::addAttribute('gti001_dt_criacao');
    }


}


?>