   
<link rel="stylesheet" type="text/css" href="<?=base_url()?>/assets/css/table-style.css" />
<link rel="stylesheet" type="text/css" href="<?=base_url()?>/assets/css/basictable.css" />
<div class="agile-grids">
    <!-- tables -->
    <div class="agile-tables">
        <div class="w3l-table-info">
            <h2>სილაბუსები</h2>
            

            <table id="table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>საგანი</th>
              <!--       <th>ავტორი</th> -->
                    <th>კოდი</th>
                    <th>რედაქტირება</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($syl as $row):?>
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
                $this->db->from('results_to_sylabus');
                $this->db->where('sylabus_id', $row->id);
                $results =  $this->db->get()->result();

        ?>
                    <tr>
                        <td><?php echo $row->id;?></td>
                        <td><?php echo $row->dasaxeleba;?></td>
                        <td><?=$spherecode.$subspherecode."01".$facultycode.$language->code."1-".$str?></td>
                        <!-- <td><?php echo $titoeuli->work_name;?></td>
                        <td><?php echo $titoeuli->position_name;?></td>
                        <td><?php echo $titoeuli->phone_number;?></td>
                        <td><?php echo $titoeuli->email;?></td> -->
                        <!-- <td><h1>სასწავლო კურსის კოდი: <?=$spherecode.$subspherecode."00".$facultycode.$language->code."1-".$str?></h1><br></td> -->
                        <td>
                            <button onclick="del(<?=$row->id?>)"
                             class="btn btn-xs bg-danger dark pv20 text-white fw600 text-center" id="delete">წაშლა</button>
                            <a href="<?=base_url('main/editsylabusview/'.$row->id)?>" class="btn btn-xs bg-alert dark pv20 text-white fw600 text-center">რედაქტირება</a>
                            <a href="<?=base_url('main/syl_pdf/'.$row->id)?>" target="_blank" class="btn btn-success btn-xs pv20 text-white fw600 text-center">გადმოწერა</a>
                        </td>


                    </tr>
                <?php endforeach;?>
                </tbody>
            </table>
        </div>

    </div>
</div>

<script>

function del(id)
{
                 swal({
                        title: 'წავშალოთ?',
                        text: id,
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'დიახ',
                        cancelButtonText: 'არა',
                        confirmButtonClass: 'btn btn-success',
                        cancelButtonClass: 'btn btn-danger',
                        buttonsStyling: false,
                        reverseButtons: true
                    }).then((result) => {
                            if (result.value) {
                           

                                $.ajax({
                                    type:"post",   
                                    url: "<?=base_url()?>main/del_sylabus",
                                    data: {subj_id:id},
                                    success: function(){
                                            swal(
                                            'წაიშალა!',
                                             '',
                                            'success'
                                            )
                                            window.location="<?=base_url()?>main/syl_distribution/"
                                            }
                                        });
                            } else if (
                        // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                    ) {
                        swal(
                            'გაუქმდა',
                            '',
                            'error'
                        )
                    }
                })


}

function red(id)
{
                 swal({
                        title: 'წავშალოთ?',
                        text: id,
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'დიახ',
                        cancelButtonText: 'არა',
                        confirmButtonClass: 'btn btn-success',
                        cancelButtonClass: 'btn btn-danger',
                        buttonsStyling: false,
                        reverseButtons: true
                    }).then((result) => {
                            if (result.value) {
                           

                                $.ajax({
                                    type:"post",   
                                    url: "<?=base_url()?>main/del_subj",
                                    data: {subj_id:id},
                                    success: function(){
                                            swal(
                                            'წაიშალა!',
                                             '',
                                            'success'
                                            )
                                            window.location="<?=base_url()?>main/distribution/"
                                            }
                                        });
                            } else if (
                        // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                    ) {
                        swal(
                            'გაუქმდა',
                            '',
                            'error'
                        )
                    }
                })


}


       
</script>