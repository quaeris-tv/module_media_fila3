<?php

declare(strict_types=1);

namespace Modules\Media\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Modules\Xot\Actions\GetViewAction;
use Modules\Xot\Datas\XotData;
use Webmozart\Assert\Assert;

/**
 * Class VideoPlayer.
 */
class VideoPlayer extends Component
{
    public string $driver;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(public string $mp4Src, public int $currentTime, ?string $driver = null)
    {
        $xot = XotData::make();
        Assert::string($driver ??= $xot->video_player);

        $this->driver = $driver;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View
     */
    public function render()
    {
        /**
         * @phpstan-var view-string
         */
        $view = app(GetViewAction::class)->execute($this->driver);

        $view_params = [
            'view' => $view,
        ];

        return view($view, $view_params);
    }
}
