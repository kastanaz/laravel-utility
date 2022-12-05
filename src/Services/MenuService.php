<?php

namespace Kastanaz\LaravelUtility\Services;

use Kastanaz\LaravelUtility\Entities\MenuEntity;

class MenuService
{
    protected $menus;

    public function __construct()
    {
        $this->menus = $this->getData();
    }

    public function getData()
    {
        return collect(config('menu.user'))
            ->map(function($item) {
                return $this->getMenu($item);
            });
    }

    private function getMenu($menu)
    {
        $entity = new MenuEntity($this->cleanMenu($menu));

        if (isset($menu['submenu'])) {

            foreach ($menu['submenu'] as $submenu) {
                $entity->setSubmenu($this->getMenu($submenu));
            }

        }

        return $entity;
    }

    private function cleanMenu(array $menu): array
    {
        unset($menu['submenu']);
        return $menu;
    }

    public function get()
    {
        return $this->menus;
    }

    public function getAuthorized()
    {
        $menu = $this->menus->where('authorized', true);
        return $menu->filter(function($item) {
            return true;
        });
    }
}
