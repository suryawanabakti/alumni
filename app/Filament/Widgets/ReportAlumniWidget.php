<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\ChartWidget;

class ReportAlumniWidget extends ChartWidget
{
    protected static ?string $heading = 'Jumlah Alumni per Angkatan dan Prodi';
    protected int | string | array $columnSpan = 'full'; // Tambahkan ini
    protected function getData(): array
    {
        // Ambil data jumlah alumni berdasarkan angkatan
        $angkatanData = User::selectRaw('angkatan, COUNT(*) as total')
            ->groupBy('angkatan')
            ->orderBy('angkatan', 'asc')
            ->get();

        // Ambil data jumlah alumni berdasarkan program studi dan angkatan
        $prodiData = User::selectRaw('angkatan, prodi, COUNT(*) as total')
            ->groupBy('angkatan', 'prodi')
            ->orderBy('angkatan', 'asc')
            ->get();

        // Ambil semua angkatan unik
        $angkatanLabels = $angkatanData->pluck('angkatan')->toArray();

        // Data jumlah alumni per angkatan
        $totalAlumniDataset = $angkatanData->pluck('total')->toArray();

        // Data jumlah alumni per prodi
        $prodiNames = $prodiData->pluck('prodi')->unique()->toArray();
        $prodiDatasets = [];

        foreach ($prodiNames as $prodi) {
            // Ambil data alumni per prodi dan angkatan
            $prodiDatasets[] = [
                'label' => "Alumni $prodi",
                'data' => array_map(function ($angkatan) use ($prodiData, $prodi) {
                    return $prodiData->where('angkatan', $angkatan)->where('prodi', $prodi)->sum('total');
                }, $angkatanLabels),
                'backgroundColor' => $this->randomColor(),
                'borderColor' => $this->randomColor(true),
                'borderWidth' => 1,
            ];
        }

        return [
            'labels' => $angkatanLabels,
            'datasets' => array_merge([
                [
                    'label' => 'Total Alumni',
                    'data' => $totalAlumniDataset,
                    'backgroundColor' => 'rgba(54, 162, 235, 0.5)',
                    'borderColor' => 'rgba(54, 162, 235, 1)',
                    'borderWidth' => 1,
                ]
            ], $prodiDatasets)
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    private function randomColor($border = false)
    {
        $opacity = $border ? 1 : 0.5;
        return 'rgba(' . rand(50, 200) . ', ' . rand(50, 200) . ', ' . rand(50, 200) . ", $opacity)";
    }
}
