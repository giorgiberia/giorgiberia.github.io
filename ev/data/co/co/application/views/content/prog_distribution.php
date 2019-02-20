   
<link rel="stylesheet" type="text/css" href="<?=base_url()?>/assets/css/table-style.css" />
<link rel="stylesheet" type="text/css" href="<?=base_url()?>/assets/css/basictable.css" />
<div class="agile-grids">
    <!-- tables -->
    <div class="agile-tables">
        <div class="w3l-table-info">
            <h2>პროგრამები</h2>
            

            <table id="table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>პროგრამა</th>
              <!--       <th>ავტორი</th> -->
                    <th>რედაქტირება</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($prog as $row):?>


                    <tr>
                        <td><?php echo $row->id;?></td>
                        <td><?php echo $row->edu_program_name_ka;?></td>
                        <td>
                            <button onclick="del(<?=$row->id?>)"
                             class="btn btn-xs bg-danger dark pv20 text-white fw600 text-center" id="delete">წაშლა</button>
                            <a href="<?=base_url('main/editsylabusview/'.$row->id)?>" class="btn btn-xs bg-alert dark pv20 text-white fw600 text-center">რედაქტირება</a>
                            <a href="<?=base_url('main/program_pdf/'.$row->id)?>" target="_blank" class="btn btn-success btn-xs pv20 text-white fw600 text-center">გადმოწერა</a>
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