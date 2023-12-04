<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Customer;
use App\Models\Orderinfo;

use View;
use Redirect;
use Validator;
use DB;

use Spatie\Searchable\Search;

class TransactionHistoryController extends Controller
{
    //
    public function PizzaCustomerName()
        {
            return view::make('PizzaHistorySearch.pizzacustomername');
        }
       
    public function PizzaSearchCustomer(Request $request)
        {   
            $searchname = $request->input('name');
     
            $finalsearch = (new Search())
                        ->registerModel(Customer::class, 'name')
                        ->perform($searchname);
    
            return view('PizzaHistorySearch.pizzacustomername', compact('searchname', 'finalsearch'));
        }
    
    public function PizzaCustomerHistory($id)
        {
            $order = DB::table('pizzaorderline')
                            ->join('pizzaorderinfo','pizzaorderinfo.id','pizzaorderline.pizzaorderinfo_id')
                            ->join('customers','customers.id','pizzaorderinfo.customer_id')
                            ->join('users','users.id','customers.user_id')
                            ->join('pizzas','pizzas.id','pizzaorderline.pizza_id')
                            ->select('users.*','customers.*','pizzas.name as Pname','pizzas.description as Pdescription'
                                    ,'pizzas.fee as Pfee','pizzas.image as Pimage','pizzaorderinfo.*','pizzaorderline.*')
                            ->where('customer_id',$id)
                            ->get();
            // dd($order);

            $orders = DB::table('pizzaorderline')
                            ->join('pizzaorderinfo','pizzaorderinfo.id','pizzaorderline.pizzaorderinfo_id')
                            ->join('customers','customers.id','pizzaorderinfo.customer_id')
                            ->join('users','users.id','customers.user_id')
                            ->join('pizzas','pizzas.id','pizzaorderline.pizza_id')
                            ->select('users.*','customers.*','pizzas.name as Pname','pizzas.description as Pdescription'
                                    ,'pizzas.fee as Pfee','pizzas.image as Pimage','pizzaorderinfo.*','pizzaorderline.*')
                            ->where('customer_id',$id)
                            ->first();
    
         return view('PizzaHistorySearch.pizzacustomersearch', compact('order', 'orders',));
        }

    public function CustomizeCustomerHistory($id)
        {
            $customorder = DB::table('customizedpizzaline')
                            ->join('customizedpizzainfo','customizedpizzainfo.id','customizedpizzaline.customizedpizzainfo_id')
                            ->join('pizzatoppings','pizzatoppings.id','customizedpizzaline.pizzatoppings_id')
                            ->join('customers','customers.id','customizedpizzainfo.customer_id')
                            ->join('users','users.id','customers.user_id')
                            ->join('pizzacrust','pizzacrust.id','customizedpizzainfo.pizzacrust_id')
                            ->select('users.*','customers.*','pizzacrust.name as PCname','pizzatoppings.name as PTname'
                                    ,'customizedpizzainfo.*','customizedpizzaline.*')
                            ->where('customer_id',$id)
                            ->get();

            $customorders = DB::table('customizedpizzaline')
                            ->join('customizedpizzainfo','customizedpizzainfo.id','customizedpizzaline.customizedpizzainfo_id')
                            ->join('pizzatoppings','pizzatoppings.id','customizedpizzaline.pizzatoppings_id')
                            ->join('customers','customers.id','customizedpizzainfo.customer_id')
                            ->join('users','users.id','customers.user_id')
                            ->join('pizzacrust','pizzacrust.id','customizedpizzainfo.pizzacrust_id')
                            ->select('users.*','customers.*','pizzacrust.name as PCname','pizzatoppings.name as PTname'
                                    ,'customizedpizzainfo.*','customizedpizzaline.*')
                            ->where('customer_id',$id)
                            ->first();
    
         return view('PizzaHistorySearch.customizecustomersearch', compact('customorder', 'customorders',));
        }
}
