<?php namespace Pingpong\Admin\Menus;

use Illuminate\Database\Eloquent\Model;
use Pingpong\Admin\Presenters\Menu as MenuPresenter;

class Menu extends Model {

    /**
     * The fillable attributes.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * The menu presenter class.
     *
     * @var string
     */
    protected static $presenter;

    /**
     * Set new presenter class.
     *
     * @param $presenter
     */
    public static function setPresenter($presenter)
    {
        static::$presenter = $presenter;
    }

    /**
     * Get presenter class instance.
     *
     * @return mixed
     */
    public static function getPresenter()
    {
        return new static::$presenter;
    }

    /**
     * Relation "has-many".
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items()
    {
        return $this->hasMany(__NAMESPACE__ . '\\MenuItem');
    }

    /**
     * Search menu by given name.
     *
     * @param \Illuminate\Database\Query\Builder $query
     * @param $name
     * @return mixed
     */
    public function scopeSearch($query, $name)
    {
        return $query->whereName($name);
    }

    /**
     * Get menu items.
     *
     * @return mixed
     */
    public function getItems()
    {
        return $this->items()->with('childs')->whereParentId(0)->orderBy('order', 'asc')->get();
    }

    /**
     * Render the menu.
     *
     * @param $name
     * @param null $presenter
     * @return string|null
     */
    public static function render($name, $presenter = null)
    {
        $menu = static::search($name)->first();

        if ( ! is_null($presenter))
        {
            static::setNewPresenter($presenter);
        }

        if ( ! is_null($menu))
        {
            return static::createMenu($menu);
        }

        return null;
    }

    /**
     * Set new presenter class.
     *
     * @param $presenter
     */
    protected static function setNewPresenter($presenter)
    {
        if (class_exists($class = __NAMESPACE__ . '\\Presenters\\Bootstrap\\' . $presenter . 'Presenter'))
        {
            $presenter = $class;
        }

        if (class_exists($class = __NAMESPACE__ . '\\Presenters\\' . $presenter . 'Presenter'))
        {
            $presenter = $class;
        }

        static::setPresenter($presenter);
    }

    /**
     * Create a menu.
     *
     * @param $menu
     * @return string
     */
    protected static function createMenu($menu)
    {
        $items = $menu->getItems();

        $presenter = static::getPresenter();

        $result = $presenter->getOpenTag();

        foreach ($items as $item)
        {
            if ($item->isDivider())
            {
                $result .= $presenter->getDividerTag();
            }
            elseif ($item->hasChilds())
            {
                $result .= $presenter->getChilds($item);
            }
            else
            {
                $result .= $presenter->getListTag($item);
            }
        }

        $result .= $presenter->getCloseTag();

        return $result;
    }
}