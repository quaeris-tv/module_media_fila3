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

        return $panel->plugins([
            \Awcodes\Curator\CuratorPlugin::make()
                ->label('Curator Media')
                ->pluralLabel('Curator Media')
                ->navigationIcon('heroicon-o-photo')
                ->navigationGroup('Content')
                ->navigationSort(3)
                ->navigationCountBadge()
                ->registerNavigation(false)
            // ->defaultListView('grid' || 'list'),
                ->defaultListView('grid')
            // ->resource(\App\Filament\Resources\CustomMediaResource::class),
            // ->resource(\Modules\Media\Filament\Resources\CuratorMediaResource::class)
            ,
        ]);
    }
}
