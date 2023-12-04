@include('layouts.main')
<style>
.row
{
background-color: rgb(255, 255, 255);
} 
</style>
<body>
    <br>
    <h1 style="text-align: center;">List of Pizzas Consistently Purchased</h1>
    @if(empty($pizzaChart))
        <div id="app2"></div>
    @else
        <div class="row">
            {!! $pizzaChart->container() !!}
        </div>
             {!! $pizzaChart->script() !!}
     @endif   
</body>

