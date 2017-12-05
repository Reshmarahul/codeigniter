<?php
    if(!defined('BASEPATH')) exit('No direct script access allowed');
    class Login_model extends CI_Model
    {
        function __construct()
        {
            parent::__construct();
        }
        public function verify()
        {
            $useremail=$this->input->post('useremail');
            $password=md5($this->input->post('password'));
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
    ?>