<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function SetProducts(){
        return view('admin.adminproducts');
    }
    public function store(Request $request){
        $product= new Products();
        $product->title= $request->has('title')? $request->get('title'):'';
        $product->price= $request->has('price')? $request->get('price'):'';
        $product->amount= $request->has('amount')? $request->get('amount'):'';
        $product->description= $request->has('description')? $request->get('description'):'';
        if($request->hasFile('image')){
            $files = $request->file('image');
            $imageLocation= array();
            $i=0;
            foreach ($files as $file){
                $extension = $file->getClientOriginalExtension();
                $fileName= 'product_'. time() . ++$i . '.' . $extension;
                $location= '/products/uploads/';
                $file->move(public_path() . $location, $fileName);
                $imageLocation[]= $location. $fileName;
            }

            $product->pictures= implode('|', $imageLocation);
            $product->save();
            return back()->with('success', 'Product Successfully Saved!');
        } else{
            return back()->with('error', 'Product was not saved');
        }
        
    }
    public function show(Request $product)
    {
        // $pictures=explode('|',$product->pictures);
        // return view('product_details',compact('pictures','product'));
        dd($product);
    }
}
