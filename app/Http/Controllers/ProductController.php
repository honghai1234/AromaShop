<?php

namespace App\Http\Controllers;

use App\model\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Model\Product;
use App\model\Supplier;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Model\User;
use Exception;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countBy = Product::where('delete_flg', '<>', 1)->get();
        $products = Product::where('delete_flg', '<>', 1)->paginate(6);
        $counted = $countBy->countBy('color');
        $counted->all();
        $query = Product::distinct()->get('color');
        $suppliers = Supplier::all('id', 'name');
        $categorys = Category::all('name', 'id');
        return view('category', [
            'products' => $products,
            'categorys' => $categorys,
            'suppliers' => $suppliers,
            'querys' => $query,
            'counted' => $counted
        ]);
    }
    public function show3()
    {
        $countBy = Product::where('delete_flg', '<>', 1)->get();
        $products = Product::where('delete_flg', '<>', 1)->paginate(3);
        $counted = $countBy->countBy('color');
        $counted->all();
        $query = Product::distinct()->get('color');
        $suppliers = Supplier::all('id', 'name');
        $categorys = Category::all('name', 'id');
        return view('category', [
            'products' => $products,
            'categorys' => $categorys,
            'suppliers' => $suppliers,
            'querys' => $query,
            'counted' => $counted
        ]);
    }

    public function show9()
    {
        $countBy = Product::where('delete_flg', '<>', 1)->get();
        $products = Product::where('delete_flg', '<>', 1)->paginate(9);
        $counted = $countBy->countBy('color');
        $counted->all();
        $query = Product::distinct()->get('color');
        $suppliers = Supplier::all('id', 'name');
        $categorys = Category::all('name', 'id');
        return view('category', [
            'products' => $products,
            'categorys' => $categorys,
            'suppliers' => $suppliers,
            'querys' => $query,
            'counted' => $counted
        ]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

    public function searchCategory(Request $request)
    {
        $product = Product::query();
        if ($request->name) {
            $product->where('name', 'LIKE', '%' . $request->name . '%');
        }
        if ($request->category) {
            if ($request->category != 0) {
                $product->where('categorie_id', $request->category);
            }
        }
        if ($request->color) {
            if ($request->color != 0) {
                $product->where('color', $request->color);
            }
        }
        if ($request->supplier) {
            if ($request->supplier != 0) {
                $product->where('supplier_id', $request->supplier);
            }
        }
        $products =  $product->where('delete_flg', '<>', 1)->paginate(3);
        return response()->json($products);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        try {
            DB::beginTransaction();
            $model = new Product();
            $model = $model->find($id);
            $model->delete_flg = "1";
            $model->save();
            DB::commit();
            return redirect()->route('users.admin');
        } catch (Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());

            return redirect()->route('users.admin')
                ->withErrors([trans('messages.system-error')])
                ->withInput();
        }
    }
}
