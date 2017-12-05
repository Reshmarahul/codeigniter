<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Addproject extends CI_Model {

     function __construct() {
        parent::__construct();
     }

    function insertprojectdata($pname, $pstatus, $prating, $phead,$userdata,$date) 
      {//insert project details in database  
       $data = array('projectname' => $pname, 'projectstatus' => $pstatus, 'projectrating' => $prating, 'projecthead'=>$phead,'user_id'=>$userdata ,'projectdate'=>$date);
       return $this->db->insert('addproject', $data);
      }
   
      function listprojectdata()//list project data in table
        {
          
        $user_id = $this->session->userdata('id');
        if($user_id)
        {
        // $this->db->select("projectid,projectname,projectstatus,projectrating,projecthead,user_id,projectdate,address,duser");
         
        // $this->db->from('addproject');
        // $this->db->where('user_id',$user_id);
        // $query = $this->db->get();
        // return $query->result();
        $this->db->select("addproject.projectid,projectname,projectstatus,projectrating,projecthead,user_id,projectdate,filename,country,state,city,address,
        userdata.duser 
        FROM addproject
        left join (SELECT addproject.projectid, GROUP_CONCAT(employee.duser) duser 
        FROM addproject INNER JOIN employee ON FIND_IN_SET(employee.id, addproject.duser) > 0
        GROUP BY addproject.projectid) userdata ON userdata.projectid = addproject.projectid");
        $query=$this->db->get();
        return $query->result();
        }
      else
      {
      $this->db->select("addproject.projectid,projectname,projectstatus,projectrating,projecthead,user_id,projectdate,filename,country,state,city,address,
       userdata.duser 
       FROM addproject
       left join (SELECT addproject.projectid, GROUP_CONCAT(employee.duser) duser 
       FROM addproject INNER JOIN employee ON FIND_IN_SET(employee.id, addproject.duser) > 0
       GROUP BY addproject.projectid) userdata ON userdata.projectid = addproject.projectid");
    //  $this->db->from('addproject'); 
      $query=$this->db->get();
      return $query->result();

      
     }

        }

      function viewprojectdata($projectid) //viewing project details on clicking update/view button
      {  
      $this->db->select("projectid,projectname,projectstatus,projectrating,projecthead,projectdate");
      $this->db->from('addproject');
      $this->db->where('projectid',$projectid);
      $query = $this->db->get();
      return $query->result();
       }
      function fetchuserprofile() // displaying user details on clicking myprofile
       {
      $user_id = $this->session->userdata('id');
      $this->db->select("id,firstname,lastname,email,password"); 
      $this->db->from('newproject');
      $this->db->where('id',$user_id);
      $query = $this->db->get();
      return  $query->result();
        }
 public function listuserdata()
 {
  $this->db->select('duser,id'); 
  $this->db->from('employee');
  $query = $this->db->get();
  return  $query->result();
 }
      public function deleteRecord($table, $where = array()) //delete a project
      {
       $this->db->where($where);
       $result = $this->db->delete($table); 
       return;
      }

      public function updateproject($projectid,$data)//updating project details on clicking update/view
        {
        $this->db->where('projectid',$projectid);
        $this->db->update('addproject',$data);
        return;
        }
      public function downloadfile($params=array())
        {
        $this->db->select('*');
        $this->db->from('addproject');
        if(array_key_exists('projectid',$params) && !empty($params['projectid']))
          {
          $this->db->where('projectid',$params['projectid']);
          $query = $this->db->get();
          $result = ($query->num_rows() > 0)?$query->row_array():FALSE;
          }
        else
          {
            if(array_key_exists("start",$params) && array_key_exists("limit",$params))
              {
              $this->db->limit($params['limit'],$params['start']);
              }
            elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params))
              {
              $this->db->limit($params['limit']);
              }
            $query = $this->db->get();
            $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
          }
          return $query->result();
          }
        public function country()
          {
            $this->db->select('*');
            $query = $this->db->get('countries');
            return $query->result();
          }
        

        function state($countryid='')
          {
            $this->db->select('*');
            $this->db-> where('country_id', $countryid);
            $query = $this->db->get('states');
            return $query->result();
          }

          function city($stateid='')
            {
             $this->db->select('*');
             $this->db-> where('state_id', $stateid);
             $query = $this->db->get('cities');
             return $query->result();
            }
          function insertimage($image)
          {
           
          $data = array('imagename' => $image);
          $this->db->insert('image', $data);

          }

          function view_image()
          {
           $this->db->select('imagename');
           $this->db->from('image');
           $query = $this->db->get();
           return $query->result();
          }
        }
                 
        
    
       
?>

 