<?php
class GanttView extends TPage
{
    private $gantt;
    
    public function __construct($param)
    {
        parent::__construct();
        
        $this->gantt = new TGantt(TGantt::MODE_MONTHS_WITH_DAY, 'xs');
        // MODE_DAYS, MODE_MONTHS, MODE_DAYS_WITH_HOUR, MODE_MONTHS_WITH_DAY
        // ['xs', 'sm', 'md', 'lg']
        
        $this->gantt->enableStripedMonths();
        $this->gantt->enableStripedRows();
        
        $this->gantt->setReloadAction( new TAction( [$this, 'onReload'] ) );
        
        $this->gantt->setStartDate( date('Y-01-01') );
        $this->gantt->setTitle('Eventos');
        $this->gantt->enableFullHours();
        
        $this->gantt->setEventClickAction( new TAction( [$this, 'onAction'] ));
        $this->gantt->setDayClickAction( new TAction( [$this, 'onAction'] ));
        $this->gantt->enableDragEvent( new TAction( [$this, 'onAction'] ), 60);
        $this->gantt->addHeaderAction( new TAction( [$this, 'onAction'] ), 'Ação', new TImage('fa:rocket'));
        
        $this->gantt->clearEvents();
        $this->gantt->addRow(1, 'Group 1');
        $this->gantt->addRow(2, 'Group 2');
        $this->gantt->addRow(3, 'Group 3');
        
        $this->gantt->addEvent(1, 1, 'Event A.1', date('Y-01-01 12:00:00'), date('Y-01-05 12:00:00'), '#C04747', 10);
        $this->gantt->addEvent(2, 1, 'Event A.2', date('Y-01-02 12:00:00'), date('Y-01-06 12:00:00'), '#668BC6', 20);
        $this->gantt->addEvent(3, 2, 'Event B.2', date('Y-01-03 12:00:00'), date('Y-01-07 12:00:00'), '#FF0000', 30);
        $this->gantt->addEvent(4, 2, 'Event B.2', date('Y-01-04 12:00:00'), date('Y-01-08 12:00:00'), '#5AB34B', 40);
        $this->gantt->addEvent(5, 3, 'Event C.2', date('Y-01-05 12:00:00'), date('Y-01-09 12:00:00'), '#668BC6', 50);
        $this->gantt->addEvent(6, 3, 'Event C.2', date('Y-01-06 12:00:00'), date('Y-01-10 12:00:00'), '#FF8C05', 60);
        
        $this->gantt->enableViewModeButton(true, true);
        $this->gantt->enableSizeModeButton(true, true);
        
        if (!empty($param['view_mode']))
        {
            $this->gantt->setViewMode( $param['view_mode'] );
            TSession::setValue('gantt_view_mode', $param['view_mode']);
        }
        
        if (!empty($param['size_mode']))
        {
            $this->gantt->setSizeMode( $param['size_mode'] );
            TSession::setValue('gantt_size_mode', $param['size_mode']);
        }
        
        if (!empty(TSession::getValue('gantt_view_mode')))
        {
            $this->gantt->setViewMode( TSession::getValue('gantt_view_mode') );
        }
        
        if (!empty(TSession::getValue('gantt_size_mode')))
        {
            $this->gantt->setSizeMode( TSession::getValue('gantt_size_mode') );
        }
        parent::add($this->gantt);
    }
    
    public function onReload($param)
    {
    
    }
    
    public static function onAction($param)
    {
        new TMessage('info', json_encode($param));
    }
}
