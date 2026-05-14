<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\SaleModel;
use App\Models\SaleItemModel;
use App\Models\CategoryModel;

class Sales extends BaseController
{
    public function index()
    {
        $productModel = new ProductModel();
        $categoryModel = new CategoryModel();
        
        $data = [
            'title' => 'Sales / POS',
            'products' => $productModel->findAll(),
            'categories' => $categoryModel->findAll()
        ];
        return view('sales/index', $data);
    }

    public function process()
    {
        $saleModel = new SaleModel();
        $saleItemModel = new SaleItemModel();
        $productModel = new ProductModel();

        $cart = $this->request->getPost('cart');
        $totalAmount = $this->request->getPost('total_amount');
        $discount = $this->request->getPost('discount') ?? 0;
        $finalAmount = $this->request->getPost('final_amount');
        $paidAmount = $this->request->getPost('paid_amount');
        $changeAmount = $this->request->getPost('change_amount');

        if (empty($cart)) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Cart is empty']);
        }

        $db = \Config\Database::connect();
        $db->transStart();

        $saleId = $saleModel->insert([
            'total_amount' => $totalAmount,
            'discount' => $discount,
            'final_amount' => $finalAmount,
            'paid_amount' => $paidAmount,
            'change_amount' => $changeAmount,
        ]);

        foreach ($cart as $item) {
            $saleItemModel->insert([
                'sale_id' => $saleId,
                'product_id' => $item['id'],
                'quantity' => $item['quantity'],
                'unit_price' => $item['price'],
                'subtotal' => $item['quantity'] * $item['price'],
            ]);

            // Update stock
            $product = $productModel->find($item['id']);
            $productModel->update($item['id'], [
                'stock_quantity' => $product['stock_quantity'] - $item['quantity']
            ]);
        }

        $db->transComplete();

        if ($db->transStatus() === false) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Failed to process sale']);
        }

        return $this->response->setJSON(['status' => 'success', 'message' => 'Sale completed', 'sale_id' => $saleId]);
    }
}
