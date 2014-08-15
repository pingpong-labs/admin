<?php namespace Pingpong\Admin\Traits;

trait LaravelTrait
{
	/**
	 * Laravel Component Aliases.
	 *
     * @var array
     */
    protected $aliases = array(
        'app'            => 'app',
        'artisan'        => 'artisan',
        'auth'           => 'auth',
        'auth_reminder_repository' => 'auth.reminder.repository',
        'blade'          => 'blade.compiler',
        'cache'          => 'cache',
        'cache_store'    => 'cache.store',
        'config'         => 'config',
        'cookie'         => 'cookie',
        'crypt'          => 'encrypter',
        'db'             => 'db',
        'events'         => 'events',
        'files'          => 'files',
        'form'           => 'form',
        'hash'           => 'hash',
        'html'           => 'html',
        'lang'           => 'translator',
        'translator'     => 'translator',
        'log'            => 'log',
        'mailer'         => 'mailer',
        'mail'           => 'mailer',
        'paginator'      => 'paginator',
        'auth_reminder'  => 'auth.reminder',
        'queue'          => 'queue',
        'redirect'       => 'redirect',
        'redis'          => 'redis',
        'request'        => 'request',
        'input'          => 'request',
        'router'         => 'router',
        'session'        => 'session',
        'session_store'  => 'session.store',
        'remote'         => 'remote',
        'url'            => 'url',
        'validator'      => 'validator',
        'view'           => 'view',
    );

    /**
     * Handle get property.
     *
     * @param $key
     * @return mixed
     */
    public function __get($key)
    {
        $app = app();
        
        if($key == 'laravel' || $key == 'app')
        {
            return $app;
        }

        if(array_key_exists($key, $this->aliases))
        {
            return $app[$this->aliases[$key]];
        }
        
        return $this->$key;
    }

}