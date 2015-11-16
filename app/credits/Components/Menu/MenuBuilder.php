<?php namespace credits\Components\Menu;

use credits\Components\Menu\Menu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class MenuBuilder
{

    private $nameMenu;
    private $data;
    private $permissions;

    public function create($nameMenu, $data = array())
    {
        $this->nameMenu = $nameMenu;
        $this->data = $data;
        $this->permissions = $this->checkAuth();

        return $this->styleMenu($this->createMenu());
    }

    private function checkAuth(){
        return (\Auth::check())?\ACL::getPermissions():array();
    }
    private function styleMenu($menu)
    {
        $data = ' ';
        foreach ($this->data  as $key => $value) {
            $data .= $key . "='" . $value . "' ";
        }


       return "<nav $data>" . $menu . '</nav>';
    }

    private function createMenu()
    {
        $menu = Menu::where('nameMenu', '=', $this->nameMenu)
            ->orderby('orderMenu')
            ->get();
        $menuArray = array();
        foreach ($menu as $links) {
            $menuArray[] =
                array(
                    'id' => $links->id,
                    'nameLink' => $links->nameLink,
                    'route' => $links->route,
                    'permission' => $links->permission,
                    'parent' => $links->parent,
                );
        }
        $menuEnd = array(
            'items' => array(),
            'parents' => array()
        );
        foreach ($menuArray as $items) {
            $menuEnd['items'][$items['id']] = $items;
            $menuEnd['parents'][$items['parent']][] = $items['id'];
        }

        return $this->prepareMenu(0, $menuEnd);
    }

    private function prepareMenu($parent, $menu)
    {
        $html = "";
        if (isset($menu['parents'][$parent])) {
            $html .= "<ul>";

            foreach ($menu['parents'][$parent] as $itemId) {
                if (!$this->checkPermission($menu['items'][$itemId]['permission'])) {
                    continue;
                };
                $html .= '<li>';
                $html .= $this->template($menu['items'][$itemId]);
                $html .= $this->prepareMenu($itemId, $menu);
                $html .= '</li>';
            }

            if(Auth::check())
            {

            }else{
                $html .= '<li><a href="credito">SOLICITUD DE CREDITO</a></li>';
            }
            $html .= "</ul>  ";
        }
        return $html;
    }

    private function checkPermission($namePermission)
    {
        if (empty($namePermission)) {
            return true;
        }
        return (array_key_exists($namePermission, $this->permissions))
            ? ($this->permissions[$namePermission]['available']) ? true : false
            : false;

    }

    private function template($li)
    {
        $a = (!empty($li['route'])) ? $li['route'] : '#';
        return "<a href= '".route($a)."' >" . $li['nameLink'] . '</a>';


    }
}