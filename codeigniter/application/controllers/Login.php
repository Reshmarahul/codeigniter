<?php  
    if(!defined('BASEPATH')) exit('No direct script accepted');
    class Login extends CI_Controller
    {
        function __construct()
        {
            parent::__construct();
            $this->check_isvalidated();
        }
        public function index($msg=NULL)
        {
            $set['logout']=NULL;
            $set['home']=NULL;
            $this->load->view('templates/header',$set);
           
            //server-side validation
            $this->form_validation->set_rules('useremail','Useremail','trim|required|valid_email');
            $this->form_validation->set_rules('password','Password','trim|required');
            if($this->form_validation->run()==FALSE)
            {
                $msg=NULL;
                $data['msg']=$msg;
                $this->load->view('login_view',$data); 
            }
            else
            {
                $data['msg']=$msg;
                $this->load->view('login_view',$data);
            }
            $this->load->view('templates/footer');

        }

        //checking validated or not
        private function check_isvalidated()
        {
           if($this->session->userdata('validated'))
           {
               redirect('home');
           }
       } 
        
        //verify the entered value with the value in database
        public function verify()
        {
            $this->load->model('Login_model');
            $result=$this->Login_model->verify();
            if(!$result)
            {
                echo "not success";
                // $msg='<font color>Invalid username and/or password.</font><br/>';
                // $this->index($msg);
            }
            else
            {
                // $res=array(
                //     'message'=>'success',
                // );
                // echo json_encode($res);
                 echo "success";
                // redirect('home/', 'refresh');                   
            }
        }
    }
?>
