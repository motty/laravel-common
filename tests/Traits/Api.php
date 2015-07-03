<?php namespace Motty\Laravel\Common\Testing;

/**
 * Utility class for testing our APIs
 *
 * @package Motty\Laravel\Common\Testing\Traits
 */
trait Api
{
    /**
     * The last response returned by the application converted into Json
     *
     * @var \Illuminate\Http\Response
     */
    protected $jsonResponse;

    protected function getJson($uri, $method = 'GET', $parameters = [])
    {
        $this->jsonResponse = json_decode($this->call($method, $uri, $parameters)->getContent());

        return $this;
    }

    protected function assertObjectHasAttributes()
    {
        $args = func_get_args();
        $object = array_shift($args);

        foreach ($args as $attribute) {
            $this->assertObjectHasAttribute($attribute, $object);
        }
    }
}
