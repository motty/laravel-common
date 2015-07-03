<?php namespace Motty\Laravel\Common\Testing\Traits;

use Illuminate\Database\Eloquent\Factory;

/**
 * Relocate Factories according to our environment parameter FACTORIES_PATH
 *
 * @package Motty\Laravel\Common\Testing\Traits
 */
trait RelocateFactories
{
    /**
     * @before
     */
    public function relocateFactories()
    {
        // change factories path
        // https://laracasts.com/discuss/channels/laravel/l51-how-to-change-factories-path-when-using-model-factories
        $this->app->singleton(Factory::class, function () {
            return Factory::construct(env('FACTORIES_PATH', 'database/factories'));
        });
    }
}
