<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// session_start();

//ძირითადი ფუნქციების უმრავლესობა ამ ფაილშია
class Main extends CI_Controller {
	function __construct() {
        parent::__construct();
        // $this->load->library('session');
        
    }
	public function syl_pdf()
	{		
		 $id=$this->uri->segment(3);
		 $data['syl'] = $this->Main_model->get_sylabus($id);
		 $this->load->view('syl_pdf',$data);
		//echo CI_VERSION;
	}
	public function program_pdf()
	{		
		 $id=$this->uri->segment(3);
		 $data['prog'] = $this->Main_model->get_program($id);
		//  $sylabuses=$this->Main_model->get_sylabus_ids_by_program($id);
		//  print_r($sylabuses);
		//  $sylabus_ids="";
		//  foreach ($sylabuses as $key => $value) {
		//  		$sylabus_ids
		//  }
		// $data['sylabuses']=$this->Main_model->get_sylabuses($sylabus_id);

		 $this->load->view('program_pdf',$data);
		//echo CI_VERSION;
	} 


//ეს ფუნქცია იტვირთება  მაინ კონტროლერის ჩატვირთვისთანავე  და browse learning დიზაინს ტვირთავს და გადასცემს სხვადასხვა აქტივობის მასივს  
	public function index()
	{
		// if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) redirect('main/syllabus'); 
		// if ($this->session->has_userdata('logged_in')) redirect('main/syllabus');  

		$data['content'] = 'content/add_subject';
        $this->load->view('content/login', $data);



		// $data['activityes']=$this->Main_model->activities(); 
		// $data['activityes_qty']=$this->Main_model->activityes_qty();
  //       $data['content'] = 'content/browse_Learning_Program';
  //       $this->load->view('index', $data);                  // aq index da header footer unda davanawevro
	}
	
//გვეხმარება საგნის ბაზაში შეყვანაში , ტვირთავს subj_input დიზაინს რომ მომხმარებელმა შეიყვანოს საგნის შედგენისთვის საჭირო ინფორმაცია
	public function create_subject(){
		if (!$this->session->has_userdata('logged_in')) redirect('');
		$data['activityes']=$this->Main_model->activities();
		$data['activityes_qty']=$this->Main_model->activityes_qty();
        $data['content'] = 'content/subj_input';
        $this->load->view('index', $data);         
	}

//გვეხმარება საგნის ბაზაში შეყვანაში , ბაზაში ამატებს subj_input ინტერფეისიდან შეგროვებულ მონაცემებს
	public function add_subject()
	{
		if (!$this->session->has_userdata('logged_in')) redirect(''); 
    //	$url_lang = $this->uri->segment(1);
    //    $curDate = date("Y-m-d H:i:s");
        $sagani_data =  array(
    	'dasaxeleba'=>$this->input->post("subject_name"),
    	);

    $last_ins_id=$this->Main_model->add_subj($sagani_data);
	$ganawileba_data =  array(
    	'sagani_ID' =>$last_ins_id,
        'leqcia_sak' => $this->input->post("value1"),
        'praqtikuli_sak' => $this->input->post("value2"),
        'laboratoriuli_sak' => $this->input->post("value3"),
        'leqcia_dam' => $this->input->post("value4"),
        'praqtikuli_dam' => $this->input->post("value5"),
        'laboratoriuli_dam' => $this->input->post("value6"),
        'shualeduri' => $this->input->post("value7"),
        'daskvniti' => $this->input->post("value8"),
        'creditsinhour'=>$this->input->post("credits_in_hour"),
    	'credits'=>$this->input->post("subjects_credits")
    );
  	    $this->db->insert('ganawileba',$ganawileba_data);

		redirect('main/distribution', 'location'); // საგნის ინფორმაციის შეყვანის შემდეგ გადამისამართდება საათობრივი განაწილების გვერდზე
	}

//სილაბუსის მონაცემები შეყავს მონაცემთა ბაზაში 
	public function add_syllabus()
	{

  				$this->db->select('*');
                $this->db->from('education_sphere');
                $this->db->where('id', $this->input->post("sphere_id"));
                $spherecode = $this->db->get()->row()->code;

                $this->db->select('*');
                $this->db->from('education_sphere');
                $this->db->where('id', $this->input->post("subsphere_id"));
                $subspherecode =  $this->db->get()->row()->code;

                $this->db->select('*');
                $this->db->from('faculties');
                $this->db->where('id', $this->input->post("faculty_id"));
                $facultycode =  $this->db->get()->row()->code;

                $this->db->select('*');
                $this->db->from('languages');
                $this->db->where('id', $this->input->post("language_id"));
                $language=  $this->db->get()->row();
                
                $this->db->select('*');
                $this->db->from('ganawileba');
                $this->db->where('sagani_ID', $this->input->post("subject_id"));
                $arr=  $this->db->get()->row(); 

                $str = "";
                if($arr->leqcia_sak > 0){
                    $str.="L";
                }
                if($arr->praqtikuli_sak > 0){
                    $str.="P";
                }
                if($arr->laboratoriuli_sak > 0){
                    $str.="B";
                }


		$syllabus_data =  array(
    	// 'date'=>curDate(),
    	'subject_id'=>$this->input->post("subject_id"),
    	'language_id'=>$this->input->post("language_id"),
    	'sphere_id'=>$this->input->post("sphere_id"),
    	'subsphere_id'=>$this->input->post("subsphere_id"),
    	'faculty_id'=>$this->input->post("faculty_id"),
    	'degree_id'=>$this->input->post("degree_id"),
    	'fullname'=>$this->input->post("fullname"),
    	'work_name'=>$this->input->post("work_name"),
    	'position_name'=>$this->input->post("position_name"),
    	'phone_number'=>$this->input->post("phone_number"),
    	'email'=>$this->input->post("email"),
    	'presubject_id'=>$this->input->post("presubject_id"),
    	'lec_1'=>$this->input->post("lec_1"),
    	'lec_2'=>$this->input->post("lec_2"),
    	'lec_3'=>$this->input->post("lec_3"),
    	'lec_4'=>$this->input->post("lec_4"),
    	'lec_5'=>$this->input->post("lec_5"),
    	'lec_6'=>$this->input->post("lec_6"),
    	'lec_7'=>$this->input->post("lec_7"),
    	'lec_8'=>$this->input->post("lec_8"),
    	'lec_9'=>$this->input->post("lec_9"),
    	'lec_10'=>$this->input->post("lec_10"),
    	'lec_11'=>$this->input->post("lec_11"),
    	'lec_12'=>$this->input->post("lec_12"),
    	'lec_13'=>$this->input->post("lec_13"),
    	'lec_14'=>$this->input->post("lec_14"),
    	'lec_15'=>$this->input->post("lec_15"),
    	'prac_1'=>$this->input->post("prac_1"),
    	'prac_2'=>$this->input->post("prac_2"),
    	'prac_3'=>$this->input->post("prac_3"),
    	'prac_4'=>$this->input->post("prac_4"),
    	'prac_5'=>$this->input->post("prac_5"),
    	'prac_6'=>$this->input->post("prac_6"),
    	'prac_7'=>$this->input->post("prac_7"),
    	'prac_8'=>$this->input->post("prac_8"),
    	'prac_9'=>$this->input->post("prac_9"),
    	'prac_10'=>$this->input->post("prac_10"),
    	'prac_11'=>$this->input->post("prac_11"),
    	'prac_12'=>$this->input->post("prac_12"),
    	'prac_13'=>$this->input->post("prac_13"),
    	'prac_14'=>$this->input->post("prac_14"),
    	'prac_15'=>$this->input->post("prac_15"),
    	'current_activity'=>$this->input->post("current_activity"),
    	'middle_exam'=>$this->input->post("middle_exam"),
    	'final_exam'=>$this->input->post("final_exam"),
    	'basiclit'=>$this->input->post("basiclit"),
    	'addtionallit'=>$this->input->post("addtionallit"),
    	'code'=>$spherecode.$subspherecode."01".$facultycode.$language->code."1-".$str,
    	);

		$this->db->insert('sylabus', $syllabus_data); 
		$insert_id = $this->db->insert_id();
		
		foreach ($this->input->post("goals") as $k => $val) {
			$last_id=$this->db->insert('goals_to_sylabus', array('sylabus_id' => $insert_id, 'goal_id' => $val)); 			
		}

		foreach ($this->input->post("results") as $k => $val) {
			$last_id=$this->db->insert('results_to_sylabus', array('sylabus_id' => $insert_id, 'result_id' => $val)); 			
		}

		foreach ($this->input->post("methods") as $k => $val) {
			$last_id=$this->db->insert('methods_to_sylabus', array('sylabus_id' => $insert_id, 'method_id' => $val)); 			
		}



		// $this->session->set_userdata('alert', 'სილაბუსი წარმატებით დაემატა');
		redirect('main/syl_distribution');

	}


//გამოაქვს სილაბუსების განაწილება 
	public function syl_distribution()
	{
		if (!$this->session->has_userdata('logged_in')) redirect('');
		// $data['sylabuses']=$this->Main_model->getSylabuses();
		$data['syl'] = $this->Main_model->getSylabuses();
        $data['content'] = 'content/syl_distribution';
        $this->load->view('index', $data);

	}

	public function prog_distribution()
	{
		if (!$this->session->has_userdata('logged_in')) redirect('');
		// $data['sylabuses']=$this->Main_model->getSylabuses();
		$data['prog'] = $this->Main_model->getPrograms();
        $data['content'] = 'content/prog_distribution';
        $this->load->view('index', $data);

	}








	public function editsubjview($id)
	{
		$data['subject']=$this->Main_model->sel_subj($id);
		$data['activity']=$this->Main_model->get_activities_by_subj_id($id);
		$data['activityes_qty']=$this->Main_model->get_activities_by_subj_id($id);

        $data['content'] = 'content/subj_edit';
        $this->load->view('index', $data);
	}


//სილაბუსის დარედაქტირებისთვის გამოიყენება
	public function editsylabusview($id)
	{
		if (!$this->session->has_userdata('logged_in')) redirect('');
		$data['sylabuses']=$this->Main_model->sel_sylabus($id);
		// $data['activity']=$this->Main_model->get_activities_by_subj_id($id);
		// $data['activityes_qty']=$this->Main_model->get_activities_by_subj_id($id);

        $data['content'] = 'content/sylabus_edit';
        $this->load->view('index', $data);
	}
	
	

	public function save_program()
	{
		$program=$this->input->post("subjects[]");
	}

	public function distribution()
	{
		
		if (!$this->session->has_userdata('logged_in')) redirect('');
		$data['ganawileba']=$this->Main_model->ganawileba();

        $data['content'] = 'content/subj_distribution';
        $this->load->view('index', $data);
		 // aq index da header footer unda davanawevro
	}

	public function Create_program()
	{
		if (!$this->session->has_userdata('logged_in')) redirect('');
		$data['sagnebi']=$this->Main_model->Get_subjects();
		$data['sylabuses'] = $this->Main_model->getSylabuses();
		$data['types']=$this->Main_model->GetType();



        $data['content'] = 'content/create_Learning_Program';
        $this->load->view('index', $data);
        // aq index da header footer unda davanawevro
	}

	// sagnis delete dasaweria ise rom ganawilebis cxrilidanac waishalos
	public function GetCredit(){
		$type_id=$this->input->post('id');
		$data['credit']=$this->Main_model->GetCredit($type_id);
		echo $data['credit']->kreditebis_raodenoba;
	}

//შედგენილი სილაბუსის მონაცემებით ქმნის დაბეჭდვად გვერდს რომელსაც სილაბუსის სახე აქვს
	public function syllabus(){

		// if (isset($_SESSION['logged_in']) && !$_SESSION['logged_in']) redirect(''); 
		if (!$this->session->has_userdata('logged_in')) redirect('');  

		$data['subjects']=$this->Main_model->Get_subjects();
		$data['distribution']=$this->Main_model->ganawileba();
		$data['results']=$this->Main_model->getResults();
		$data['goals']=$this->Main_model->getGoals();
		$data['methods']=$this->Main_model->getMethods();
		$data['spheros'] =$this->Main_model->get_spheres();
		$data['faculties'] =$this->Main_model->get_faculty();

		//$data['types']=$this->Main_model->GetType();

        $data['content'] = 'content/syllabus';
        $this->load->view('index', $data);
	}
		
	public function edu_program(){

		// if (isset($_SESSION['logged_in']) && !$_SESSION['logged_in']) redirect(''); 
		if (!$this->session->has_userdata('logged_in')) redirect('');  
		$data['sagnebi']=$this->Main_model->Get_subjects();
		$data['sylabuses'] = $this->Main_model->getSylabuses();
		$data['types']=$this->Main_model->GetType();
		$data['subjects']=$this->Main_model->Get_subjects();
		$data['distribution']=$this->Main_model->ganawileba();
		$data['results']=$this->Main_model->getEduResults();
		$data['goals']=$this->Main_model->getGoals();
		$data['methods']=$this->Main_model->getEduMethods();
		$data['spheros'] =$this->Main_model->get_spheres();
		$data['faculties'] =$this->Main_model->get_faculty();
		//$data['types']=$this->Main_model->GetType();

        $data['content'] = 'content/edu_program';
        $this->load->view('index', $data);
	}

	public function add_edu_program(){
		$progr_data =  array(
    	'edu_program_name_ka'=>$this->input->post("edu_program_name_ka"),
    	'edu_program_name_en'=>$this->input->post("edu_program_name_en"),
    	'faculty_id'=>$this->input->post("faculty_id"),
    	'fullname'=>$this->input->post("fullname"),
    	'qualification2'=>$this->input->post("qualification2"),
    	'program_goal'=>$this->input->post("program_goal"),
    	'language_id'=>$this->input->post("language_id"),
		'sphere'=>$this->input->post("sphere"),
		'requisite'=>$this->input->post("requisite"),
		'prerequisite'=>$this->input->post("prerequisite"),
		'degree_id'=>$this->input->post("program_type"),
		'1_st_year'=>$this->input->post("1_st_year"),
		'2_nd_year'=>$this->input->post("2_nd_year"),
		'3_rd_year'=>$this->input->post("3_rd_year"),
		'4_th_year'=>$this->input->post("4_th_year"),
    	);
		$degree_id=$this->input->post("program_type");
		$_st_year  = $this->input->post("1_st_year");
		$sylabuses1 = explode(",", $_st_year);

		$_nd_year  = $this->input->post("2_nd_year");
		$sylabuses2 = explode(",", $_nd_year);

		$_rd_year = $this->input->post("3_rd_year");
		$sylabuses3 = explode(",",$_rd_year);

		$_th_year = $this->input->post("4_th_year");
		$sylabuses4 = explode(",",$_th_year);

		// print_r($sylabuses3);
		// echo "--" . $degree_id."---";
		// print_r($sylabuses4);
		

		$this->db->insert('edu_programs', $progr_data); 
		$insert_id = $this->db->insert_id();

		foreach ($this->input->post("results") as $k => $val) {
			$last_id=$this->db->insert('results_to_program', array('program_id' => $insert_id, 'result_id' => $val)); 			
		}
				if($sylabuses1[0]!=""){
					foreach ($sylabuses1 as $k => $val) {
						$last_id=$this->db->insert('sylabuses_to_program', array('program_id' => $insert_id, 'sylabus_id' => $val, '1_st_year' => '1'));
					}
				}

				if($sylabuses2[0]!=""){
					foreach ($sylabuses2 as $k => $val) {
						$last_id=$this->db->insert('sylabuses_to_program', array('program_id' => $insert_id, 'sylabus_id' => $val, '2_nd_year' => '1'));
					}
				}


				if($sylabuses3[0]!=""){
					foreach ($sylabuses3 as $k => $val) {
						$last_id=$this->db->insert('sylabuses_to_program', array('program_id' => $insert_id, 'sylabus_id' => $val, '3_rd_year' => '1'));
					}
				}
				if($sylabuses4[0]!=""){
					foreach ($sylabuses4 as $k => $val) {
						$last_id=$this->db->insert('sylabuses_to_program', array('program_id' => $insert_id, 'sylabus_id' => $val, '4_th_year' => '1'));
					}
				}



		foreach ($this->input->post("methods") as $k => $val) {
			$last_id=$this->db->insert('methods_to_program', array('program_id' => $insert_id, 'method_id' => $val)); 			
		}

		// $this->session->set_userdata('alert', 'სილაბუსი წარმატებით დაემატა');
		redirect('main/prog_distribution');
	}




//საგნის წაშლის ფუნქცია
	public function del_subj(){
		$subject_id=$this->input->post('subj_id');
		$this->Main_model->delete_subject($subject_id);
	}
//სილაბუსის წაშლის ფუნქცია
	public function del_sylabus(){
		$syl_id=$this->input->post('syl_id');
		$this->Main_model->delete_sylabus($syl_id);
	}

//განაწილების გამოტანის ფუნქცია
 	public function getDistributions(){
 		$subject_id = $this->input->post('id');
		$data['dist'] =$this->Main_model->get_distr_by_subj($subject_id);
		return $this->load->view('content/getdist', $data);
 	}

//განაწილების გამოტანის ფუნქცია
 	public function getSphereSub()
 	{
 		$sphere_id=$this->input->post('sphere_id');
		$data['subspheres'] =$this->Main_model->get_subsphere_by_sphere_id($sphere_id);
		return $this->load->view('content/getSphere', $data);
 	}


 	public function  loadpdf(){
 		$this->load->library('pdf');
		$this->pdf->load_view('content/pdf');
		$this->pdf->Output();
 	}

	public function login()
	{
		$postData = $this->input->post();
        $validate = $this->Main_model->validate_login($postData);
        if ($validate){
			$newdata = array(
			        'username'  => 'johndoe',
			        'email'     => 'johndoe@some-site.com',
			        'logged_in' => TRUE
			);

			$this->session->set_userdata($newdata);
        	redirect('main/syllabus');
        }
        else{
        	redirect('');
        }
	}
	public function clogout() {
		$this->session->unset_userdata('logged_in');
		$this->session->sess_destroy();
        redirect('');
    }



}
