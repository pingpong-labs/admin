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
     * The rules.
     *
     * @var array
     */
    public $rules = [
        'name' => 'required',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6|max:20',
    ];

    /**
     * @param $value
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = \Hash::make($value);
    }

    // validation
    /**
     * @return array
     */
    public function getRules()
    {
        return $this->rules;
    }

    /**
     * @param $id
     * @return array
     */
    public function getUpdateRules($id)
    {
        $rules = array_except($this->getRules(), ['email', 'password']);

        if (\Input::has('email'))
        {
            $rules['email'] = $this->rules['email'] . ',' . $id;
        }
        else
        {
            $rules['email'] = $this->rules['email'];
        }

        if (\Input::has('password')) $rules['password'] = $this->rules['password'];

        return $rules;
    }

}
