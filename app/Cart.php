<?php
 namespace App;
 use Session;
class Cart {
    public $items = null;
	public $totalQty = 0;
	public $totalPrice = 0;
public function __construct($oldCart) {
        
        if($oldCart) {
            $this->items = $oldCart->items;
            $this->totalQty = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
    
        }
    }
public function add($item, $id){
        //dd($this->items);
        $storedItem = ['qty'=>0, 'price'=>$item->fee, 'item'=> $item];
        if ($this->items){
            if (array_key_exists($id, $this->items)){
                $storedItem = $this->items[$id];
            }
        }
$storedItem['qty']++;
        
        $storedItem['price'] = $item->fee * $storedItem['qty'];
        $this->items[$id] = $storedItem;
        $this->totalQty++;
        $this->totalPrice += $item->fee;
    }

    public function removeItem($id){
    //dd($this->groomings);
        $this->totalPrice -= $this->items[$id]['price'];
        unset($this->items[$id]);
    }

    
}
