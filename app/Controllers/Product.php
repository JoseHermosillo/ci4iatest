<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductModel;
use App\Models\CategoryModel;

class Product extends BaseController
{
    protected $productModel;
    protected $categoryModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
        $this->categoryModel = new CategoryModel();
    }

    public function index()
    {
        $userId = session()->get('user_id');
        $products = $this->productModel->where('user_id', $userId)->findAll();
        $categories = $this->categoryModel->findAll();
        return view('products/index', [
            'title' => 'Products',
            'products' => $products,
            'categories' => $categories,
        ]);
    }

    public function create()
    {
        $categories = $this->categoryModel->findAll();
        return view('products/create', [
            'title' => 'Create Product',
            'categories' => $categories,
        ]);
    }

    public function store()
    {
        if ($this->request->getMethod() !== 'post') {
            return redirect()->to('products');
        }

        $name     = $this->request->getPost('name');
        $sku      = $this->request->getPost('sku');
        $price    = $this->request->getPost('price');
        $description = $this->request->getPost('description');
        $offerPrice  = $this->request->getPost('offer_price');
        $brand    = $this->request->getPost('brand');
        $type     = $this->request->getPost('type');
        $stock    = $this->request->getPost('stock') ?? 0;
        $status   = $this->request->getPost('status') ?? 'active';
        $categories = $this->request->getPost('categories') ?? [];

        $rules = [
            'name'  => 'required|min_length[3]|max_length[150]',
            'sku'   => 'required|min_length[3]|max_length[50]|is_unique[products.sku]',
            'price' => 'required|numeric|greater_than[0]',
        ];

        if (! $this->validate($rules)) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'success' => false,
                    'errors' => $this->validator->getErrors(),
                ]);
            }
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Handle image upload
        $image = $this->request->getFile('image');
        $imageName = null;
        if ($image && $image->isValid()) {
            $imageName = $image->getRandomName();
            $image->move(FCPATH . 'uploads/products/', $imageName);
        }

        // Create slug from name
        $slug = url_title($name, '-', true);

        $saveData = [
            'user_id'     => session()->get('user_id'),
            'name'        => $name,
            'slug'        => $slug,
            'sku'         => $sku,
            'price'       => $price,
            'offer_price' => $offerPrice ?: null,
            'description' => $description,
            'brand'       => $brand,
            'type'        => $type,
            'image'       => $imageName,
            'stock'       => $stock,
            'status'      => $status,
        ];

        if (! $this->productModel->skipValidation(true)->save($saveData)) {
            $errors = $this->productModel->errors() ?: ['Unable to save product.'];
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'success' => false,
                    'errors' => $errors,
                ]);
            }
            return redirect()->back()->withInput()->with('errors', $errors);
        }

        $productId = $this->productModel->getInsertID();

        // Save categories
        if (! empty($categories)) {
            foreach ($categories as $categoryId) {
                $this->productModel->db->table('product_category')->insert([
                    'product_id'  => $productId,
                    'category_id' => $categoryId,
                ]);
            }
        }

        if ($this->request->isAJAX()) {
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Product created successfully',
            ]);
        }

        return redirect()->to('products')->with('success', 'Product created successfully');
    }

    public function edit($id)
    {
        $userId = session()->get('user_id');
        $product = $this->productModel->where('id', $id)->where('user_id', $userId)->first();
        if (! $product) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON(['success' => false, 'message' => 'Product not found or unauthorized']);
            }
            return redirect()->to('products')->with('error', 'Product not found or unauthorized');
        }

        $productCategories = $this->productModel->getCategories($id);
        $categoryIds = array_column($productCategories, 'id');

        if ($this->request->isAJAX()) {
            return $this->response->setJSON([
                'success' => true,
                'product' => $product,
                'category_ids' => $categoryIds,
            ]);
        }

        $categories = $this->categoryModel->findAll();
        return view('products/edit', [
            'title' => 'Edit Product',
            'product' => $product,
            'categories' => $categories,
            'categoryIds' => $categoryIds,
        ]);
    }

    public function update($id)
    {
        if ($this->request->getMethod() !== 'post') {
            return redirect()->to('products');
        }

        $userId = session()->get('user_id');
        $product = $this->productModel->where('id', $id)->where('user_id', $userId)->first();
        if (! $product) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'success' => false,
                    'errors' => ['Product not found or unauthorized'],
                ]);
            }
            return redirect()->to('products')->with('error', 'Product not found or unauthorized');
        }

        $name     = $this->request->getPost('name');
        $sku      = $this->request->getPost('sku');
        $price    = $this->request->getPost('price');
        $description = $this->request->getPost('description');
        $offerPrice  = $this->request->getPost('offer_price');
        $brand    = $this->request->getPost('brand');
        $type     = $this->request->getPost('type');
        $stock    = $this->request->getPost('stock') ?? 0;
        $status   = $this->request->getPost('status') ?? 'active';
        $categories = $this->request->getPost('categories') ?? [];

        $rules = [
            'name'  => 'required|min_length[3]|max_length[150]',
            'price' => 'required|numeric|greater_than[0]',
        ];

        if (! $this->validate($rules)) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'success' => false,
                    'errors' => $this->validator->getErrors(),
                ]);
            }
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $imageName = $product['image'];
        $image = $this->request->getFile('image');
        if ($image && $image->isValid()) {
            if ($imageName && file_exists(FCPATH . 'uploads/products/' . $imageName)) {
                unlink(FCPATH . 'uploads/products/' . $imageName);
            }
            $imageName = $image->getRandomName();
            $image->move(FCPATH . 'uploads/products/', $imageName);
        }

        $slug = url_title($name, '-', true);

        $updateData = [
            'name'        => $name,
            'slug'        => $slug,
            'price'       => $price,
            'offer_price' => $offerPrice ?: null,
            'description' => $description,
            'brand'       => $brand,
            'type'        => $type,
            'image'       => $imageName,
            'stock'       => $stock,
            'status'      => $status,
        ];

        if (! $this->productModel->update($id, $updateData)) {
            $errors = $this->productModel->errors() ?: ['Unable to update product.'];
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'success' => false,
                    'errors' => $errors,
                ]);
            }
            return redirect()->back()->withInput()->with('errors', $errors);
        }

        // Update categories
        $this->productModel->db->table('product_category')->where('product_id', $id)->delete();
        if (! empty($categories)) {
            foreach ($categories as $categoryId) {
                $this->productModel->db->table('product_category')->insert([
                    'product_id'  => $id,
                    'category_id' => $categoryId,
                ]);
            }
        }

        if ($this->request->isAJAX()) {
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Product updated successfully',
            ]);
        }

        return redirect()->to('products')->with('success', 'Product updated successfully');
    }

    public function delete($id)
    {
        $userId = session()->get('user_id');
        $product = $this->productModel->where('id', $id)->where('user_id', $userId)->first();
        if (! $product) {
            return redirect()->to('products')->with('error', 'Product not found or unauthorized');
        }

        if ($product['image'] && file_exists(FCPATH . 'uploads/products/' . $product['image'])) {
            unlink(FCPATH . 'uploads/products/' . $product['image']);
        }

        $this->productModel->db->table('product_category')->where('product_id', $id)->delete();
        $this->productModel->delete($id);

        return redirect()->to('products')->with('success', 'Product deleted successfully');
    }
}
