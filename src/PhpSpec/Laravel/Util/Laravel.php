<?php
namespace PhpSpec\Laravel\Util;

use Carbon\Carbon;
use Laravel\Lumen\Application;

/**
 * This class provides an entry point into Laravel for PhpSpec.
 */
class Laravel
{
    /**
     * The Illuminate application instance.
     *
     * @var \Laravel\Lumen\Application
     */
    protected $app;

    /**
     * The Laravel testing environment.
     *
     * @var string
     */
    protected $env;

    /**
     * Path to the root of the Laravel application.
     *
     * @var string
     */
    protected $appPath;

    /**
     * Constructor.
     *
     * @param  string $env     Laravel testing environment. 'testing' by
     *                         default
     * @param  string $appPath Path to the Laravel bootstrap dir
     * @return void
     */
    public function __construct($env, $appPath)
    {
        $this->env     = $env ?: 'testing';
        $this->appPath = $appPath;
    }

    /**
     * Refresh the application instance.
     *
     * @param \Laravel\Lumen\Application $app Optionally provide your own unbooted
     *                                                Laravel Application instance. This
     *                                                parameter can largely be ignored and
     *                                                is used just for unit testing
     * @return void
     */
    public function refreshApplication($app = null)
    {
        $this->app = $app instanceof Application ? $app : $this->createApplication();
    }

    /**
     * Get the Laravel application environment being used.
     *
     * @return string Environment name
     */
    public function getEnv()
    {
        return $this->env;
    }

    /**
     * @return string Root laravel app path
     */
    public function getAppPath()
    {
        return $this->appPath;
    }

    /**
     * Creates a Laravel application.
     *
     * @return \Laravel\Lumen\Application
     */
    protected function createApplication()
    {
        putenv('APP_ENV=' . $this->getEnv());

        $app = require $this->appPath;

        Carbon::setTestNow(Carbon::now());

        return $app;
    }
}
