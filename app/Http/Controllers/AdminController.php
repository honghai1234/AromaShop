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
    public function searchajax(Request $request)
    {

        Log::info($request->text);
        $product = Product::query();

        if ($request->has('search')) {
            $product->where('name', 'LIKE', '%' . $request->text . '%');
        }

        return response()->json($product);
    }

    public function search(Request $request)
    {
        $categories = Category::get();
        $suppliers = Supplier::get();
        $query = Product::distinct()->get('color');
        $product = Product::query();

        if ($request->has('search')) {
            $product->where('name', 'LIKE', '%' . $request->search . '%');
        }

        if ($request->has('color')) {
            if ($request->color != 0) {
                $product->where('color', $request->color);
            }
        }

        if ($request->has('category')) {
            if ($request->category != 0) {
                $product->where('categorie_id', $request->category);
            }
        }
        $products =  $product->get();
        return view('admin', [
            'categories' => $categories,
            'suppliers' => $suppliers,
            'querys' => $query,
            'products' => $products
        ]);
    }
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
        $query = Product::distinct()->get('color');
        return view('admin', [
            'products' => $products,
            'suppliers' => $suppliers, 'querys' => $query,
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
        $productvalidator = Validator::make($request->all(), [
            'name' => 'required|max:150',
            'description' => 'required|max:150',
            'image' => 'required|image|mimes:jpg,png,jpeg|max:500000',
            'color' => 'required|integer|exists:products,color',
            'supplier' => 'required|integer|exists:products,supplier_id',
            'category' => 'required|integer|exists:products,categorie_id',
            'amount' => 'required|integer'
        ]);

        if ($productvalidator->fails()) {
            return redirect()->route('users.admin')
                ->withErrors($productvalidator)
                ->withInput();
        }

        try {
            $product = new Product();
            if ($request->get('id')) {
                $product = Product::find($request->get('id'));
            }
            $product->name = $request->get('name');
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename  = time() . '.' . $file->getClientOriginalExtension();
                $destinationPath = 'img/product' . '/';
                $file->move($destinationPath, $filename);
                $path = 'img/product/' . $filename;
                $product->image = $path;
            } else {
                // return $request;
                $product->image = '';
            }
            $product->icon = " ";
            $product->description = $request->get('description');
            $product->amount = $request->get('amount');
            $product->price = $request->get('price');
            $product->color = $request->get('color');
            $product->brands = " ";
            $product->delete_flg = "0";
            $product->supplier_id = $request->get('supplier');
            $product->categorie_id = $request->get('category');
            $product->save();
            $request->session()->flash('success', trans('create-success'));
            return redirect()->route('users.admin');
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
        $productvali = Validator::make($request->all(), [
            'name' => 'required|max:150',
            'description' => 'required|max:150',
            'image' => 'required|image|mimes:jpg,png,jpeg|max:500000',
            'color' => 'required|integer|exists:products,color',
            'supplier' => 'required|integer|exists:products,supplier_id',
            'category' => 'required|integer|exists:products,categorie_id',
            'amount' => 'required|integer'
        ]);

        if ($productvali->fails()) {
            // return back()->route('users.admin')->withErrors($productvali)->withInput();

            return response()->json([
                'errors' => $productvali->errors()
            ], 500);
        }

        try {
            $product = Product::find($request->id);
            $product->name = $request->name;
            if ($request->hasFile('image')) {
                $extension = $request->image->extension();
                $name = $request->image->getClientOriginalName();
                $request->file('image')->storeAs('/public', $name);
                $path = 'storage/' . $name;
                Log::info($name);
                $product->image = $path;
            }
            $product->icon = "";
            $product->description = $request->description;
            $product->amount = $request->amount;
            $product->price = $request->price;
            $product->color = $request->color;
            $product->brands = "";
            $product->delete_flg = "0";
            $product->supplier_id = $request->supplier;
            $product->categorie_id = $request->category;
            $product->save();
            $request->session()->flash('success', trans('edit-success'));
            return response()->json('success');
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
