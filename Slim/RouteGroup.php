<?php
/**
 * Slim Framework (https://slimframework.com)
 *
 * @link      https://github.com/slimphp/Slim
 * @copyright Copyright (c) 2011-2017 Josh Lockhart
 * @license   https://github.com/slimphp/Slim/blob/3.x/LICENSE.md (MIT License)
 */
namespace Slim;

use Slim\Interfaces\RouteGroupInterface;

/**
 * A collector for Routable objects with a common middleware stack
 *
 * @package Slim
 */
class RouteGroup extends Routable implements RouteGroupInterface
{
    /**
     * Create a new RouteGroup
     *
     * @param string   $pattern  The pattern prefix for the group
     * @param callable $callable The group callable
     */
    public function __construct($pattern, $callable)
    {
        $this->pattern = $pattern;
        $this->callable = $callable;
    }

    /**
     * Invoke the group to register any Routable objects within it.
     *
     * @param App $app The App to bind the callable to.
     */
    public function __invoke(App $app)
    {
        // Resolve route callable
        $callable = $this->callable;
        if ($this->callableResolver) {
            $callable = $this->callableResolver->resolve($callable);
        }

        $callable($app);
    }
}
