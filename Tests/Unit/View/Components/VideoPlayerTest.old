<?php

declare(strict_types=1);

namespace Modules\Media\Tests\Unit\View\Components;

use Modules\Media\View\Components\VideoPlayer;
use Tests\TestCase;

/**
 * Class VideoPlayerTest.
 *
 * @covers \Modules\Media\View\Components\VideoPlayer
 */
final class VideoPlayerTest extends TestCase
{
    private VideoPlayer $videoPlayer;

    private string $mp4Src;

    private int $currentTime;

    private string $driver;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->mp4Src = '42';
        $this->currentTime = 42;
        $this->driver = '42';
        $this->videoPlayer = new VideoPlayer($this->mp4Src, $this->currentTime, $this->driver);
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->videoPlayer);
        unset($this->mp4Src);
        unset($this->currentTime);
        unset($this->driver);
    }

    public function testRender(): void
    {
        /**
*
         *
 * @todo This test is incomplete.
*/
        self::markTestIncomplete();
    }
}
