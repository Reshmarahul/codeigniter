
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload extends CI_Controller {



public function __construct()
     {
		 parent::__construct();
         $this->load->helper(array('form', 'url'));
         $this->load->library('upload');
         
     } 
     public function index()
     {
             $this->load->view('addproject', array('error' => ' ' ));
     }

     public function do_upload()
     {  
         $msg=NULL;
         $config['upload_path'] ='./uploads/';
        // $config['upload_path'] ='/var/www/html/newproject/uploads/';
         $config['allowed_types']        = 'doc|docx|pdf';
         $config['max_size']             = 1000;
          $this->upload->initialize($config);
          if (!is_dir($config['upload_path']))  die("The upload directory doesnot exist") ;
          
          // print_r($_FILES);
         // exit;
          if (!$this->upload->do_upload('userfile'))
         
          {
              echo "reshma"; 
              $error = array('error' => $this->upload->display_errors());

              $this->load->view('addproject', $error);

         }
         else
              {     
                   echo "reshma1";
                  $msg['success']="upload successful";
                  $this->load->view('addproject', $msg);
              }
      }
    }