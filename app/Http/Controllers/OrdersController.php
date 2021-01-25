<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Order;
use App\Models\OrderDetails;
use DB;


class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return 'AHad';
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
        
       $request->validate([
            'custName'           => 'required',
            'custAddress'        => 'required',
            'grandTotal'         => 'required',
            'invoiceNotes'       => 'required',
            'percentageRate'     => 'required',
            'subTotal'           => 'required',
            'taxAmmount'         => 'required',
            'invoiceNotes'       => 'required',
            'ammountDueElement'  => 'required',
            'ammountPaidElement' => 'required',
       ]);
       try{
           $order = Order::create([
            'sub_total'    => $request->subTotal,
            'tax_rate'     => $request->percentageRate,
            'tax_ammount'  => $request->taxAmmount,
            'total'        => $request->grandTotal,
            'ammount_paid' => $request->ammountPaidElement,
            'ammount_due'  => $request->ammountDueElement,
            'notes'        => $request->invoiceNotes,
            'cust_name'    => $request->custName,
            'cust_address' => $request->custAddress,
       ]);
       foreach($request->items as $item){
            OrderDetails::create([
                'order_id'      => $order->id,
                'item_number'   => $item['item_number'],
                'item_name'     => $item['item_name'],
                'price'         => $item['price'],
                'quantity'      => $item['quantity'],
                'product_total' => $item['product_total'],
            ]);
       }

       return response()->json([
            'status'  => true,
            'orderId' => $order->id,
            'message' => 'Invoice Create successFully'
        ]);

       }catch(\Exception $e){

        return response()->json([
            'message' => $e->getMessage()
        ]);

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

    public function generatePDF($id){
        $orders = DB::table('orders')
            ->join('order_details', 'orders.id', '=', 'order_details.order_id')
            ->where('orders.id', $id)
            ->select('orders.id', 'orders.sub_total', 'orders.tax_rate', 'orders.tax_ammount', 'orders.total', 'orders.ammount_paid', 'orders.ammount_due', 'orders.cust_name', 'orders.cust_address' , 'orders.created_at')
            ->first();

        $ordersDetail = DB::table('orders')
            ->join('order_details', 'orders.id', '=', 'order_details.order_id')
            ->where('orders.id', $id)
            ->select('order_details.item_number', 'order_details.item_name', 'order_details.price', 'order_details.quantity', 'order_details.product_total')
            ->get();
        return view('invoicePrint', compact('orders', 'ordersDetail'));
    }
}
