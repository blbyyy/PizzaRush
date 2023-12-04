<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pizza;
use App\Models\Voucher;
use App\Models\PizzaCrust;
use App\Models\PizzaToppings;
use App\Models\Customer;
use App\Models\Orderinfo;
use App\Models\Comment;
use App\Mail\Resibo;
use View;
use DB;
use File;
use Session;
use Mail;
use Auth;
use Redirect;
use App\Cart;

use Illuminate\Support\Facades\Storage;

class PizzaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function home()
    {
        $bestseller = DB::table('pizzas')
        ->join('comments','comments.pizza_id','pizzas.id')
        ->select('pizzas.id','pizzas.name','pizzas.description','pizzas.fee','pizzas.image',DB::raw('ROUND(AVG(rating)) as rating'))
        ->groupBy('pizzas.id','pizzas.name','pizzas.description','pizzas.fee','pizzas.image')
        ->orderBy('pizzas.id','DESC')
        ->get();
        $pizza = Pizza::all();
        $crust = PizzaCrust::all();
        $toppings = PizzaToppings::all();
        return View::make('layouts.home',compact('pizza', 'crust', 'toppings','bestseller'));
    }
    public function services()
    {
        $pizza = Pizza::all();
        $crust = PizzaCrust::all();
        $toppings = PizzaToppings::all();
        return View::make('layouts.services',compact('pizza', 'crust', 'toppings'));
    }
    public function pizzacount()
    {
        $vouchercount = Voucher::count();
        // dd($vouchercount);
        return View::make('layouts.footer',compact('vouchercount'));
    }
    public function index()
    {
        //
        return View::make('pizza.pizzas');
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
            $pizzas = new Pizza();
            $pizzas->name = $request->name;
            $pizzas->description = $request->description;
            $pizzas->fee = $request->fee;

            $files = $request->file('image');
            $pizzas->image = 'images/'.time().'-'.$files->getClientOriginalName();

            $pizzas->save();

            $data = array('status' => 'saved');
            Storage::put('public/images/'.time().'-'.$files->getClientOriginalName(), file_get_contents($files));

            return response()->json(["success" => "Pizza Created Successfully.", "Pizza" => $pizzas, "status" => 200]);
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
        $pizzass = Pizza::where('id', $id)->first();

        $comments = DB::table('comments')
        ->join('customers','customers.id','comments.customer_id')
        ->select('customers.*','comments.*')
        ->where('pizza_id', $id)
        ->get();

        $pizza = DB::table('comments')
        ->join('pizzas','pizzas.id','comments.pizza_id')
        ->select('pizzas.id','pizzas.created_at','pizzas.name as pizza_name','pizzas.fee','pizzas.description','pizzas.image',DB::raw('ROUND(AVG(rating)) as rating'))
        ->groupBy('pizzas.id','pizza_name','pizzas.fee','pizzas.description','pizzas.image','pizzas.created_at')
        ->where('pizzas.id', $id)
        ->first();

        $pizzas = $id;
        // dd($pizza);
        return View::make('pizza.pizza-profile',compact('pizza', 'comments', 'pizzas','pizzass'));
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
        $pizza = Pizza::Find($id);
        return response()->json($pizza);
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
        $pizza = Pizza::find($id);
        $pizza->name = $request->name;
        $pizza->description = $request->description;
        $pizza->fee = $request->fee;
        $pizza->save();

        return response()->json($pizza);
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
        $pizza = Pizza::findOrFail($id);

        if (File::exists("storage/".$pizza->image)) {
            File::delete("storage/".$pizza->image);
        }

        $pizza->delete();

        $data = array('success' =>'deleted','code'=>'200');
        return response()->json($data);
    }

    public function getPizzaAll(Request $request){
        //if ($request->ajax()){
            $pizzas = Pizza::orderBy('id')->get();
            return response()->json($pizzas);
         //}
    }

    public function PizzaIndex(){
        $pizza = Pizza::all();

        $vouchers = DB::table('vouchers')
        ->join('voucherlines','vouchers.id','voucherlines.voucher_id')
        ->join('customers','customers.id','voucherlines.customer_id')
        ->select('vouchers.name','vouchers.description','vouchers.value','customers.*')
        ->orderBy('voucherlines.id','DESC')
        ->get();

        // dd($pizza);
        return view('pizza.index', compact('vouchers','pizza'));
    }

    public function getCart() {
        if (!Session::has('cart')) {
            return view('pizza.pizza_cart');
        }

        $vouchers = DB::table('vouchers')
        ->join('voucherlines','vouchers.id','voucherlines.voucher_id')
        ->join('customers','customers.id','voucherlines.customer_id')
        ->join('users','users.id','customers.user_id')
        ->select('voucherlines.status','vouchers.id','vouchers.value','vouchers.name','vouchers.description','vouchers.image','vouchers.limit')
        ->orderBy('voucherlines.id','DESC')
        ->where('user_id',Auth::id())
        ->get();
       
        $minprice = 500;
        $maxprice = 1000;
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
    
        return view('pizza.pizza_cart', ['items' => $cart->items, 'totalPrice' => $cart->totalPrice], compact('vouchers','minprice','maxprice'));
    }

    public function getAddToCart(Request $request , $id){
        $product = Pizza::find($id);
        $oldCart = Session::has('cart') ? $request->session()->get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->add($product, $product->id);
        $request->session()->put('cart', $cart);
        Session::put('cart', $cart);
        $request->session()->save();
        return redirect()->back()->with('Success', ' Pizza Addedd');
    }

    public function getRemoveItem($id)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);
        if (count($cart->items) > 0) {
            Session::put('cart',$cart);
        }else{
            Session::forget('cart');
        }
         return redirect()->route('pizza.shoppingCart');
    }

    public function postCheckout(Request $request){
        // dd($request->all());
        $input = $request->all();
        // dd($input);
        if (!Session::has('cart')) {
            return redirect()->route('pizza.shoppingCart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $grandtotal = $cart->totalPrice;
        
        // dd($grandtotal);
        try {

            DB::beginTransaction();
           
            $voucherid = $request->voucher_id;
            $discounts = $request->discount;
            $total = $grandtotal - $discounts;
            $customer =  Customer::where('user_id',Auth::id())->first();
            // dd($voucherid);
            
            DB::table('pizzaorderinfo')->insert(
            [
                'customer_id' => $customer->id, 
                'cut_type' => $request->cut_type,
                'ordered_date' => now(),
                'price' => $grandtotal,
                'discount' => $discounts,
                'grand_price' => $total,
            ]
            );
               
            $lastid = DB::getPdo()->lastInsertId();
            
            foreach($cart->items as $items){
                // dd($grandtotal);
                $pizza_id = $items['item']['id'];
                $qty = $items['qty'];
                $price = $items['price'];
                
                    DB::table('pizzaorderline')->insert(
                    [
                    'pizzaorderinfo_id' => $lastid, 
                    'pizza_id' => $pizza_id, 
                    'quantity' => $qty,
                    ]
                    );
                
            }

            DB::table('voucherlines')
            ->where('voucherlines.customer_id',$customer->id)
            ->update([
            'status' => 'Used',
            ]);

        }

            catch (\Exception $e) {
                // dd($e);
            DB::rollback();
             //dd($order);
            return redirect()->route('pizza.shoppingCart')->with('error', $e->getMessage());
        }
        DB::commit();

        $input = $request->all();
        $vouchertitle = $request->title;
        $cart = new Cart($oldCart);
        $grandtotal = $cart->totalPrice;
        $customer = Customer::where('user_id',Auth::id())->select('*')->first();
        $pizza = Orderinfo::join('pizzaorderline','pizzaorderinfo.id','pizzaorderline.pizzaorderinfo_id')
            ->join('pizzas','pizzas.id','pizzaorderline.pizza_id')
            ->join('customers','customers.id','pizzaorderinfo.customer_id')
            ->where('pizzaorderinfo.id',$lastid)->select('pizzaorderinfo.*','pizzaorderline.*','pizzas.*')
            ->get();

            $pizzaemail = 'pizzarush@gmail.com';

            $data = array(
                'email'   =>  $customer->user->email,
                'name'   =>  $customer->name,
                // 'lname'   =>  $customer->lname,
                'address'   =>  $customer->address,
                'gender'   =>  $customer->gender,
                'phone'   =>   $customer->phone,
                'cut_type' => $request->cut_type,
                'ordered_date' => now(),
                'orderinfo_id' => $lastid,
                'sub_total' => $grandtotal,
                'discount' => $discounts,
                'grand_price' => $total,
                'pizza' => $pizza,
                'voucher_title' => $vouchertitle,
                'pizzaemail' => $pizzaemail,
            );
            Mail::to($customer->user->email)->send(new Resibo($data));
        
        Session::forget('cart');

        return view('pizza.donepurchasing');
}

public function store1(Request $request)
    {
        $comments = app('profanityFilter')->filter($request->comment);
        $customer =  Customer::where('user_id',Auth::id())->first();

        $comment = new Comment();
        $comment->customer_id = $customer->id;
        $comment->pizza_id = $request->pizza_id;
        $comment->comment_date = now();
        $comment->comment = $comments;
        $comment->rating = $request->rating;

        $comment->save();
        return redirect()->back()->with('success','New Rating Added');
    }

}
