@include('layouts.main')
<style>
.row
{
background-color: rgb(255, 255, 255);
} 
</style>
<body>
    <br>
    <h1 style="text-align: center;">List of Most Used Pizza Toppings</h1>
    <div class="container">
    @if(empty($toppingsChart))
        <div id="app2"></div>
    @else
        <div class="row">
            {!! $toppingsChart->container() !!}
        </div>
             {!! $toppingsChart->script() !!}
     @endif   
    </div>
</body>

