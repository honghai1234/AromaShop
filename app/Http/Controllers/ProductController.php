<?php

namespace App\Http\Controllers;

use App\model\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Model\Product;
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

        $categorys = Category::all('name', 'id');
        // $array = ['0'=>'Red'];
        // return $data;s
        return view('category', [
            'products' => $products,
            'categorys' => $categorys,
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
    public function searchNav(Request $request)
    {
        Log::info($request);
        Log::info($request->category);

        $product = Product::query();
        if ($request->has('search')) {
            $product->where('name', 'LIKE', '%' . $request->text . '%');
        }
        // if ($request->has('color')) {
        //     if ($request->color != 0) {
        //         $product->where('supplier_id', $request->supplier);
        //     }
        // }
        // if ($request->has('color')) {
        //     if ($request->color != 0) {
        //         $product->where('color', $request->color);
        //     }
        // }
        $products =  $product->get();
        // return view('admin', [
        //     'products' => $products
        // ]);
        return response()->json($products);
    }
    public function searchCategory(Request $request)
    {
        Log::info($request);
        Log::info($request->category);

        $product = Product::query();
        if ($request->category) {
            $product->where('categorie_id', $request->category);
        }

        $products =  $product->get();

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
