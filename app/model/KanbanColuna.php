<?php

use Adianti\Database\TRecord;

class KanbanColuna extends TRecord
{
    const TABLENAME = 'gti002';
    const PRIMARYKEY= 'gti002_serial';
    const IDPOLICY =  'serial'; // {max, serial}
    
    
    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        
        parent::addAttribute('gti002_coluna');
    }


}


?>