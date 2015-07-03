<?php namespace Motty\Laravel\Common\Testing;

use Illuminate\Support\Facades\App;
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
    public static function relocateFactories()
    {
        // change factories path
        // https://laracasts.com/discuss/channels/laravel/l51-how-to-change-factories-path-when-using-model-factories
        App::singleton(Factory::class, function () {
            return Factory::construct(env('FACTORIES_PATH', 'database/factories'));
        });
    }
}
