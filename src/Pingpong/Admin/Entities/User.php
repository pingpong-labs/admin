<?php namespace Pingpong\Admin\Entities;

use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\UserTrait;
use Illuminate\Database\Eloquent\Model;
use Pingpong\Trusty\Traits\TrustyTrait;

class User extends Model implements UserInterface, RemindableInterface {

    use UserTrait, RemindableTrait, TrustyTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('password', 'remember_token');

    /**
     * The fillable property.
     *
     * @var array
     */
    protected $fillable = array('name', 'username', 'email', 'password', 'status');

    /**
     * @param $value
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = \Hash::make($value);
    }

}
