<?php namespace Motty\Laravel\Common\Testing\Traits;

/**
 * Utility class for testing our APIs
 *
 * @package Motty\Laravel\Common\Testing\Traits
 */
trait Api
{
    /**
     * The last response returned by the application converted into json
     *
     * @var \Illuminate\Http\Response
     */
    protected $jsonResponse;

    /**
     * Decode as json the response from call and store it on jsonResponse object
     *
     * @param        $uri
     * @param string $method
     * @param array  $parameters
     *
     * @return $this
     */
    protected function getJson($uri, $method = 'GET', $parameters = [])
    {
        $this->jsonResponse = json_decode($this->call($method, $uri, $parameters)->getContent());

        return $this;
    }

    /**
     * Asserts that an object has a specified attributes
     */
    protected function assertObjectHasAttributes()
    {
        $args = func_get_args();
        $object = array_shift($args);

        foreach ($args as $attribute) {
            $this->assertObjectHasAttribute($attribute, $object);
        }
    }
}
