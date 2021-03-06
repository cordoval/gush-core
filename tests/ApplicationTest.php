<?php

/**
 * This file is part of Gush package.
 *
 * (c) 2013-2014 Luis Cordova <cordoval@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Gush\Tests;

use Gush\Application;
use Symfony\Component\Console\Tester\ApplicationTester;
use Gush\Config;

/**
 * @author Daniel Gomes <me@danielcsgomes.com>
 * @author Luis Cordova <cordoval@gmail.com>
 */
class ApplicationTest extends \PHPUnit_Framework_TestCase
{
    const GUSH_FILE = <<<EOT
parameters:
    cache-dir: /Users/cordoval/.gush/cache
    adapters: { github: { config: { base_url: 'https://api.github.com/', repo_domain_url: 'https://github.com' }, adapter_class: Gush\Adapter\GitHubAdapter, authentication: { username: cordoval, password-or-token: password, http-auth-type: http_password } } }
    home: /Users/cordoval/.gush
    home_config: /Users/cordoval/.gush/.gush.yml
    local: /Users/cordoval/Sites/gush
    local_config: /Users/cordoval/Sites/gush/.gush.yml
    adapter: github
    versioneye-token: NO_TOKEN
EOT
    ;

    /**
     * @var Application $application
     */
    protected $application;
    protected $gushFile;

    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        @unlink(getcwd().'/.first-time-run');

        $config = new Config();

        $this->application = new TestableApplication();
        $this->application->setConfig($config);
        $this->application->setAutoExit(false);
    }

    public function testApplicationFirstRun()
    {
        $applicationTester = new ApplicationTester($this->application);
        $applicationTester->run(['command' => 'core:configure'], ['interactive' => false]);

        $this->assertRegExp('/Configuration file saved successfully./', $applicationTester->getDisplay());
    }
}
