<?php
require(APPPATH.'libraries/REST_Controller.php');

class Put_Order extends REST_Controller{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Get_Record');
    }
	function updateRecord_post(){
         $sku= $this->post('sku');
         $tri= $this->post('tri');
   /* function updateRecord_put(){
         $sku= $this->put('sku');
         $tri= $this->put('tri');*/
        if(!$sku || !$tri){

            $this->response("No Id Exist", 400);

            exit;
        }
        $result = $this->Get_Record->getRecords($sku );

        if($result){
            foreach($result as $x_value) {
			  $price=$x_value['Price'];
			if($tri<=$x_value['Total_Estimated_Sales']){
			   $val1=$x_value['Total_Estimated_Sales']-$tri;
			   $per=$val1/$x_value['Total_Estimated_Sales']*100;
			   
			   if($per<=10){
			      $price1=$price*10/100;
			   }
			   elseif($per>10 && $per <=25){
			   $price1=$price*20/100;
			   }
			   else{
			   $price1=$price*30/100;
			   }
			   $t_price=$x_value['Price']-$price1;
			}
			else{
			
			   $val1=$tri-$x_value['Total_Estimated_Sales'];
			   $per=$val1/$x_value['Total_Estimated_Sales']*100;
			   if($per<=10){
			      $price1=$price*12/100;
			   }
			   elseif($per>10 && $per <=25){
			   $price1=$price*18/100;
			   }
			   else{
			   $price1=$price*21/100;
			   }
			   $t_price=$x_value['Price']+$price1;
			}
			  
			  }
			 $data=array("Price"=>$t_price);
			 $sets=array("Order_Qty"=>$tri);
			 $result = $this->Get_Record->update($sku,$data);
			 $result = $this->Get_Record->update1($sku,$sets);
             
            if($result === 0){

                $this->response("Please Enter Correct Quantity.", 404);

            }else{

                $this->response("Updated", 200);  

            }
           
            
        } 
        else{

             $this->response("Invalid Data", 404);

            exit;
        }


         
         
            

        

    }
	}

	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	