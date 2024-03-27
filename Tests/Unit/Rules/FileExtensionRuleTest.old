<?php

namespace Tests\Unit\Modules\Media\Rules;

use Modules\Media\Rules\FileExtensionRule;
use Tests\TestCase;

/**
 * Class FileExtensionRuleTest.
 *
 * @covers \Modules\Media\Rules\FileExtensionRule
 */
final class FileExtensionRuleTest extends TestCase
{
    private FileExtensionRule $fileExtensionRule;

    private array $validExtensions;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->validExtensions = [];
        $this->fileExtensionRule = new FileExtensionRule($this->validExtensions);
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->fileExtensionRule);
        unset($this->validExtensions);
    }

    public function testPassesWhenOk(): void
    {
        /**
* 
         *
 * @todo This test is incomplete. 
*/
        self::assertTrue($this->fileExtensionRule->passes('attribute', 'valid value'));
    }

    public function testPassesWhenFailed(): void
    {
        /**
* 
         *
 * @todo This test is incomplete. 
*/
        self::assertFalse($this->fileExtensionRule->passes('attribute', 'invalid value'));
    }

    public function testMessage(): void
    {
        /**
* 
         *
 * @todo This test is incomplete. 
*/
        self::markTestIncomplete();
    }
}
