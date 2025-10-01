<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class productController extends Controller
{
    public function productList(){
        return view ('productInformation');
    }

    public function productMasterlist(Request $request){
        $productList = $request->session()->get('products',[]);

        $search = $request->input('search');
            if (!empty($search)) {
                $filtered = [];

                foreach ($productList as $product) {
                    if (strpos(strtolower($product['name']), strtolower($search)) !== false) {
                        $filtered[] = $product;
                    }
                }
            $productList = $filtered;
        }

        return view('productInformation', compact('productList'));
    }

    public function addProduct(Request $request){
        $request->validate([
            'id'=>'required',
            'name' =>'required',
            'category' =>'required',
            'quantity' =>'required',
            'price' =>'required'
        ]);

        $productList = $request->session()->get('products',[]);

        $productList[]= [
            'id' => $request ->id,
            'name' =>$request ->name,
            'category' => $request->category,
            'quantity' => $request->quantity,
            'price' => $request->price
        ];
        $request->session()->put('products', $productList);

        return redirect()->route('product.list');
    }

    public function editProduct(Request $request, $index) {
        $productList = $request->session()->get('products', []);

        if (!isset($productList[$index])) {
            return redirect()->route('product.list')->with('error', 'Product not found.');
        }

        $product = $productList[$index];
        return view('productInfoEdit', compact('product', 'index'));
    }

    public function updateProduct(Request $request, $index) {
        $request->validate([
            'id' => 'required',
            'name' => 'required',
            'category' => 'required',
            'quantity' => 'required',
            'price' => 'required',
        ]);

        $productList = $request->session()->get('products', []);

        if (isset($productList[$index])) {
            $productList[$index] = [
                'id' => $request->id,
                'name' => $request->name,
                'category' => $request->category,
                'quantity' => $request->quantity,
                'price' => $request->price,
                ];
            $request->session()->put('products', $productList);
        }

        return redirect()->route('product.list')->with('success', 'Product updated successfully.');
    }

    public function deleteProduct(Request $request, $index) {
        $productList = $request->session()->get('products', []);
        if (isset($productList[$index])) {
            unset($productList[$index]);

            $request->session()->put('products', array_values($productList)); // reindex array
        }

        return redirect()->route('product.list')->with('success', 'Product deleted successfully.');
    }


}