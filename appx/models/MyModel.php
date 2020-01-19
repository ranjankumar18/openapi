<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MyModel extends CI_Model {


    public function login($email,$password)
    {
        $q  = $this->db->select('password,id')->from('users')->where('email',$email)->get()->row();
        if($q == ""){
            return array('status' => 203,'message' => 'Username not found.');
        } else {
            $hashed_password = $q->password;
            $id              = $q->id;
            
            if (password_verify($password, $hashed_password)) {
                  return array('status' => 200,'message' => 'Successfully login.','id' => $id);
            
            } else {
               return array('status' => 203,'message' => 'Wrong password.');
            }
        }
    }
   
    public function signup($data)
     {

       $this->name    = $data['name']; 
       $this->email    = $data['email'];
       $hash  = $data['password'];

        $this->password = password_hash($hash, PASSWORD_BCRYPT);
        $q  = $this->db->select('email,id')->from('users')->where('email',$this->email)->get()->num_rows();
        if($q <= 0)
        {    
            $this->db->insert('users',$this);
           return array('status' => 200,'message' => 'Successfully Registered.');
          
       }else{

            
           return array('status' => 203,'message' => 'Some error occured.Please try again after sometime.');
           
       }
        
        
    }


    public function logout()
    {
        $users_id  = $this->input->get_request_header('User-ID', TRUE);
        $this->db->where('users_id',$users_id);
        return array('status' => 200,'message' => 'Successfully logout.');
    }


    public function listUser(){

       $query = $this->db->query("select email,name from `users`");

       $x = 1;
       foreach ($query->result_array() as $row) {
         # code...
      $output[] = array(
    $x,
    $row['name'],
    $row['email']
    
  );

  $x++;
}


       return array('status' => 200,'data' => $output);

   }

   
}
