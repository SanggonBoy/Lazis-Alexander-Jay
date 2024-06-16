<?php

namespace App\Charts;

use Carbon\Carbon;
use App\Models\Order;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class OrderCharts
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {   
        $jan = [Order::whereBetween('created_at', ['2024-01-01', '2024-01-30'])->where('status_pembayaran', 'berhasil')->sum('nominal')];
        $feb = [Order::whereBetween('created_at', ['2024-02-01', '2024-02-30'])->where('status_pembayaran', 'berhasil')->sum('nominal')];
        $mar = [Order::whereBetween('created_at', ['2024-03-01', '2024-03-30'])->where('status_pembayaran', 'berhasil')->sum('nominal')];
        $apr = [Order::whereBetween('created_at', ['2024-04-01', '2024-04-30'])->where('status_pembayaran', 'berhasil')->sum('nominal')];
        $mei = [Order::whereBetween('created_at', ['2024-05-01', '2024-05-30'])->where('status_pembayaran', 'berhasil')->sum('nominal')];
        $jun = [Order::whereBetween('created_at', ['2024-06-01', '2024-06-30'])->where('status_pembayaran', 'berhasil')->sum('nominal')];

        $bulan = ['Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des', 'Jan', 'Feb', 'Mar', ];
        
        return $this->chart->barChart()
            ->setTitle('Data Transaksi Tahun Ini')
            ->setSubtitle('Periode Jan-Des 2024')
            ->setHeight(300)
            ->addData('-',[0])
            ->addData('Transaksi', [$apr, $mei, $jun, $jan, $feb, $mar])
            ->setXAxis($bulan);
    }
}
