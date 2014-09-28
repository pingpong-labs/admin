<?php namespace Pingpong\Admin\Http\Controllers\Auth;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Pingpong\Admin\Entities\User;
use Pingpong\Admin\Validation\Auth\Register;

class RegisterController extends Controller {

    /**
     * @var Register
     */
    protected $validator;

    /**
     * @param Register $validator
     */
    public function __construct(Register $validator)
    {
        $this->validator = $validator;
    }

    /**
     * @return mixed
     */
    public function getIndex()
    {
        return aview('auth.register');
    }

    /**
     * @return mixed
     * @throws \Pingpong\Validator\Exceptions\ValidationException
     */
    public function postIndex()
    {
        $this->validator->validate();

        $user = User::create($this->validator->getInput());

        return Redirect::to('admin/login');
    }

} 