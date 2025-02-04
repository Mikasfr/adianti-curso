
<?php 

use Adianti\Database\TRecord;

class KanbanTarefaModel extends TRecord 
{
    const TABLENAME = 'gti003';
    const PRIMARYKEY= 'gti003_serial';
    const IDPOLICY =  'serial'; // {max, serial}
    private $gti002;
    
    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);

        parent::addAttribute('gti002_serial');
        parent::addAttribute('gti003_tarefa');
        parent::addAttribute('gti003_dt_criacao');
        parent::addAttribute('gti003_dt_finalizacao');
        parent::addAttribute('gti003_status');
   }

//    public function get_gti002(){
//     if(empty($this->gti002)){
//         $this->gti002  = new KanbanColuna($this->gti002_serial);
//     }
//     return $this->gti002;
//    }

}


?>

