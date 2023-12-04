@include('layouts.main')
<style>
body {
  background: rgb(231, 236, 237);
  
  -webkit-font-smoothing: antialiased;
}

/* - - - - - RATINGS */
.rating {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  width: 150px;
  height: 30px;
  padding: 5px 10px;
  margin: auto;
  border-radius: 30px;
  background: #FFF;
  display: block;
  overflow: hidden;
  
  box-shadow: 0 1px #CCC,
              0 5px #DDD,
              0 9px 6px -3px #999;
  
  unicode-bidi: bidi-override;
  direction: rtl;
}
.rating:not(:checked) > input {
  display: none;
}

/* - - - - - RATE */
#rate {
  top: -65px;
}
#rate:not(:checked) > label {
  cursor:pointer;
  float: right;
  width: 30px;
  height: 30px;
  display: block;
  
  color: rgba(0, 135, 211, .4);
  line-height: 33px;
  text-align: center;
}
#rate:not(:checked) > label:hover,
#rate:not(:checked) > label:hover ~ label {
  color: rgba(0, 135, 211, .6);
}
#rate > input:checked + label:hover,
#rate > input:checked + label:hover ~ label,
#rate > input:checked ~ label:hover,
#rate > input:checked ~ label:hover ~ label,
#rate > label:hover ~ input:checked ~ label {
  color: rgba(0, 135, 211, .8);
}
#rate > input:checked ~ label {
  color: rgb(0, 135, 211);
}
/* - - - - - LIKE */
#like {
  bottom: -65px;
}
#like:not(:checked) > label {
  cursor:pointer;
  float: right;
  width: 30px;
  height: 30px;
  display: block;
  
  color: rgba(233, 54, 40, .4);
  line-height: 33px;
  text-align: center;
}
#like:not(:checked) > label:hover,
#like:not(:checked) > label:hover ~ label {
  color: rgba(233, 54, 40, .6);
}
#like > input:checked + label:hover,
#like > input:checked + label:hover ~ label,
#like > input:checked ~ label:hover,
#like > input:checked ~ label:hover ~ label,
#like > label:hover ~ input:checked ~ label {
  color: rgba(233, 54, 40, .8);
}
#like > input:checked ~ label {
  color: rgb(233, 54, 40);
}
</style>

  <section id="like" class="rating">

    <input type="radio" id="heart_5" name="like" value="5" />
    <label for="heart_5" title="Five">&#10084;</label>

    <input type="radio" id="heart_4" name="like" value="4" />
    <label for="heart_4" title="Four">&#10084;</label>

    <input type="radio" id="heart_3" name="like" value="3" />
    <label for="heart_3" title="Three">&#10084;</label>

    <input type="radio" id="heart_2" name="like" value="2" />
    <label for="heart_2" title="Two">&#10084;</label>

    <input type="radio" id="heart_1" name="like" value="1" />
    <label for="heart_1" title="One">&#10084;</label>
  </section>