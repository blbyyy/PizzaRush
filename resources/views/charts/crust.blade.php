@include('layouts.main')
<style>
.row
{
background-color: rgb(255, 255, 255);
} 
</style>
<body>
    <br>
    <h1 style="text-align: center;">List of Most Used Pizza Crust</h1>
    <div class="container">
    @if(empty($crustChart))
        <div id="app2"></div>
    @else
        <div class="row">
            {!! $crustChart->container() !!}
        </div>
             {!! $crustChart->script() !!}
     @endif   
    </div>
</body>

