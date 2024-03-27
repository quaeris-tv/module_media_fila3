<?php

namespace Tests\Unit\Modules\Media\Services;

use Illuminate\Database\Eloquent\Model;
use Mockery;
use Modules\Media\Services\SubtitleService;
use ReflectionClass;
use SubtitleService as SubtitleServiceAlias;
use Tests\TestCase;

/**
 * Class SubtitleServiceTest.
 *
 * @covers \Modules\Media\Services\SubtitleService
 */
final class SubtitleServiceTest extends TestCase
{
    private SubtitleService $subtitleService;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        /**
* 
         *
 * @todo Correctly instantiate tested object to use it. 
*/
        $this->subtitleService = new SubtitleService();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->subtitleService);
    }

    public function testGetInstance(): void
    {
        $expected = Mockery::mock(SubtitleServiceAlias::class);
        $property = (new ReflectionClass(SubtitleService::class))
            ->getProperty('instance');
        $property->setValue(null, $expected);
        self::assertSame($expected, SubtitleService::getInstance());
    }

    public function testMake(): void
    {
        /**
* 
         *
 * @todo This test is incomplete. 
*/
        self::markTestIncomplete();
    }

    public function testSetFilePath(): void
    {
        /**
* 
         *
 * @todo This test is incomplete. 
*/
        self::markTestIncomplete();
    }

    public function testSetModel(): void
    {
        $expected = Mockery::mock(Model::class);
        $property = (new ReflectionClass(SubtitleService::class))
            ->getProperty('model');
        $this->subtitleService->setModel($expected);
        self::assertSame($expected, $property->getValue($this->subtitleService));
    }

    public function testGetModel(): void
    {
        $expected = Mockery::mock(Model::class);
        $property = (new ReflectionClass(SubtitleService::class))
            ->getProperty('model');
        $property->setValue($this->subtitleService, $expected);
        self::assertSame($expected, $this->subtitleService->getModel());
    }

    public function testUpateModel(): void
    {
        /**
* 
         *
 * @todo This test is incomplete. 
*/
        self::markTestIncomplete();
    }

    public function testGetPlain(): void
    {
        /**
* 
         *
 * @todo This test is incomplete. 
*/
        self::markTestIncomplete();
    }

    public function testGet(): void
    {
        /**
* 
         *
 * @todo This test is incomplete. 
*/
        self::markTestIncomplete();
    }

    public function testGetContent(): void
    {
        /**
* 
         *
 * @todo This test is incomplete. 
*/
        self::markTestIncomplete();
    }

    public function testGetFromXml(): void
    {
        /**
* 
         *
 * @todo This test is incomplete. 
*/
        self::markTestIncomplete();
    }

    public function testSrtToVtt(): void
    {
        /**
* 
         *
 * @todo This test is incomplete. 
*/
        self::markTestIncomplete();
    }
}
