<?php
    if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Main_Model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    function validate_login($postData){
        $this->db->select('*');
        $this->db->where('username', $postData['username']);
        $this->db->where('password', md5($postData['password']));
        // $this->db->where('status', 1);
        $this->db->from('admins');
        $query=$this->db->get();
        if ($query->num_rows() == 0)
            return false;
        else
            return $query->result(); 
    }

//ბაზიდან განაწილების მოთხოვნის ფუნქცია
    function ganawileba()
    {
        $this->db->select('*');
        $this->db->from('ganawileba');
        $this->db->join('subjects','subjects.ID = ganawileba.sagani_ID');
        return $this->db->get()->result();

        // $ganawileba_query=$this->db->query('SELECT subjects.dasaxeleba, ganawileba.* FROM subjects
        //                                     JOIN ganawileba on subjects.ID =ganawileba.sagani_ID');
        // $ganawileba=$ganawileba_query->result();
        // return $ganawileba;
    }

//საგნის დამატების ფუნქცია 
    function add_subj($post_data)
    {
        $this->db->insert('subjects',$post_data);
        $insert_id = $this->db->insert_id();
        return  $insert_id;
    }


//საგნების დაგენერირების ფუნქცია
    function Get_subjects()
    {        
        $this->db->select('*');
        $this->db->from('subjects');
        return $this->db->get()->result();        
    }

    function GetType()
    {
        $this->db->select('*');
        $this->db->from('program_type');
        return $this->db->get()->result(); 
    }

//პასუხების ბაზიდან მოთხოვნა
    function getResults()
    {
        $this->db->select('*');
        $this->db->from('results');
        return $this->db->get()->result();
    }
    function getEduResults()
    {
        $this->db->select('*');
        $this->db->from('results_edu');
        return $this->db->get()->result();
    }
//კრედიტების საგნის იდენტიფიკატორის მიხედვით მოთხოვნა
    function GetCredit($id)
    {
        $this->db->select('*');
        $this->db->from('program_type');
        $this->db->where('ID', $id);
        return $this->db->get()->row();
    }

    function activities()
   {
        $this->db->select('*');
        $this->db->from('activity');
        return $this->db->get()->result();
   }

    function activityes_qty()
    {
        $this->db->select('*');
        $this->db->from('activity');
        return $this->db->get()->num_rows();
    }

//საგნის წაშლის ფუნქცია საგნის იდენტიფიკატორის მიხედვით
    function delete_subject($subject_id){
        $this->db->delete('subjects', array('ID' => $subject_id)); 
        return true;
    }
//სილაბუსის წაშლის ფუნქცია სილაბუსის იდენტიფიკატორის მიხედვით
    function delete_sylabus($syl_id){
        $this->db->delete('sylabus', array('id' => $syl_id)); 
        return true;
    }

    function sel_subj($id){
        $this->db->select('*');
        $this->db->from('subjects');
        $this->db->where('ID', $id);
        return $this->db->get()->row();
    }

    function sel_sylabus($id){
        $this->db->select('*');
        $this->db->from('sylabus');
        $this->db->where('id', $id);
        return $this->db->get()->row();
    }

    function get_sylabus_ids_by_program($program_id)
    {
        $this->db->select('sylabus_id');
        $this->db->from('sylabuses_to_program');
        $this->db->where('program_id', $program_id);
        return $this->db->get()->result_array();
    }


    function getSylabuses()
    {
        $this->db->select('sylabus.*,subjects.dasaxeleba');
        $this->db->from('sylabus');
        $this->db->join('subjects','sylabus.subject_id=subjects.ID');
        $this->db->order_by('id','DESC');
        return $this->db->get()->result();   
    }
    function getPrograms()
    {
        $this->db->select('edu_programs.*');
        $this->db->from('edu_programs');
        // $this->db->join('subjects','sylabus.subject_id=subjects.ID');
        $this->db->order_by('id','DESC');
        return $this->db->get()->result();   
    }
    
    function get_activities_by_subj_id($id){
        $this->db->select('*');
        $this->db->from('ganawileba');
        $this->db->where('sagani_ID', $id);
        return $this->db->get()->row();
    }

    function getGoals()
    {
        $this->db->select('*');
        $this->db->from('goals');
        // $this->db->where('id', $id);
        return $this->db->get()->result();
    }
    function getMethods()
    {
        $this->db->select('*');
        $this->db->from('methods');
        // $this->db->where('id', $id);
        return $this->db->get()->result();
    }

    function getEduMethods()
    {
        $this->db->select('*');
        $this->db->from('methods_edu');
        // $this->db->where('id', $id);
        return $this->db->get()->result();
    }

    function get_distr_by_subj($id)
    {
        $this->db->select('*');
        $this->db->from('ganawileba');
        $this->db->where('sagani_ID', $id);
        return $this->db->get()->row();
    }
    function get_subsphere_by_sphere_id($sphere_id)
    {
        $this->db->select('*');
        $this->db->from('education_sphere');
        $this->db->where('parent_id', $sphere_id);
        return $this->db->get()->result();
    }
//სფეროების ბაზიდან გამოტანის ფუნქცია
    function get_spheres()
    {
        $this->db->select('*');
        $this->db->from('education_sphere');
        $this->db->where('parent_id', 0);
        return $this->db->get()->result();
    }

    function get_sylabus($sylabus_id)
    {
        $this->db->select('*');
        $this->db->from('sylabus');
        $this->db->where('id', $sylabus_id);
        return $this->db->get()->row();
    }
    function get_program($program_id)
    {
        $this->db->select('*');
        $this->db->from('edu_programs');
        $this->db->where('id', $program_id);
        return $this->db->get()->row();
    }
    function get_faculty()
    {
        $this->db->select('*');
        $this->db->from('faculties');
        return $this->db->get()->result();
    }
}
