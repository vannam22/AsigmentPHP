<?php
class Pages extends Controller
{
    public function __construct()
    {
        $this->productModel = $this->model('Page');
    }
    public function index()
    {
        $products = $this->productModel->getProduct();
        $data = [
            'products' => $products
        ];
        
        $this->view('pages/index', $data);
    }
}