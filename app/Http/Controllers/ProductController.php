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
        $products = Product::where('delete_flg', '<>', 1)->get();
        // $products = Product::where('delete_flg', '<>', 1)->get();
        $counted = $products->countBy('color');
        $counted->all();
        $query = Product::distinct()->get('color');
        $arrayColor = [
            "",
            "red",
            "yellow",
            "blue"
        ];
        $categorys = Category::all('name');
        // $array = ['0'=>'Red'];
        // return $data;s
        return view('category', [
            'products' => $products,
            'categorys' => $categorys,
            'querys' => $query,
            'arrayColor' => $arrayColor,
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
