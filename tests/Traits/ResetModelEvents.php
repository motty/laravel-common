<?php namespace Motty\Laravel\Common\Testing;

/**
 * Reset Models' events after each test to trigger eloquent
 * models when testing
 *
 * @see https://github.com/laravel/framework/issues/1181
 */
trait ResetModelEvents
{
    /**
     * @before
     */
    public function resetEvents()
    {
        foreach ($this->models as $model) {
            $model = env('MODELS_NAMESPACE') . '\\' .  $model;

            // Flush any existing listeners
            call_user_func([$model, 'flushEventListeners']);

            // re-register existing listeners
            call_user_func([$model, 'boot']);
        }
    }
}
