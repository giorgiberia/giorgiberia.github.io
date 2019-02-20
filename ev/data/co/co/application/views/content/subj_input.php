
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?=base_url()?>main/">მთავარი</a> <i class="fa fa-angle-right"></i></li>
    <li class="breadcrumb-item"><a href="<?=base_url()?>main/create_subject">საგნის დამატება</a> <i class="fa fa-angle-right"></i></li>
</ol>

		<!--grid-->
 	<div class="grid-form">

        <div class="grid-form1">
  	       <h3>საგნის შეყვანის ფორმა</h3>
  	         <div class="tab-content">
						<div class="tab-pane active" id="horizontal-form">

							<form class="form-horizontal" role="form" id="subject_form"  method="post" action="<?=base_url()?>main/add_subject">
								<div class="form-group">
									<label for="subject_name" class="col-sm-2 control-label">საგნის სახელი</label>
									<div class="col-sm-10">
										<input type="text" class="form-control1" name="subject_name" id="subject_name" placeholder="შეიყვანეთ საგნის სახელი">
									</div>
                                </div>

								<div class="form-group">
									<label for="credits_in_hour" class="col-sm-2 control-label">კრედიტები საათში</label>
									<div class="col-sm-10">
										<input type="text"  class="form-control1" name="credits_in_hour" id="credits_in_hour" placeholder="შეიყვანეთ თუ რამდენი კრედიტია ერთი საათი თქვენი დაწესებულების მიხედვით">
									</div>
								</div>


								<div class="form-group">
									<label for="subjects_credits" class="col-sm-2 control-label">რამდენ კრედიტიანია საგანი</label>
									<div class="col-sm-10">
										<input type="text" class="form-control1" id="subjects_credits" name="subjects_credits" placeholder="შეიყვანეთ თუ რამდენ კრედიტიანია საგანი">
									</div>
								</div>

								<div class="form-group">
									<div class="col-sm-10">
									<label for="credits_to_split" class="col-sm-8 control-label">გასანაწილებელი კრედიტები</label>
										<input type="number" name="credits_to_split" value="0" disabled id="credits_to_split" class="col-sm-2 bg-alert dark pv20 text-white fw600 text-center">
									</div>
								</div>

								<div class="four-grids">
									<?php foreach ($activityes as $key => $activity):?>

										<div class="col-md-4 four-grid" style="padding-bottom: 10px;">
											<div class="four-agileits">

												<div class="four-text">
													<h5><?=$activity->name?></h5>
                                                    <div class="col-sm-12">
                                                        <div class="col-sm-3">
													    <div id="subs<?=$activity->id?>" width="50%" onclick="subs(<?=$activity->id?>)"  class="col-sm-2">
														<i class="fa fa-minus-circle"></i>
													    </div>
                                                        </div>
                                                        <div class="col-sm-6">
												        	<input readonly size="5" type="text" name="value<?=$activity->id?>" id="value<?=$activity->id?>" value='0'>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <div id="add<?=$activity->id?>" width="50%" onclick="add(<?=$activity->id?>)"  class="col-sm-2">
                                                                <i class="fa fa-plus-circle"></i>
                                                            </div>
                                                        </div>
                                                    </div>

												</div>

											</div>
										</div>


									<?php endforeach; ?>



										<div class="clearfix">

                                        </div>
									<p style="display: none;" id="qty_of_activityes">
										<?=$activityes_qty;?>
									</p>

                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label for="exampleInputFile">ასატვირთი დოკუმენტაცია</label>
                                                <input id="exampleInputFile" type="file">
                                            </div>
                                        </div>

                                    <div class="col-md-7">
                                        <button type="button" class="btn-primary btn" id="save">შენახვა</button>
                                        <button class="btn-default btn">განულება</button>
                                    </div>
                            </form>

                        </div>
                  </div>


            </div>
    </div>


<script>

			$(document).on('change', '#subjects_credits', function() {

				var subj_name=$('#subject_name').val();
				var credits_in_hour=$('#credits_in_hour').val();
				var subjects_credits=$('#subjects_credits').val();
				$('#credits_to_split').val(credits_in_hour*subjects_credits);
			});


function add($id)
{

					var $button=$('#add'+$id);

					var oldvalue = parseInt($('#credits_to_split').val());

					$('#credits_to_split').val(parseInt(oldvalue-5));

					var olddamo=parseInt($('#value'+$id).val());

					$('#value'+$id).val(parseInt(olddamo+5));

}
function subs($id)
{

					var $button=$('#subs'+$id);

					var oldvalue = parseInt($('#credits_to_split').val());

					$('#credits_to_split').val(parseInt(oldvalue+5));

					var olddamo=parseInt($('#value'+$id).val());

					$('#value'+$id).val(parseInt(olddamo-5));



}

            $('#save').click(function(){
                if ($('#credits_to_split').val()!=0){
                swal(
                    'კრედიტები არასწორად არის განაწილებული!',
                    'გთხოვთ თავიდან გადაანაწილოთ!',
                    'error'
                    )
                }
                else if($('#credits_to_split').val()==0){
                    swal({
                        title: 'დავამატოთ ბაზაში?',
                        text: "საათები განაწილებულია!",
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
                        swal(
                            'საგანი წარმატებით დაემატა!',
                            '',
                            'success'
                        )
                        $("#subject_form").submit();
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
            });

</script>

