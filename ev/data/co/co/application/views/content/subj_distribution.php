<link rel="stylesheet" type="text/css" href="<?=base_url()?>/assets/css/table-style.css" />
<link rel="stylesheet" type="text/css" href="<?=base_url()?>/assets/css/basictable.css" />
<div class="agile-grids">
    <!-- tables -->
    <div class="agile-tables">
        <div class="w3l-table-info">
            <h2>განაწილების ცხრილი</h2>
            <table id="table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>დასახელება</th>
                    <th>საკ ლექცია</th>
                    <th>საკ პრაქტიკული</th>
                    <th>საკ ლაბორატორიული</th>
                    <th>დამ ლექცია</th>
                    <th>დამ პრაქტიკული</th>
                    <th>დამ ლაბორატორიული</th>
                    <th>შუალედური</th>
                    <th>დასკვნითი</th>
                    <th>რედაქტირება</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($ganawileba as $titoeuli):?>
                    <tr>
                        <td><?php echo $titoeuli->sagani_ID;?></td>
                        <td><?php echo $titoeuli->dasaxeleba;?></td>
                        <td><?php echo $titoeuli->leqcia_sak;?></td>
                        <td><?php echo $titoeuli->praqtikuli_sak;?></td>
                        <td><?php echo $titoeuli->laboratoriuli_sak;?></td>
                        <td><?php echo $titoeuli->leqcia_dam;?></td>
                        <td><?php echo $titoeuli->praqtikuli_dam;?></td>
                        <td><?php echo $titoeuli->laboratoriuli_dam;?></td>
                        <td><?php echo $titoeuli->shualeduri;?></td>
                        <td><?php echo $titoeuli->daskvniti;?></td>
                        <td>
                            <button onclick="del(<?=$titoeuli->sagani_ID?>)"
                             class="btn btn-xs bg-danger dark pv20 text-white fw600 text-center" id="delete">წაშლა</button>
                             <a href="<?=base_url('main/editsubjview/'.$titoeuli->sagani_ID)?>" class="btn btn-xs bg-alert dark pv20 text-white fw600 text-center">რედაქტირება</a>
                         
                        </td>


                    </tr>

                    <div class="modal fade" id="edit<?$key?>" role="dialog">
                        <div class="modal-dialog">
    
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Modal Header</h4>
                            </div>
                            <div class="modal-body">
                                <form action="" method="post">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="" name="">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="">
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                          </div>
      
                    </div>
                  </div>
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