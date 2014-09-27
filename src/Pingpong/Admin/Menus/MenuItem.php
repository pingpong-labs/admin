<?php namespace Pingpong\Admin\Menus;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model {

    /**
     * The table name.
     *
     * @var string
     */
    protected $table = 'menu_item';

    /**
     * The fillable attributes.
     *
     * @var array
     */
    protected $fillable = [
        'menu_id',
        'parent_id',
        'title',
        'url',
        'filter',
        'order',
        'properties'
    ];

    /**
     * Relation "belongs-to" menu.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function menu()
    {
        return $this->belongsTo(__NAMESPACE__ . '\\Menu');
    }

    /**
     * Relation "belongs-to" parent item.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(__CLASS__, 'parent_id');
    }

    /**
     * Relation "has-many" child items.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function childs()
    {
        return $this->hasMany(__CLASS__, 'parent_id');
    }

    /**
     * Get child items.
     *
     * @return mixed
     */
    public function getChilds()
    {
        return $this->childs()->with('childs')->orderBy('order', 'asc')->get();
    }

    /**
     * Determine whether the current item has a child items.
     *
     * @return bool
     */
    public function hasChilds()
    {
        return (bool)$this->childs()->count();
    }

    /**
     * Determine whether the current item is a divider.
     *
     * @return bool
     */
    public function isDivider()
    {
        return $this->title == trim('-');
    }

}