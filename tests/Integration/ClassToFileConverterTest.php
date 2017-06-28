<?php

namespace DTL\ClassFileConverter\Tests\Integration;

use DTL\ClassFileConverter\Tests\Integration\IntegrationTestCase;
use DTL\ClassFileConverter\ClassToFileConverter;

/**
 * @runTestsInSeparateProcesses
 */
class ClassToFileConverterTest extends IntegrationTestCase
{
    private $classLoader;

    public function setUp()
    {
        $this->classLoader = require(__DIR__ . '/../../vendor/autoload.php');
    }

    /**
     * It can build itself using a composer autoloader.
     */
    public function testCreateForComposer()
    {
        $converter = ClassToFileConverter::fromComposerAutoloader($this->classLoader);
        $candidates = $converter->fileToClassCandidates(__FILE__);
        $this->assertEquals(
            __CLASS__, (string) $candidates->best()
        );

        $candidates = $converter->classToFileCandidates(__CLASS__);
        $this->assertEquals(
            __FILE__, (string) $candidates->best()
        );
    }

    /**
     * It can build itself using a series of composer autoloaders.
     */
    public function testCreateForComposers()
    {
        $converter = ClassToFileConverter::fromComposerAutoloaders([$this->classLoader]);
        $candidates = $converter->fileToClassCandidates(__FILE__);
        $this->assertEquals(
            __CLASS__, (string) $candidates->best()
        );

        $candidates = $converter->classToFileCandidates(__CLASS__);
        $this->assertEquals(
            __FILE__, (string) $candidates->best()
        );
    }
}
