<?php
class AdiantiMenuBuilder
{
    public static function parse($file, $theme)
    {
        if (!in_array('SimpleXML', get_loaded_extensions()))
        {
            throw new Exception(_t('Extension not found: ^1', 'SimpleXML'));
        }
        
        switch ($theme)
        {
            case 'theme3':
                ob_start();
                $callback = null;// array('SystemPermission', 'checkPermission');
                $xml = new SimpleXMLElement(file_get_contents($file));
                $menu = new TMenu($xml, $callback, 1, 'treeview-menu', 'treeview', '');
                $menu->class = 'sidebar-menu';
                $menu->id    = 'side-menu';
                $menu->show();
                $menu_string = ob_get_clean();
                return $menu_string;
                break;
            case 'adminbs5':
                ob_start();
                $callback = null;// array('SystemPermission', 'checkPermission');
                $xml = new SimpleXMLElement(file_get_contents($file));
                $menu = new TMenu($xml, $callback, 1, 'sidebar-dropdown list-unstyled collapse', 'sidebar-item', 'sidebar-link collapsed');
                $menu->class = 'sidebar-nav';
                $menu->id    = 'side-menu';
                $menu->show();
                $menu_string = ob_get_clean();
                return $menu_string;
                break;
        }
    }
}
