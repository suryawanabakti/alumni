<?php

namespace App\Filament\Widgets;

use App\Models\InformasiBeasiswa;
use App\Models\InformasiLoker;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Beasiswa', InformasiBeasiswa::count()),
            Stat::make('Total Loker', InformasiLoker::count()),
            Stat::make('Total Alumni', User::role('alumni')->count()),
        ];
    }
}
