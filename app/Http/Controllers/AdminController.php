<?php

namespace App\Http\Controllers;

use App\model\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:150',
            'description' => 'required|max:150',
            'image' => 'required|image|mimes:jpg,png,jpeg|max:2048|',
            'color' => 'required|integer',
            'brand' => 'required|integer',
            'supplier' => 'required|integer',
            'category' => 'required|integer',
            'amount' => 'required|max:12'
        ]);
        if ($validator->fails()) {
            return redirect()->route('users.admin')
                ->withErrors($validator)
                ->withInput();
        }
        try {
            $register = new Product();
            if ($request->get('id')) {
                $register = Product::find($request->get('id'));
            }
            $register->name = $request->get('name');
            $register->image = $request->get('image');
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
            $request->session()->flash('success', trans('messages.create-success'));
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
