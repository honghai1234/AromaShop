<?php

namespace App\Http\Controllers;

use App\model\Category;
use App\model\Product;
use App\model\Supplier;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::where('delete_flg', '<>', 1)->get();

        $suppliers = Supplier::get();
        $categories = Category::get();

        return view('admin', [
            'products' => $products,
            'suppliers' => $suppliers,
            'categories' => $categories
        ]);
    }
    public function getProductById($id)
    {
        $products = Product::find($id);
        return response()->json($products);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $products = Validator::make($request->all(), [
            'name' => 'required|max:150',
            'description' => 'required|max:150',
            'image' => 'required|image|mimes:jpg,png,jpeg',
            'color' => 'required|integer',
            'supplier' => 'required|integer',
            'category' => 'required|integer',
            'amount' => 'required|max:12'
        ]);
        if ($products->fails()) {
            return redirect()->route('users.admin')
                ->withErrors($products)
                ->withInput();
        }
        try {
            $products = new Product();
            if ($request->get('id')) {
                $products = Product::find($request->get('id'));
            }
            $products->name = $request->get('name');
            Log::info('message');
            if ($request->hasFile('image')) {
                Log::info('message1');

                $file = $request->file('image');
                $filename  = time() . '.' . $file->getClientOriginalExtension();
                $destinationPath = 'img/product' . '/';
                $file->move($destinationPath, $filename);
                $path = 'img/product/' . $filename;
                $products->image = $path;
            } else {
                Log::info('message2');

                return $request;
                $products->image = '';
            }
            $products->icon = " ";
            $products->description = $request->get('description');
            $products->amount = $request->get('amount');
            $products->price = $request->get('price');
            $products->color = $request->get('color');
            $products->brands = " ";
            $products->delete_flg = "0";
            $products->supplier_id = $request->get('supplier');
            $products->categorie_id = $request->get('category');

            $products->save();
            $request->session()->flash('success', trans('create-success'));
            return redirect()->route('users.admin')->withInput();
        } catch (Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            return redirect()->route('users.admin')
                ->withErrors([trans('messages.system-error')])
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
    public function updateProduct(Request $request)
    {
        // Log::info($request);

        // if ($request->hasFile('image')) {
        //     $name = $request->image->getClientOriginalName();
        //     $request->file('image')->storeAs('/public', $name);
        // }
        $products = Validator::make($request->all(), [
            'name' => 'required|max:150',
            'description' => 'required|max:150',
            // 'image' => 'required|image|mimes:jpg,png,jpeg',
            'color' => 'required|integer',
            'supplier' => 'required|integer',
            'category' => 'required|integer',
            'amount' => 'required|max:12'
        ]);

        if ($products->fails()) {
            return redirect()->route('users.admin')
                ->withErrors($products)
                ->withInput();
        }
        try {

            $products = Product::find($request->idproductedit);
            $products->name = $request->name;


            if ($request->hasFile('image')) {
                $extension = $request->image->extension();
                $name = $request->image->getClientOriginalName();
                $request->file('image')->storeAs('/public', $name);
                $path = 'storage/' . $name;
                Log::info($name);
                $products->image = $path;
            }
            // $products->image = " ";
            $products->icon = " ";
            $products->description = $request->description;
            $products->amount = $request->amount;
            $products->price = $request->price;
            $products->color = $request->color;
            $products->brands = " ";
            $products->delete_flg = "0";
            $products->supplier_id = $request->supplier;
            $products->categorie_id = $request->category;

            $products->save();
            $request->session()->flash('success', trans('edit-success'));

            return response()->json($products);
        } catch (Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            return redirect()->route('users.admin')
                ->withErrors([trans('messages.system-error')])
                ->withInput();
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
