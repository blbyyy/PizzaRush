<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Charts\PizzaChart;
use App\Charts\OrderDateChart;
use App\Charts\SalesChart;
use App\Charts\CrustChart;
use App\Charts\ToppingsChart;
use DB;

class ChartController extends Controller
{
public function index() 
{
        $pizzas = DB::table('pizzaorderline')
        ->join('pizzas','pizzas.id','pizzaorderline.pizza_id')
        ->groupBy('pizzas.name')
        ->pluck(DB::raw('count(pizzas.name) as total'),'pizzas.name')
        ->toArray();

        // dd($pizzass);
    
        $pizzaChart = new PizzaChart;

        $dataset = $pizzaChart->labels(array_keys($pizzas));
        $dataset = $pizzaChart->dataset('Number of Sold', 'bar', array_values($pizzas));
        $dataset = $dataset->backgroundColor(collect(['#7158e2','#3ae374', '#ff3838',"#FF851B", "#7FDBFF", "#B10DC9", "#FFDC00", "#001f3f", "#39CCCC", "#01FF70", "#85144b", "#F012BE", "#3D9970", "#111111", "#AAAAAA"]));
        $pizzaChart->options([
            'responsive' => true,

            'tooltips' => ['enabled'=> true],
            'title' => [
                'display'=> true,
                'text' => 'Total of Pizza Sold'
              ],
            'aspectRatio' => 1,
            'scales' => [
                'yAxes'=> [[
                            'display'=>true,
                            'ticks'=> ['beginAtZero'=> true],
                            'gridLines'=> ['display'=> true],
                          ]],
                'xAxes'=> [[
                            'categoryPercentage'=> 0.8,
                            'barPercentage' => 1,
                            'ticks' => ['beginAtZero' => false],
                            'gridLines' => ['display' => true],
                            'display' => true

                          ]],
            ],
     
        ]);
        
    return view('charts.index', compact('pizzaChart') );
}

public function pizzadate(Request $request) 
{
  $sales = DB::table('pizzaorderline')
      ->join('pizzaorderinfo','pizzaorderinfo.id','pizzaorderline.pizzaorderinfo_id')
      ->join('pizzas','pizzas.id','pizzaorderline.pizza_id')
      ->groupBy('pizzas.name')
      ->whereBetween('pizzaorderinfo.ordered_date', [$request->firstdate, $request->seconddate])
      ->pluck(DB::raw('count(pizzas.name) as total'),'pizzas.name')
      ->toArray();

  $orderdateChart = new OrderDateChart;

  $dataset = $orderdateChart->labels(array_keys($sales));
  $dataset = $orderdateChart->dataset('Pizza', 'bar', array_values($sales));
  $dataset = $dataset->backgroundColor(collect(['#7158e2','#3ae374', '#ff3838',"#FF851B", "#7FDBFF", "#B10DC9", "#FFDC00", "#001f3f", "#39CCCC", "#01FF70", "#85144b", "#F012BE", "#3D9970", "#111111", "#AAAAAA"]));
  $orderdateChart->options([
      'responsive' => true,
      'tooltips' => ['enabled'=> true],
      'title' => [
          'display'=> true,
          'text' => 'Total of Pizza Sold in that Date'
        ],
      'aspectRatio' => 1,
      'scales' => [
            'yAxes'=> [[
                      'display'=>true,
                      'ticks'=> ['beginAtZero'=> true],
                      'gridLines'=> ['display'=> true],
                    ]],
            'xAxes'=> [[
                      'categoryPercentage'=> 0.8,
                      'barPercentage' => 1,
                      'ticks' => ['beginAtZero' => false],
                      'gridLines' => ['display' => true],
                      'display' => true

                    ]],
      ],

  ]);
  
  return view('charts.pizza', compact('orderdateChart') );
  }

  public function sales(Request $request) 
  {
    $sales = DB::table('pizzaorderinfo')
          ->groupBy('ordered_date')
          ->whereBetween('ordered_date', [$request->firstdate, $request->seconddate])
          ->pluck(DB::raw('SUM(grand_price) as total'),'ordered_date')
          ->toArray();

    // dd($sales);
  
    $totalsales = DB::table('pizzaorderinfo')
          ->select(DB::raw('SUM(pizzaorderinfo.grand_price) as total'))
          ->whereBetween('pizzaorderinfo.ordered_date', [$request->firstdate, $request->seconddate])
          ->first();
  
    // dd($totalsales);
  
    $salesChart = new SalesChart;
  
    $dataset = $salesChart->labels(array_keys($sales));
    $dataset = $salesChart->dataset('Sales', 'bar', array_values($sales));
    $dataset = $dataset->backgroundColor(collect(['#7158e2','#3ae374', '#ff3838',"#FF851B", "#7FDBFF", "#B10DC9", "#FFDC00", "#001f3f", "#39CCCC", "#01FF70", "#85144b", "#F012BE", "#3D9970", "#111111", "#AAAAAA"]));
    $salesChart->options([
        'responsive' => true,
        'tooltips' => ['enabled'=> true],
        'title' => [
            'display'=> true,
            'text' => 'Total of Pizza Sales in that date'
          ],
        'aspectRatio' => 1,
        'scales' => [
              'yAxes'=> [[
                        'display'=>true,
                        'ticks'=> ['beginAtZero'=> true],
                        'gridLines'=> ['display'=> true],
                      ]],
              'xAxes'=> [[
                        'categoryPercentage'=> 0.8,
                        'barPercentage' => 1,
                        'ticks' => ['beginAtZero' => false],
                        'gridLines' => ['display' => true],
                        'display' => true
  
                      ]],
        ],
  
    ]);
    
    return view('charts.sales', compact('salesChart','totalsales') );
    }
  
    public function crust() 
    {
            $crust = DB::table('customizedpizzainfo')
            ->join('pizzacrust','pizzacrust.id','customizedpizzainfo.pizzacrust_id')
            ->groupBy('pizzacrust.name')
            ->pluck(DB::raw('count(pizzacrust.name) as total'),'pizzacrust.name')
            ->toArray();
    
            // dd($pizzass);
        
            $crustChart = new CrustChart;
    
            $dataset = $crustChart->labels(array_keys($crust));
            $dataset = $crustChart->dataset('Number of Sold', 'bar', array_values($crust));
            $dataset = $dataset->backgroundColor(collect(['#7158e2','#3ae374', '#ff3838',"#FF851B", "#7FDBFF", "#B10DC9", "#FFDC00", "#001f3f", "#39CCCC", "#01FF70", "#85144b", "#F012BE", "#3D9970", "#111111", "#AAAAAA"]));
            $crustChart->options([
                'responsive' => true,
    
                'tooltips' => ['enabled'=> true],
                'title' => [
                    'display'=> true,
                    'text' => 'Total of Pizza Sold'
                  ],
                'aspectRatio' => 1,
                'scales' => [
                    'yAxes'=> [[
                                'display'=>true,
                                'ticks'=> ['beginAtZero'=> true],
                                'gridLines'=> ['display'=> true],
                              ]],
                    'xAxes'=> [[
                                'categoryPercentage'=> 0.8,
                                'barPercentage' => 1,
                                'ticks' => ['beginAtZero' => false],
                                'gridLines' => ['display' => true],
                                'display' => true
    
                              ]],
                ],
         
            ]);
            
        return view('charts.crust', compact('crustChart') );
    }
  
    public function toppings() 
    {
            $toppings = DB::table('customizedpizzaline')
            ->join('pizzatoppings','pizzatoppings.id','customizedpizzaline.pizzatoppings_id')
            ->groupBy('pizzatoppings.name')
            ->pluck(DB::raw('count(pizzatoppings.name) as total'),'pizzatoppings.name')
            ->toArray();
    
            // dd($pizzass);
        
            $toppingsChart = new ToppingsChart;
    
            $dataset = $toppingsChart->labels(array_keys($toppings));
            $dataset = $toppingsChart->dataset('Number of Sold', 'bar', array_values($toppings));
            $dataset = $dataset->backgroundColor(collect(['#7158e2','#3ae374', '#ff3838',"#FF851B", "#7FDBFF", "#B10DC9", "#FFDC00", "#001f3f", "#39CCCC", "#01FF70", "#85144b", "#F012BE", "#3D9970", "#111111", "#AAAAAA"]));
            $toppingsChart->options([
                'responsive' => true,
    
                'tooltips' => ['enabled'=> true],
                'title' => [
                    'display'=> true,
                    'text' => 'Total of Pizza Sold'
                  ],
                'aspectRatio' => 1,
                'scales' => [
                    'yAxes'=> [[
                                'display'=>true,
                                'ticks'=> ['beginAtZero'=> true],
                                'gridLines'=> ['display'=> true],
                              ]],
                    'xAxes'=> [[
                                'categoryPercentage'=> 0.8,
                                'barPercentage' => 1,
                                'ticks' => ['beginAtZero' => false],
                                'gridLines' => ['display' => true],
                                'display' => true
    
                              ]],
                ],
         
            ]);
            
        return view('charts.toppings', compact('toppingsChart') );
    }


}
