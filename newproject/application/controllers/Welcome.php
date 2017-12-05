<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	
	 public function __construct()
     {
		 parent::__construct();
         $this->load->helper('form');
         $this->load->helper('url');
        
        $this->load->database();
	    $this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('SelectModel');
		$this->load->model('Addproject'); 
		$this->load->helper(array('form', 'url'));
		$this->load->library('upload');
		
	 }
	 
	
	public function index()//load the starting page
    {   
		// $set['login']=NULL;
		// $set['value']=NULL;
		// $this->load->view('template/header',$set);
        // $this->load->view('startpage');
		// $this->load->view('template/footer');  
		$set['login']=1;
		$set['value']=NULL;
		if(( $this->session->userdata('id'))||( $this->session->userdata('userid')))
		{
			redirect('welcome/home');
		}
		$this->load->view('template/header',$set);	 	
		$this->load->view('login');
		$this->load->view('template/footer');
	 }

	 public function register()//load the registration page
	 { 
	  $set['login']=NULL;
	  $set['value']=NULL;
	  if( $this->session->userdata('id'))
	  {
	  redirect('welcome/home');
	 }
	 

	  $this->load->view('template/header',$set);	 
	  $this->load->view('register');
	  $this->load->view('template/footer'); 
	 }

	 public function login()  //load the login page
	 {
	 $set['login']=1;
	 $set['value']=NULL;
	 if(( $this->session->userdata('id')) ||( $this->session->userdata('userid')))
	 {
		 redirect('welcome/home');
	 }
	 $this->load->view('template/header',$set);	 	
	 $this->load->view('login');
	 $this->load->view('template/footer');
	 }

	 public function home()//load the homepage after login
	 { 
		$this->checkisvalidated();
		$set['login']=NULL;
		$set['value']=1;
		$this->load->view('template/header',$set);
		$this->load->view('home');
		$this->load->view('template/footer');
	 }	

	
	public function getuserdata()//get user registration details
		{
	       $f = $this->input->post("firstname");
	       $l=  $this->input->post("lastname");
	       $e = $this->input->post("email");
	       $p= md5($this->input->post("password"));
	       $this->form_validation->set_rules("firstname", "", "trim|required");
	       $this->form_validation->set_rules("lastname", "", "trim|required");
	       $this->form_validation->set_rules("email", "", "trim|required|valid_email");
		   $this->form_validation->set_rules("password", "", "trim|required");
		   $this->form_validation->set_rules("confirmpassword", "", "trim|required|matches[password]");

			if ($this->form_validation->run() == TRUE)
			    {
				$this->load->model('SelectModel'); 
				$usr_result = $this->SelectModel->getregisterdata($f,$l,$e,$p);
				echo "h";
			    }
			   else
				{  
					echo "validation_error";
					$set['login']=NULL;
					$set['value']=NULL;
					$this->load->view('template/header',$set);
					$this->load->view('register');
					$this->load->view('template/footer',$set);
				}
	     		  
		}	  
			
			 

	public function login_user() //user login function
		{
	    // $user_login=array(
	    // 'user_email'=>$this->input->post('user_email'),
	    // 'user_password'=>md5($this->input->post('user_password')) );
		$this->form_validation->set_rules("user_email", "", "trim|required|valid_email");
	    $this->form_validation->set_rules("user_password", "", "trim|required");
		  if ($this->form_validation->run() == TRUE)
			{
			$data = $this->SelectModel->login_user();
		//	print_r($data);
		//	exit;
				if($data) 
					{
		           
					echo "success";
				 	} 
			}
				
				 
		}	

	

		public function addproject($userfile=array()) // to add new project details and displaying as table
			{   
				$set['login']=NULL;
				$set['value']=1;
				$this->load->view('template/header',$set);
				$this->load->view('addproject');
				if($this->input->post('submit') == "submit")
					{
					$projectname = $this->input->post("projectname");
					$projectstatus=  $this->input->post("projectstatus");
					$projectrating = $this->input->post("projectrating");
					$projecthead= $this->input->post("projecthead");
					$userid= $this->session->userdata('id');
					$projectdate=$this->input->post("projectdate");
					$userfilename= $userfile['upload_data']['file_name'];
					$userfilepath= $userfile['upload_data']['file_path'];	
					$usr_result = $this->Addproject->insertprojectdata($projectname,$projectstatus,$projectrating,$projecthead,$userid,$projectdate,$userfilename,$userfilepath); 
					} 
					$this->load->view('template/footer',$set);	  
			}
					
							public function projectview()
							{
							$data['projectdata']=$this->Addproject->listprojectdata(); 
							$set['login']=NULL;
							$set['value']=1;
							$this->load->view('template/header',$set); 
							$this->load->view('project_view',$data);
							$this->load->view('template/footer',$set); 
							}		
						
		        
		
			 
		  
		public function deleteproject($id) //delete a project
		    {
			$where = array('projectid' => $id); 
			$res=$this->Addproject->deleteRecord('addproject',$where);
			redirect('/welcome/projectview');
		    }
			
		 
		public function viewproject($projectid) //view project details on clicking view/update
		    {
			  $data['projectdata']=$this->Addproject->viewprojectdata($projectid);
			  $data['country']=$this->Addproject->country();
			  
			  $set['login']=NULL;
			  $set['value']=1;
			  $this->load->view('template/header',$set);
			  $data['userdata']=$this->Addproject->listuserdata();
			  $this->load->view('update_view',$data,$projectid);
			  $this->load->view('template/footer');
			}
		
		public function updateproject() //update project details
			{
				$projectid=$this->input->post('projectid');
				$data= array(
				'projectname'=>$this->input->post('projectname'),
				'projectstatus'=>$this->input->post('projectstatus'),
				'projectrating'=>$this->input->post('projectrating'),
				'projecthead'=>$this->input->post('projecthead'),
				'projectdate'=>$this->input->post('projectdate'),
				'duser'=>implode(',',$this->input->post('duser[]')),
				//'duser'=>$this->input->post('duser'),
				'country'=>$this->input->post('country'),
				'state'=>$this->input->post('state'),
				'city'=>$this->input->post('city'),
				'address'=>$this->input->post('addresses'),
				);  
				$res=$this->Addproject->updateproject($projectid,$data);
				//redirect('/welcome/addproject');
				echo "u";
			     
			}
			   
	    public function logout() //logout from homepage and userprofile
		        {
				 $this->session->sess_destroy();
			     redirect('welcome/login');
				}
				
		public function userprofile()//to load the user profile page
			{
				$query=$this->Addproject->fetchuserprofile();
				$data['userdata'] = null;
				if($query)
				  {
				  $data['userdata'] =  $query;
				  }
				  $set['login']=NULL;
	              $set['value']=1;
		          $this->load->view('template/header', $set);
				  $this->load->view('userprofile.php',$data);
				  $this->load->view('template/footer');
			}
		public function do_upload() //to upload file
			{  
				$config['upload_path'] ='./uploads/';
				$config['allowed_types'] = 'doc|docx|pdf|jpg';
				$config['max_size'] = 1000;
				$this->upload->initialize($config);
				if (!is_dir($config['upload_path']))  die("The upload directory doesnot exist") ;
					if (!$this->upload->do_upload('userfile'))
					{
					$error = array('error' => $this->upload->display_errors());
					redirect('/welcome/addproject');
					}
					else
		    		{     
					$userfile = array('upload_data' => $this->upload->data());
					$this->addproject($userfile);
					}
			}
		public function uploadimage() //to upload image
		{  
		$config['upload_path'] ='./images/';
		$config['allowed_types'] = 'jpg|jpeg|png';
		$config['max_size'] = 1000;
		$this->upload->initialize($config);
		if (!is_dir($config['upload_path']))  die("The upload directory doesnot exist") ;
		if (!$this->upload->do_upload('userimage'))
			{
			$error = array('error' => $this->upload->display_errors());
			print_r($error);
			}
		else
		    {  
			$userimage = array('upload_data' => $this->upload->data());
			$image= $userimage['upload_data']['file_name'];
			$data=$this->Addproject->insertimage($image);
			$this->view_image();
		    }
		}

		public function view_image()
		{   
			$set['login']=NULL;
			$set['value']=1;
			$this->load->view('template/header', $set);
			$data['name']=$this->Addproject->view_image();
			$this->load->view('image',$data);
			print_r($data);
			$this->load->view('template/footer', $set);
		}

    	public function downloadfile($projectid)// to download file
        	{

	    	if(!empty($projectid))
	        	{
				$this->load->helper('download');
				$fileInfo = $this->Addproject->downloadfile(array('projectid' => $projectid));
				$file = './uploads/'.$fileInfo[0]->filename;
		
				if(file_exists($file))
					{
					$data = file_get_contents ($file);
					force_download($fileInfo[0]->filename, $data);
					}
				}
		}
		
		public function checkisvalidated()
			{
			if(!$this->session->userdata("validated"))
				{
					redirect('welcome/login');
				}
	
			}
public function ajax_state_list()
{
	
	$countryid=$this->input->post('country_id');
	$data['state'] = $this->Addproject->state($countryid);
	
	$output = null;
	foreach ($data['state'] as $row)
	{
	$output .= "<option value='".$row->id."'>".$row->name."</option>";
	}
	echo $output;
	}
		
	
	


	public function ajax_city_list()
	{
		
		$stateid=$this->input->post('state_id');
		$data['city'] = $this->Addproject->city($stateid);
		
		$output = null;
		foreach ($data['city'] as $row)
		{
		$output .= "<option value='".$row->id."'>".$row->name."</option>";
		}
		echo $output;
		}
	
}

					

				
		
		
?>