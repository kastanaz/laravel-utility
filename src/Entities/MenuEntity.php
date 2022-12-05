<?php

namespace Kastanaz\LaravelUtility\Entities;

use ArrayAccess;
use Kastana\KsLaravelUtility\Concerns\EntityConcern;

class MenuEntity implements ArrayAccess
{
    use EntityConcern;

    /**
     * Define the properties of the object in an array
     *
     * @var array
     */
    private array $container = [
        'name' => null,
        'alias' => null,
        'path' => null,
        'icon' => null,
        'permission' => null,
        'attribute' => null,
        'role_level' => null,
        'url' => null,
        // 'authorized' => true,
        'submenu' => null
    ];

    /**
     * Constructor
     *
     * @param array $menu
     */
    public function __construct(array $menu)
    {
        $this->container = array(
            'name' => $menu['name'],
            'alias' => $menu['alias'],
            'tranlate' => __($menu['alias']),
            'path' => $menu['path'],
            'icon' => $menu['icon'] ?? null,
            'permission' => $menu['permission'] ?? null,
            'attribute' => $menu['attribute'] ?? null,
            'role_level' => $menu['role_level'] ?? null,
            'url' => url($menu['path']),
            // 'authorized' => $this->isAuthorized($menu['permission'] ?? null),
        );
    }

    public function isAuthorized($permission = null): bool
    {
        if (is_null($permission)) {
            $permission = $this->container['permission'];
        }

        if (app()->runningInConsole()) {
            return false;
        }

        if (isset($permission[0])) {
            return user()->hasPermissionTo($permission[0], $permission[1]);
        }

        return true;
    }

    public function getAuthorized()
    {
        return $this->container['authorized'];
    }

    /**
     * Set the value of the 'submenu' property
     *
     * @param MenuEntity $menu
     * @return void
     */
    public function setSubmenu(MenuEntity $menu): void
    {
        $this->container['submenu'] = $menu;
    }

    public function isCurrent(): bool
    {
        return request()->is($this->container['path']) || request()->is($this->container['path'] . '/*');
    }

    public function getUrl(): string
    {
        return $this->container['url'];
    }

    public function getIcon(): string
    {
        return $this->container['icon'];
    }

    public function getAlias(): string
    {
        return $this->container['alias'];
    }

    public function getAttribute(): ?string
    {
        return $this->container['attribute'];
    }

    public function getSubmenu(): ?array
    {
        return $this->container['submenu'];
    }

    public function hasSubmenu(): bool
    {
        return !empty($this->container['submenu']);
    }
}
