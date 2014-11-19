<?php namespace Pingpong\Admin\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Response;
use Pingpong\Validator\Exceptions\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ErrorServiceProvider extends ServiceProvider {

    /**
     * @var array
     */
    protected $handlers = [
        'NotFound',
        'FormValidation',
        'ModelNotFound',
    ];

    /**
     * Boot the provider.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerErrorHandlers();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Register the required files.
     *
     * @return void
     */
    protected function registerErrorHandlers()
    {
        foreach ($this->handlers as $handler)
        {
            $this->{'register' . $handler . 'Handler'}();
        }
    }

    public function registerNotFoundHandler()
    {
        $this->app->error(function (NotFoundHttpException $e)
        {
            if ($this->app['request']->ajax())
            {
                return Response::json(['code' => 404, 'message' => 'Not Found'], 404);
            }

            return Response::view('admin::404', [], 404);
        });
    }

    public function registerFormValidationHandler()
    {
        $this->app->error(function (ValidationException $e)
        {
            if ($this->app['request']->ajax())
            {
                $errors = $e->getErrors()->toArray();

                $default = ['status' => false];

                return Response::json($default + compact('errors'));
            }

            return $this->app['redirect']->back()->withInput()->withErrors($e->getErrors());
        });
    }

    public function registerModelNotFoundHandler()
    {
        $this->app->error(function (ModelNotFoundException $e)
        {
            return Response::view('admin::404', [], 404);
        });
    }

}