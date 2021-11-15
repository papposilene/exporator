<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ExhibitionResource;
use App\Models\Exhibition;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ExhibitionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function all()
    {
        $year = date('Y-01-01');

        return ExhibitionResource::collection(
            Exhibition::where('ended_at', '>', $year)
            ->orderBy('began_at', 'asc')->get()
        )->toJson();
    }

    /**
     * Retrieve the statistics for exhibition.
     *
     * @param  \App\Models\Exhibition  $exhibition
     * @return \Illuminate\Http\Response
     */
    public function stat_year(Exhibition $exhibition)
    {
        $dataStatistics = Exhibition::all();
        $dataYears = $dataStatistics->groupBy(function($date) {
            // Solution found at https://stackoverflow.com/a/25538667
            return Carbon::parse($date->began_at)->format('Y'); // grouping by years
            //return Carbon::parse($date->created_at)->format('m'); // grouping by months
        })->toArray();

        ksort($dataYears);
        foreach ($dataYears as $year => $value)
        {
            $years[$year] = count($value);
        }

        $statistics = collect([
            'data' => [
                'total' => $dataStatistics->count(),
            ],
            'chart' => [
                'labels' => array_keys($years),
                'datasets' => [
                    [
                        'label' => ucfirst(__('chart.exhibitions_by_years')),
                        'data' => array_values($years),
                        'backgroundColor' => [
                            '#0284C7',
                        ],
                        'borderColor' => '#000',
                        'tension' => '0.3',
                        'fill' => false,
                    ],
                ],
            ],
            'options' => [
                'indexAxis' => 'x',
                'legend' => [
                    'display' => true,
                    'position' => 'bottom',
                    'fontColor' => '#fff',
                ],
                'responsive' => true,
                'scales' => [
                    'y' => [
                        'beginAtZero' => false,
                    ],
                ],
                'title' => [
                    'display' => true,
                    'fontColor' => '#fff',
                    'position' => 'bottom',
                    'text' => ucfirst(__('chart.exhibitions_by_years')),
                ],
            ],
        ])->all();

        return $statistics;
    }
}
