<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function login()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			
				$email=$this->input->post('email');
				$password=$this->input->post('password');
		        	$response = $this->MyModel->login($email,$password);
				json_output($response['status'],$response);
			}
		}
	


	public function signup()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
            
            $params=$this->input->post();
		        $response = $this->MyModel->signup($params);
				json_output($response['status'],$response);
			}
		}
	

	public function logout()
	{	
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			
			
		        	$response = $this->MyModel->logout();
				json_output($response['status'],$response);
			}
		
	}


	public function getUser()
	{	
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'GET'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			
			
		        	$response = $this->MyModel->listUser();
				json_output($response['status'],$response);
			}
		
	}

	public function getLCM()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
            
            $params=$this->input->post('input');
            $input=explode(',', $params);

			$lcm_input=count($input);
          
		       $result_lcm=$this->LCM($input, $lcm_input);
		        $response=array('status' => 200,'total' => $result_lcm['total'],'time' => $result_lcm['time']);
				json_output($response['status'],$response);
			}
		}


		public function LCM($arr, $n) 
	    { 

	    $start_time = microtime(true);
	    
	    $max_num = 0; 
	    for ($i = 0; $i < $n; $i++) 
	        if ($max_num < $arr[$i]) 
	            $max_num = $arr[$i]; 
	  
	    
	    $res = 1; 
	  
	    
	    $x = 2;  
	    while ($x <= $max_num) 
	    { 
	        $indexes = array(); 
	        for ($j = 0; $j < $n; $j++) 
	            if ($arr[$j] % $x == 0) 
	                array_push($indexes, $j); 
	  
	       
	        if (count($indexes) >= 2) 
	        { 
	            
	            for ($j = 0; $j < count($indexes); $j++) 
	                $arr[$indexes[$j]] = (int)($arr[$indexes[$j]] / $x); 
	  
	            $res = $res * $x; 
	        } 
	        else
	            $x++; 
	        } 
	  
	       for ($i = 0; $i < $n; $i++) 
	        $res = $res * $arr[$i]; 
	         $result['total']=$res;
            $end_time = microtime(true); 


            $execution_time = ($end_time - $start_time); 

	        $result['time']= $execution_time;


	        return $result; 
	}
	
}
