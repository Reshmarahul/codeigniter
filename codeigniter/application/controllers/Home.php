<?php
    if(!defined('BASEPATH'))exit('No direct script access allowed');
    class Home extends CI_Controller
    {
        function __construct()
        {
            parent::__construct();
            $this->check_isvalidated();
            $this->load->model('Home_model');
        }
        public function index()
        {
            $set['logout']=1;
            $set['home']=NULL;
            $this->load->view('templates/header',$set);
            $this->load->view('home_view');
            $this->load->view('templates/footer');
        }

        //checking validated or not
        private function check_isvalidated()
        {
           if(!$this->session->userdata('validated'))
           {
               redirect('login');
           }
       } 

       public function do_upload()
       {
           $config['upload_path']= './uploads/';
           $config['allowed_types']= 'jpg|jpeg|png';
           $config['max_size']= "100KB";
           $config['overwrite'] = TRUE;
           $config['max_height']= "800";
           $config['max_width']= "800";
           $this->upload->initialize($config);

           if (!is_dir($config['upload_path']) ) die("THE UPLOAD DIRECTORY DOES NOT EXIST");
        //    $image=$this->input->post('image');
           if(!$this->upload->do_upload('image'))
           {
                $error=array('error'=>$this->upload->display_errors());
                print_r($error['error']);
                $set['logout']=1;
                $set['home']=1;
                $this->load->view('templates/header',$set);
                $this->load->view('add_user_form');
                $this->load->view('templates/footer');
           }
           else
           {
            $image = array('upload_data' => $this->upload->data());
            $this->get_user($image);
           }
       }

        //Showing create new user form
        public function add_user_form()
        {
            $set['logout']=1;
            $set['home']=1;
            $this->load->view('templates/header',$set);
            $this->load->view('add_user_form');
            $this->load->view('templates/footer');
        }

        //taking entered data to insert into the database table employee
        public function get_user($image)
        {
            $iname=$image['upload_data']['file_name'];
            $user_name=$this->input->post('username');
            $email=$this->input->post('email');
            $password=md5($this->input->post('password'));
            $department=$this->input->post('department');
            $designation=$this->input->post('designation');

            if($this->input->post('submit')=='submit')
            {
                $this->form_validation->set_rules('username','Username','trim|required');
                $this->form_validation->set_rules('email','Email','trim|required|valid_email|is_unique[employee.email]');
                $this->form_validation->set_rules('password','Password','trim|required');
                $this->form_validation->set_rules('confirmpassword','Confirm Password','trim|required|matches[password]');
                $this->form_validation->set_rules('department','Department','trim|required');
                $this->form_validation->set_rules('designation','Designation','trim|required');

                if($this->form_validation->run()==FALSE)
                {
                    $set['logout']=1;
                    $set['home']=1;
                    $this->load->view('templates/header',$set);
                    $this->load->view('add_user_form');
                    $this->load->view('templates/footer');
                }
                else
                {
                    $user_result=$this->Home_model->insert_user_data($user_name,$email,$password,$department,$designation,$iname);
                    if(!$user_result)
                    {
                        echo 'insertion was not successful';
                    }
                    else
                    {
                        // echo "insertion successfull";
                        $this->fetch_user();
                    }
                }
            }
            // echo "success";
        }

        //fetch userdata to display in userslist
     public function fetch_user()
        {
            $data2['employees']=$this->Home_model->fetch_user_data();
            $set['logout']=1;
            $set['home']=1;
            $this->load->view('templates/header',$set);
            $this->load->view('userslist',$data2);
            $this->load->view('templates/footer');
        }

        //delete a row of employee table
        public function delete_user($user_id)
        {
            $this->Home_model->delete_user_data($user_id);
            redirect('/home/fetch_user');
        }

        //Calling update user view page 
        public function update_user($user_id)
        {
            $data['users']=$this->Home_model->show_data($user_id);
            $data['country']= $this->Home_model->getcountry();
            $set['logout']=1;
            $set['home']=1;
            $this->load->view('templates/header',$set);
            $this->load->view('update_user_form',$data);
            $this->load->view('templates/footer');        
        }

        public function ajax_state_list()
        {
            $country_id=$this->input->post('country_id');
            $data['state'] = $this->Home_model->getstate($country_id);
            $output = null;  
            foreach ($data['state'] as $row)  
            {  
               //here we build a dropdown item line for each  query result  
               $output .= "<option value='".$row->id."'>".$row->name."</option>";  
            }  
            echo $output; 
        }

        public function ajax_city_list()
        {
            $state_id=$this->input->post('state_id');
            $data['city'] = $this->Home_model->getcity($state_id);
            $output = null;  
            foreach ($data['city'] as $row)  
            {  
               //here we build a dropdown item line for each  query result  
               $output .= "<option value='".$row->id."'>".$row->name."</option>";  
            }  
            echo $output; 
        }

        //update userdata
        public function update_now()
        {
            $user_id=$this->input->post('userid');
            $data2=array(
                'duser'=>$this->input->post('username'),
                'email'=>$this->input->post('email'),
                'department'=>$this->input->post('department'),
                'designation'=>$this->input->post('designation'),
                'address'=>$this->input->post('address'),
                'latitude'=>$this->input->post('latitude'),
                'longitude'=>$this->input->post('longitude')
            );
            $this->Home_model->update_user_data($user_id,$data2);
            //$this->fetch_user();
            echo "success";
            // redirect('home/fetch_user','refresh');         
        }

        //update photo
        public function update_photo($user_id)
        {
            $config['upload_path']= './uploads/';
            $config['allowed_types']= 'jpg|jpeg|png';
            $config['max_size']= "100KB";
            $config['overwrite'] = TRUE;
            $config['max_height']= "800";
            $config['max_width']= "800";
            $this->upload->initialize($config);
            
            if (!is_dir($config['upload_path']) ) die("THE UPLOAD DIRECTORY DOES NOT EXIST");
    
            if(!$this->upload->do_upload('image'))
            {
                 $error=array('error'=>$this->upload->display_errors());
                 $this->fetch_user();
            }
            else
            {
                $image = array('upload_data' => $this->upload->data());
                $iname=array(
                    'iname'=>$image['upload_data']['file_name'],
                );
                $user_result=$this->Home_model->update_user_data($user_id,$iname);
                $this->fetch_user();
            }
        }
        

        //logout function
        public function do_logout()
        {
            $this->session->sess_destroy();
            redirect('login/','refresh');
        }   


        public function get_locations()
        {
            $locations=$this->Home_model->get_locations();
            echo json_encode( $locations );
        }

        public function view_image()
        {
            $data['image']=$this->Home_model->view_image();
            $set['logout']=1;
            $set['home']=1;
            $this->load->view('templates/header',$set);
            $this->load->view('image',$data);
            $this->load->view('templates/footer');
        }
    }
?>