<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PizzaToppings;
use App\Models\PizzaCrust;
use App\Models\Customer;
use App\Models\CustomizedPizzaInfo;
use App\Models\CustomizedPizzaLine;
use Redirect;
use Validator;
use DB;
use View;
use Auth;
use Session;
use App\CustomPizzaCart;
use Mail;
use App\Mail\CustomPizza;
use App\Cart;

class CustomizedPizzaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $toppings = PizzaToppings::all();
        return view('custompizza.index', compact('toppings'));
    }

    public function getCart() {
        if (!Session::has('custompizzacart')) {
            return view('custompizza.custompizza_cart');
        }

        $pizzacrust = PizzaCrust::all();

        $vouchers = DB::table('vouchers')
        ->join('voucherlines','vouchers.id','voucherlines.voucher_id')
        ->join('customers','customers.id','voucherlines.customer_id')
        ->join('users','users.id','customers.user_id')
        ->select('vouchers.value','vouchers.name','vouchers.description','vouchers.image','vouchers.limit')
        ->orderBy('voucherlines.id','DESC')
        ->where('user_id',Auth::id())
        ->get();

        $minprice = 500;
        $maxprice = 1000;
        $oldCart = Session::get('custompizzacart');
        $cart = new CustomPizzaCart($oldCart);
        // dd($cart->img_path);
        return view('custompizza.custompizza_cart', ['items' => $cart->items, 'totalPrice' => $cart->totalPrice], compact('vouchers','pizzacrust','minprice','maxprice'));
    }

    public function getAddToCart(Request $request , $id){
        $product = PizzaToppings::find($id);
        $oldCart = Session::has('custompizzacart') ? $request->session()->get('custompizzacart'):null;
        $cart = new CustomPizzaCart($oldCart);
        $cart->add($product, $product->id);
        $request->session()->put('custompizzacart', $cart);
        Session::put('custompizzacart', $cart);
        $request->session()->save();
        return redirect()->back();
        // dd(Session::all());
    }

    public function getRemoveItem($id)
    {
        $oldCart = Session::has('custompizzacart') ? Session::get('custompizzacart') : null;
        $cart = new CustomPizzaCart($oldCart);
        $cart->removeItem($id);
        if (count($cart->items) > 0) {
            Session::put('custompizzacart',$cart);
        }else{
            Session::forget('custompizzacart');
        }
         return redirect()->route('custompizza.shoppingCart');
    }

    public function postCheckout(Request $request){
        // dd($request->all());
        $input = $request->all();
        // dd($input);
        if (!Session::has('custompizzacart')) {
            return redirect()->route('custompizza.shoppingCart');
        }
        $oldCart = Session::get('custompizzacart');
        $cart = new CustomPizzaCart($oldCart);
        $grandtotal = $cart->totalPrice;
        
        // dd($grandtotal);
        try {

            DB::beginTransaction();
           
            $discounts = $request->discount;
            $pizzacrust = $request->pizzacrust;
            $total = $grandtotal - $discounts;
            $customer =  Customer::where('user_id',Auth::id())->first();
            // dd($grandtotal);
            DB::table('customizedpizzainfo')->insert(
            [
                'customer_id' => $customer->id,
                'pizzacrust_id' => $pizzacrust,
                'ordered_date' => now(),
                'subtotal' => $grandtotal,
                'discount' => $discounts,
                'total' => $total,
            ]
            );
               
            $lastid = DB::getPdo()->lastInsertId();
            
            foreach($cart->items as $items){
                // dd($grandtotal);
                $pizzatoppings_id = $items['item']['id'];
                $qty = $items['qty'];
                $price = $items['price'];
                
                    DB::table('customizedpizzaline')->insert(
                    [
                    'customizedpizzainfo_id' => $lastid, 
                    'pizzatoppings_id' => $pizzatoppings_id, 
                    ]
                    );
                
            }

        }

            catch (\Exception $e) {
                // dd($e);
            DB::rollback();
             //dd($order);
            return redirect()->route('custompizza.index')->with('error', $e->getMessage());
        }
        DB::commit();

        $input = $request->all();
        $vouchertitle = $request->title;
        $cart = new Cart($oldCart);
        $grandtotal = $cart->totalPrice;
        $customer = Customer::join('users','users.id','customers.user_id')
            ->where('customers.id',1)
            ->select('customers.*','users.*')
            ->first();
        $pizzacrust = PizzaCrust::where('id',$request->pizzacrust)->select('*')->first();

        $custompizzainfo = CustomizedPizzaInfo::join('customizedpizzaline','customizedpizzainfo.id','customizedpizzaline.customizedpizzainfo_id')
            ->join('pizzacrust','pizzacrust.id','customizedpizzainfo.pizzacrust_id')
            ->join('pizzatoppings','pizzatoppings.id','customizedpizzaline.pizzatoppings_id')
            ->join('customers','customers.id','customizedpizzainfo.customer_id')
            ->where('customizedpizzainfo.id',$lastid)
            ->select('customizedpizzainfo.*','customizedpizzaline.*','pizzacrust.name as pizzacrust_name', 'pizzacrust.fee as pizzacrust_fee','pizzatoppings.*')
            ->get();
        
        $pizzarush = 'PizzaRush@gmail.com';
       
            $data = array(
                'pizzarush_email' => $pizzarush,
                'email'   =>  $customer->email,
                'name'   =>  $customer->name,
                'address'   =>  $customer->address,
                'gender'   =>  $customer->gender,
                'phone'   =>   $customer->phone,
                'cut_type' => $request->cut_type,
                'ordered_date' => now(),
                'orderinfo_id' => $lastid,
                'sub_total' => $grandtotal,
                'discount' => $discounts,
                'grand_price' => $total,
                'custompizzainfo' => $custompizzainfo,
                'voucher_title' => $vouchertitle,
                'pizzacrust_name' => $pizzacrust->name,
                'pizzacrust_fee' => $pizzacrust->fee,
            );
            Mail::to($customer->email)->send(new CustomPizza($data));
        
        Session::forget('custompizzacart');

        return view('pizza.donepurchasing');
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
