<?php

namespace spec\PhpSpec\Lumen\Util;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Laravel\Lumen\Application;

class LumenSpec extends ObjectBehavior
{
    private $appInst;

    function let(Application $appInst)
    {
        $this->appInst = $appInst;
    }

    function it_boots_in_the_testing_env_by_default()
    {
        $this->beConstructedWith(null, '.');
        $this->getEnv()->shouldBe('testing');
    }

    function it_allows_the_env_to_be_set_to_anything()
    {
        $this->beConstructedWith('whatever', '.');
        $this->getEnv()->shouldBe('whatever');
    }
}
