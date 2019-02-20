              <?php  
                     $this->db->select('*');
                $this->db->from('subjects');
                $this->db->where('ID', $row->subject_id);
                $subject_name =  $this->db->get()->row()->dasaxeleba;

                $this->db->select('*');
                $this->db->from('education_sphere');
                $this->db->where('id', $row->sphere_id);
                $spherecode = $this->db->get()->row()->code;

                $this->db->select('*');
                $this->db->from('education_sphere');
                $this->db->where('id', $row->subsphere_id);
                $subspherecode =  $this->db->get()->row()->code;

                $this->db->select('*');
                $this->db->from('faculties');
                $this->db->where('id', $row->faculty_id);
                $facultycode =  $this->db->get()->row()->code;

                $this->db->select('*');
                $this->db->from('languages');
                $this->db->where('id', $row->language_id);
                $language=  $this->db->get()->row(); 

                // if ($syl->language_id == 1) {
                //  $lancode = 'G'; 
                // }else if($syl->language_id == 2){
                //  $lancode = 'R';
                // }else $lancode = 'E';

                $this->db->select('*');
                $this->db->from('ganawileba');
                $this->db->where('sagani_ID', $row->subject_id);
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
    
                $this->db->select('*');
                $this->db->from('degrees');
                $this->db->where('id', $row->degree_id);
                $degree =  $this->db->get()->row();

                $this->db->select('*');
                $this->db->from('goals_to_sylabus');
                $this->db->where('sylabus_id', $row->id);
                $goals =  $this->db->get()->result();

                $this->db->select('*');
                $this->db->from('subjects');
                $this->db->where('id', $row->presubject_id);     
                $presub_name =  $this->db->get()->row();

                $this->db->select('*');
                $this->db->from('results_to_');
                $this->db->where('sylabus_id', $row->id);
                $results =  $this->db->get()->result();

        ?>