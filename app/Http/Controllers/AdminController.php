<?php

namespace App\Http\Controllers;

use App\model\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
        $color = ['red', 'blue', 'yellow'];

        return view('admin', [
            'products' => $products,
            'arcolor' => $color
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
        try {
            $register = new Product();
            if ($request->get('id')) {
                $register = Product::find($request->get('id'));
            }
            $register->name = $request->get('name');
            $register->image = " ";
            $register->icon = " ";
            $register->description = $request->get('description');
            $register->amount = $request->get('amount');
            $register->price = $request->get('price');
            $register->color = $request->get('color');
            $register->brands = $request->get('brand');
            $register->delete_flg = "0";
            $register->supplier_id = $request->get('supplier');
            $register->categorie_id = $request->get('category');

            $register->save();
            return redirect()->route('admin')->withInput();
        } catch (Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            return redirect()->route('admin')
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
