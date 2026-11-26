<?php

import('plugins.generic.pluginUpdateNotification.classes.UpgradablePluginsFinder');

use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Psr7\Request;
use PHPUnit\Framework\TestCase;

class UpgradablePluginsFinderTest extends TestCase
{
    private $errorLogFile;
    private $previousErrorLog;

    protected function setUp(): void
    {
        $this->errorLogFile = tempnam(sys_get_temp_dir(), 'pluginUpdateNotification');
        $this->previousErrorLog = ini_set('error_log', $this->errorLogFile);
    }

    protected function tearDown(): void
    {
        ini_set('error_log', $this->previousErrorLog);
        unlink($this->errorLogFile);
    }

    public function testListsOnlyUpgradablePlugins(): void
    {
        $finder = new UpgradablePluginsFinder($this->createGalleryDao(function () {
            return array(
                $this->createGalleryPlugin('ORCID Profile', PLUGIN_GALLERY_STATE_UPGRADABLE),
                $this->createGalleryPlugin('Backup', PLUGIN_GALLERY_STATE_CURRENT),
                $this->createGalleryPlugin('Default Translation', PLUGIN_GALLERY_STATE_UPGRADABLE),
            );
        }));

        $this->assertSame(array('ORCID Profile', 'Default Translation'), $finder->getUpgradablePluginNames(null));
    }

    public function testGalleryNetworkFailureDoesNotPropagate(): void
    {
        $finder = new UpgradablePluginsFinder($this->createGalleryDao(function () {
            throw new ConnectException(
                'cURL error 6: Could not resolve host: pkp.sfu.ca',
                new Request('GET', 'https://pkp.sfu.ca/ojs/xml/plugins.xml')
            );
        }));

        $this->assertSame(array(), $finder->getUpgradablePluginNames(null));
        $this->assertStringContainsString('Could not resolve host: pkp.sfu.ca', file_get_contents($this->errorLogFile));
    }

    public function testInvalidGalleryResponseDoesNotPropagate(): void
    {
        $finder = new UpgradablePluginsFinder($this->createGalleryDao(function () {
            throw new TypeError('DOMDocument::loadXML(): Argument #1 ($source) must not be empty');
        }));

        $this->assertSame(array(), $finder->getUpgradablePluginNames(null));
        $this->assertStringContainsString('TypeError', file_get_contents($this->errorLogFile));
    }

    private function createGalleryDao(callable $getNewestCompatible)
    {
        return new class ($getNewestCompatible) {
            private $getNewestCompatible;

            public function __construct(callable $getNewestCompatible)
            {
                $this->getNewestCompatible = $getNewestCompatible;
            }

            public function getNewestCompatible($application, $category = null, $search = null)
            {
                return call_user_func($this->getNewestCompatible);
            }
        };
    }

    private function createGalleryPlugin($name, $status)
    {
        return new class ($name, $status) {
            private $name;
            private $status;

            public function __construct($name, $status)
            {
                $this->name = $name;
                $this->status = $status;
            }

            public function getLocalizedName()
            {
                return $this->name;
            }

            public function getCurrentStatus()
            {
                return $this->status;
            }
        };
    }
}
