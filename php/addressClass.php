<?php 
// Start session 
if(!session_id()){ 
    session_start(); 
} 

class Address {

    protected $address = array(); 
     
    public function __construct(){ 
        // get the shopping cart array from the session 
        $this->address = !empty($_SESSION['address'])?$_SESSION['address']:NULL; 
        if ($this->address === NULL){ 
            // set some base values 
            $this->address = array('firstname' => '', 'lastname' => '', 'email' => '', 'phone' => '', 'addressline1' => '', 'addressline2' => '', 'city' => '', 'state' => ''); 
        } 
    }

    public function contents(){ 
        // rearrange the newest first 
        $address = $this->address; 
 
        // remove these so they don't create a problem when showing the cart table 
        // unset($address['total_items']); 
        // unset($address['cart_total']); 
 
        return $address; 
    }

    public function insert($address_detail = array()){
        
        if(!is_array($address_detail) OR count($address_detail) === 0){ 
            return FALSE; 
        }else{ 
    
            $this->address = $address_detail; 
                
            // save Cart Item 
            if($this->save_cart()){ 
                return TRUE; 
            }else{ 
                return FALSE; 
            } 
             
        } 
    }

    protected function save_cart(){

        $_SESSION['address'] = $this->address; 
        return TRUE;
    
    }
}

