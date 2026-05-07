<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\CategoryModel;
use App\Models\InventoryLogModel;

class Inventory extends BaseController
{
    public function index()
    {
        $productModel = new ProductModel();
        $data = [
            'title' => 'Inventory Management',
            'products' => $productModel->getProductsWithCategory()
        ];
        return view('inventory/index', $data);
    }

    public function create()
    {
        $categoryModel = new CategoryModel();
        $data = [
            'title' => 'Add New Product',
            'categories' => $categoryModel->findAll()
        ];
        return view('inventory/create', $data);
    }

    public function store()
    {
        $productModel = new ProductModel();
        
        $rules = [
            'name' => 'required',
            'category_id' => 'required',
            'price' => 'required|decimal',
            'stock_quantity' => 'required|numeric'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $productData = [
            'name' => $this->request->getPost('name'),
            'category_id' => $this->request->getPost('category_id'),
            'description' => $this->request->getPost('description'),
            'price' => $this->request->getPost('price'),
            'stock_quantity' => $this->request->getPost('stock_quantity'),
        ];

        $productModel->insert($productData);
        return redirect()->to('/inventory')->with('success', 'Product added successfully');
    }

    public function edit($id)
    {
        $productModel = new ProductModel();
        $categoryModel = new CategoryModel();
        $data = [
            'title' => 'Edit Product',
            'product' => $productModel->find($id),
            'categories' => $categoryModel->findAll()
        ];
        return view('inventory/edit', $data);
    }

    public function update($id)
    {
        $productModel = new ProductModel();
        
        $rules = [
            'name' => 'required',
            'category_id' => 'required',
            'price' => 'required|decimal',
            'stock_quantity' => 'required|numeric'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $productData = [
            'name' => $this->request->getPost('name'),
            'category_id' => $this->request->getPost('category_id'),
            'description' => $this->request->getPost('description'),
            'price' => $this->request->getPost('price'),
            'stock_quantity' => $this->request->getPost('stock_quantity'),
        ];

        $productModel->update($id, $productData);
        return redirect()->to('/inventory')->with('success', 'Product updated successfully');
    }

    public function categories()
    {
        $categoryModel = new CategoryModel();
        $data = [
            'title' => 'Categories',
            'categories' => $categoryModel->findAll()
        ];
        return view('inventory/categories', $data);
    }

    public function categoryStore()
    {
        $categoryModel = new CategoryModel();
        $categoryModel->insert(['name' => $this->request->getPost('name')]);
        return redirect()->to('/categories')->with('success', 'Category added successfully');
    }
}
