<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::get();
        $total = Product::renderTotalValue($products);

        // Sort by date/time submitted, latest on "top"
        usort($products, function($a, $b) {
            return strtotime($b->timestamp) - strtotime($a->timestamp);
        });

        if ( \Request::ajax() ) {
            $html = \View::make('products._table', [ 'products'=>$products ])->render();
            return response()->json([
                'html'=>$html,
                'total'=>$total,
            ]);
        } else {
            return \View::make('products.index', [ 
                'products'=>$products,
                'total'=>$total,
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'pname' => 'required',
            'qty' => 'required|integer|min:0',
            'price' => 'required|integer|min:1',
        ]);
        $obj = Product::create( $request->only('pname','qty','price') );
        return response()->json(['obj'=>$obj]);
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
