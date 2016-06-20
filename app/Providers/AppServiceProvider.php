<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
     /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * iOC aliases provides by this service provider
     * @var array
     */
    protected $provides = [];

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $shared = [
            'App\Repository\TaskRepositoryInterface' => 'App\Repository\Eloquent\TaskRepository'
        ];

        foreach ($shared as $abstract => $implementation) $this->app->bind($abstract, $implementation, true);
        $this->addAlias(array_keys($shared));

        $validators = [
            'todo.login.validator' => 'App\Validators\LogintValidator',
            'todo.task.validator' => 'App\Validators\TaskValidator'
        ];

        foreach ($validators as $abstract => $implementation) $this->app->bind($abstract, $implementation, true);
        $this->addAlias(array_keys($validators));
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    protected function addAlias($keys) 
    {
        if (!is_array($keys)) {
            $this->provides[] = $keys; return;
        }

        $this->provides = array_merge($this->provides, $keys);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return $this->provides;
    }
}
