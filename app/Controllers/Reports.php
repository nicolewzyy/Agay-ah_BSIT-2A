<?php

namespace App\Controllers;

use App\Models\SaleModel;

class Reports extends BaseController
{
    public function index()
    {
        $saleModel = new SaleModel();
        
        $data = [
            'title' => 'Sales Reports',
            'daily_sales' => $saleModel->select('DATE(created_at) as date, SUM(final_amount) as total')
                                      ->groupBy('DATE(created_at)')
                                      ->orderBy('date', 'DESC')
                                      ->findAll(),
            'total_revenue' => $saleModel->selectSum('final_amount')->first()['final_amount'] ?? 0
        ];
        
        return view('reports/index', $data);
    }
}
