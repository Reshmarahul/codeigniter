<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class SelectModel extends CI_Model {

     function __construct() {
        parent::__construct();
     }
    //  function select(){
    //     $this->db->select("firstname,lastname,email,password");
    //     $this->db->from('newproject');
    //     $query = $this->db->get();
    //     return $query->result();
    //    }


      
            function getregisterdata($fname, $lname, $email, $password)
             {
                  
                 $data = array('firstname' => $fname, 'lastname' => $lname, 'email' => $email, 'password'=>$password);
          
                  return $this->db->insert('newproject', $data);
              }   
           public function login_user()
           {
            $useremail=$this->input->post('user_email');
            $password=md5($this->input->post('user_password'));    
             $this->db->select('*');
             $this->db->from('newproject');
             $this->db->where('email',$useremail);
             $this->db->where('password',$password);
             $query=$this->db->get();
             if($query->num_rows()==1) 
             {
                $row=$query->row();  
                $data=array(
                    'id'=>$row->id,
                    'firstname'=>$row->firstname,
                    'lastname'=>$row->lastname,
                    'email'=>$row->email,
                    'password'=>$row->password,
                    'validated'=>true,
                );
                $this->session->set_userdata($data);
                return true;
             }     
            else
                   {

                    $this->db->select('*');
                    $this->db->from('admin');
                    $this->db->where('useremail',$useremail);
                    $this->db->where('password',$password);
                    $query=$this->db->get();
                    if($query->num_rows()==1)
                    {
                        $row=$query->row();
                        $data=array(
                            'userid'=>$row->userid,
                            'fname'=>$row->fname,
                            'lname'=>$row->lname,
                            'useremail'=>$row->useremail,
                            'validated'=>true,
                        );
                        $this->session->set_userdata($data);
                        return true;
                    } 
                    return false;
                   }
                  
                  
             }

            //  public function verify()
            //  {
                
            //      $this->db->select('*');
            //      $this->db->from('admin');
            //      $this->db->where('useremail',$useremail);
            //      $this->db->where('password',$password);
            //      $query=$this->db->get();
            //      if($query->num_rows()==1)
            //      {
            //          $row=$query->row();
            //          $data=array(
            //              'userid'=>$row->userid,
            //              'fname'=>$row->fname,
            //              'lname'=>$row->lname,
            //              'useremail'=>$row->useremail,
            //              'validated'=>true,
            //          );
            //          $this->session->set_userdata($data);
            //          return true;
            //      }
            //      return false;
            //  }
             
            //  public function admin ()
            //  {
                      
            //  $this->db->select('*');
            //  $this->db->from('admin');
            //  $this->db->where('useremail',$email);
            //  $this->db->where('password',$pass); 
            //  $query=$this->db->get();
            //  return $query->row_array();
            //  }
      
      
      
      
            }





      


      ?>