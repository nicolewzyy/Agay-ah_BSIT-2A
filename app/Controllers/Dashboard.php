<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\SaleModel;
use App\Models\CategoryModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $productModel = new ProductModel();
        $saleModel = new SaleModel();
        $categoryModel = new CategoryModel();

        $data = [
            'title' => 'Dashboard',
            'total_products' => $productModel->countAll(),
            'total_sales' => $saleModel->selectSum('final_amount')->first()['final_amount'] ?? 0,
            'recent_sales' => $saleModel->orderBy('created_at', 'DESC')->limit(5)->find(),
            'low_stock' => $productModel->where('stock_quantity <', 10)->findAll(),
        ];

        return view('dashboard/index', $data);
    }
}
