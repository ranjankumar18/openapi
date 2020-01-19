<?php
  class Get_Record extends CI_Model {
       
      public function __construct(){
          
        $this->load->database();
        
      }
	 public function getRecords($sku){  
		   $this->db->select('product.Price,product.Total_Estimated_Sales,orders.Order_Qty');
$this->db->from('product');
$this->db->join('orders','orders.SKU=product.SKU');
$this->db->where('product.SKU',$sku);
$query=$this->db->get();
//return $query->result_array();
           
           if($query->num_rows() == 1)
           {

               return $query->result_array();

           }
           else
           {

             return 0;

          }

      }
	 
          
    
      
      public function update($sku,$data){
$this->db->where('SKU', $sku);


       if($this->db->update('product', $data)){
       

          return true;

        }else{

          return false;

        }

    }
	public function update1($sku,$sets){
	  
	 
$this->db->where('SKU', $sku);

       if( $this->db->update('orders', $sets)){
       

          return true;

        }else{

          return false;

        }

    }

}
