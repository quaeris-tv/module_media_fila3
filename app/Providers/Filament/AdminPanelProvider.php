<?php

declare(strict_types=1);

namespace Modules\Media\Providers\Filament;

use Filament\Panel;
use Modules\Xot\Providers\Filament\XotBasePanelProvider;

class AdminPanelProvider extends XotBasePanelProvider
{
    protected string $module = 'Media';

    public function panel(Panel $panel): Panel
    {
        $panel = parent::panel($panel);

        return $panel;
    }
}
