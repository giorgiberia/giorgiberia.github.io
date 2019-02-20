
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?=base_url('main')?>/">მთავარი</a> <i class="fa fa-angle-right"></i></li>
        <li class="breadcrumb-item"><a href="<?=base_url('main/edu_program')?>">საგანმათლებლო პროგრამა</a> <i class="fa fa-angle-right"></i></li>
    </ol>

    <style>
    #divi {
        border: 1px solid #aaaaaa;
    }
    td { text-align:left; vertical-align:top; padding:0}

    .box{
      border: 1px solid grey;
      scroll-behavior: auto;
      overflow-y: scroll;
      height: 400px;
      }
</style>
<script>
		function prep(){
    	
    	var innerDivId='';
   		$('#box_1 .draggable-items').each(function() {
            var innerDivId = $(this).attr('id');
            $("#1_st_year").val($("#1_st_year").val()+innerDivId+",");
      });
      $("#1_st_year").val($("#1_st_year").val().slice(0,-1));
      $('#box_2 .draggable-items').each(function() {
            var innerDivId = $(this).attr('id');
            $("#2_nd_year").val($("#2_nd_year").val()+innerDivId+",");
        });
      $("#2_nd_year").val($("#2_nd_year").val().slice(0,-1));
   		$('#box_3 .draggable-items').each(function() {
            var innerDivId = $(this).attr('id');
            $("#3_rd_year").val($("#3_rd_year").val()+innerDivId+",");
        });
      $("#3_rd_year").val($("#3_rd_year").val().slice(0,-1));
   		$('#box_4 .draggable-items').each(function() {
            var innerDivId = $(this).attr('id');
            $("#4_th_year").val($("#4_th_year").val()+innerDivId+",");
        });
    	}
      $("#4_th_year").val($("#4_th_year").val().slice(0,-2));

</script>
    <?php if (isset($logged_in)): ?>
                <div class="alert alert-danger" role="alert">
                  მომხ. shemosulia
                </div>
    <?php endif ?>
    <div class="grid-form">
        <div class="grid-form1">
            <h3>საგანმათლებლო პროგრამის  შედგენის ფორმა</h3>
        <form class="form-horizontal" role="form" id="regForm" method="post" action="<?=base_url('main/add_edu_program')?>">
            <div class="tab">

                 <div class="form-group">
                    <label for="edu_program_name_ka" class="col-sm-2 control-label">პროგრამის სახელწოდება </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control1" name="edu_program_name_ka" placeholder="მაგ:ინფორმატიკა">
                    </div>
                 </div>

                   <div class="form-group">
                    <label for="edu_program_name_en" class="col-sm-2 control-label">Program name </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control1" name="edu_program_name_en" placeholder="Ex: Informatics">
                    </div>
                 </div>

                <div class="form-group">
                    <label for="faculty_id" class="col-sm-2 control-label">ფაკულტეტი</label>
                    <div class="col-sm-10">
                    <select name="faculty_id" class="form-control">
                        <option>აირჩიეთ ფაკულტეტი</option>
                        <?php foreach ($faculties as $key => $fac):?>
                        <option value="<?=$fac->id;?>"><?=$fac->name;?></option>
                        <?php endforeach; ?>
                    </select>
                    </div>                  
                </div>
 

                <div class="form-group">
                    <label for="fullname" class="col-sm-2 control-label">პროგრამის ხელმძღვანელი:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control1" name="fullname" placeholder="სახელი გვარი">
                    </div>
                </div>

                <div class="form-group">
                    <label for="qualification2" class="col-sm-2 control-label">მისანიჭებელი კვალიფიკაცია:</label>
                    <div class="col-sm-10">
                     <textarea rows="6" cols="4" name="qualification2" class="form-control">ინფორმატიკის ბაკალავრი (Bachelor  in Informatics)მიენიჭება საგანმანათლებლო პროგრამაში არსებული მოკლე ციკლის და თავისუფალი კომპონენტების ან/და დამატებითი სპეცილობების კომბინირებით არანაკლებ 240 კრედიტის შესრულების შემთხვევაში
                    </textarea>
                    </div>
                </div>
               
                <div class="form-group">
                    <label for="program_goal" class="col-sm-2 control-label">სასწავლო კურსის მიზანი:</label>
                    <div class="col-sm-10">
                    <textarea rows="6" cols="4" name="program_goal" class="form-control col-sm-10">სასწავლო კურსის მიზანია ... 
                    </textarea>
                    </div>
                </div>


                <div class="form-group">
                    <label for="selector1" class="col-sm-2 control-label">სწავლების ენა</label>
                    <div class="col-sm-10">
                    <select name="language_id" id="selector1" class="form-control1">
                        <option value="1">ქართულად</option>
                        <option value="2">რუსულად</option>
                        <option value="3">ინგლისურად</option>
                    </select>
                    </div>
                </div>
  			</div> 

            <div class="tab">
                  
                   
                <h4 class="delimiter"><i class="fa fa-arrow-down" aria-hidden="true"></i>სწავლის შედეგები</h4>  
                <?php foreach ($results as $key => $result): ?>
                    <div class="checkbox">
                 
                            <div class="col-sm-1"><input type="checkbox" name="results[]" value="<?=$result->id?>"></div>
                            <div class="col-sm-11">
                                <?=$result->name?><br><br><br>
                            </div>
 
                    </div>
                <?php endforeach ?>
                <h4 class="delimiter"><i class="fa fa-arrow-down" aria-hidden="true"></i>სწავლის შედეგების მიღწევის ფორმები და მეთოდები</h4>
                <?php foreach ($methods as $key => $meth): ?>
                    <div class="checkbox">
                           <div class="col-sm-1"><input type="checkbox" name="methods[]" value="<?=$meth->id?>"></div>
                           
                            <div>     <?=$meth->name?><br><br><br></div>
                            
                    </div>
                <?php endforeach ?>

            

            </div>




            <div class="tab">
              
                <div class="form-group">
                    <label for="sphere" class="col-sm-2 control-label">დასაქმების სფერო:</label>
                    <div class="col-sm-10">
                    <textarea rows="6" cols="4" name="sphere" id="sphere"  class="form-control col-sm-10">საგანმანათლებლო, სამეცნიერო-კვლევითი, საწარმოო, სამეურნეო და სხვა დაწესებულებები, სახელისუფლებო და კერძო სტრუქტურები, რომელთაც ესაჭიროებათ საინფორმაციო ტექნოლოგიებისა და კომპიუტრული მოდელირების უმაღლესი კვალიფიკაციის მქონე სპეციალისტები</textarea>
                    </div>
                </div>                     
                
             <div class="form-group">
                    <label for="requisite" class="col-sm-2 control-label">პროგრამის განხორციელებისათვის აუცილებელი ადამიანური და  მატერიალური რესურსი:</label>
                    <div class="col-sm-10">
                    <textarea rows="6" cols="4" name="requisite" id="requisite"  class="form-control col-sm-10">ფაკულტეტის განკარგულებაშია 225200 კვ.მ. საერთო ფართი,სამი კომპიუტერული ცენტრი: 300 კომპიუტრით, 170 კომპიუტრით და 100 კომპიუტერით, ორი საფაკულტეტო სასწავლო-სამეცნიერო ლაბორატორია, რომელთა შემადგენლობაშია 51-ზე მეტი სასწავლო აუდიტორია, უნივერსიტეტის და ფაკულტეტის ბიბლიოთეკები, უნივერსიტეტის პოლიკნინიკა, I, II და IX კორპუსებში განთავსებული სპორტული დარბაზები, სასწავლო პროცესის მონიტორინგის ელექტრონული სისტემების უზრუნველყოფის ჯგუფი. დაგეგმილია ინფორმატიკის და მართვის სისტემების სასწავლო-კვლევითი ლაბორატორიის მნიშვნელოვანი გადაირაღება  და   აუდიტორიების აღჭურვა უახლესი სადემონსტრაციო ტექნიკით.</textarea>
                    </div>
                </div>

            </div>

            <div class="tab">
                       <div class="form-group">
            <label for="level" class="col-sm-2 control-label">აირჩიეთ საგანმანათლებლო პროგრამის ტიპი:</label>
            <div class="col-sm-8">
                <select name="program_type" id="level" class="form-control1">
                    <?php foreach ($types as $key => $type): ?>
                        <option value="<?=$type->ID;?>"> <?=$type->saxeli;?></option>                                
                    <?php endforeach ?>
                </select>
            </div>
            <div class="col-sm-2">
                <div id="credits" name="credits" class="btn btn-info" disabled style="color:red;"> 240 კრედიტი / 4 წელი </div>
            </div>
        </div>

        <div class="form-group">
            <label for="prerequisite" class="col-sm-2 control-label">პროგრამაზე დაშვების წინაპირობა:</label>
            <div class="col-sm-10">
            <textarea rows="6" cols="4" name="prerequisite" id="prerequisite" class="form-control col-sm-10">ბაკალავრიატში სწავლის უფლება აქვს მხოლოდ სრული ზოგადი განათლების დამადასტურებელი სახლემწიფო სერტიფიკატის ან მასთან გათანაბრებული დოკუმენტის მფლობელს, რომელიც ჩაირიცხება საქართველოს კანონმდებლობით დადგენილი წესით
            </textarea>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-12">
              <div class="col-md-10">
                <div class="form-group">
                  <div class="col-sm-3 first_year">
                    <label for="year">I სასწავლო წელი</label>
                      <div id="box_1" class="box" ondrop="drop(event)" ondragover="allowDrop(event)">

                      </div>
                  </div>
                  <div class="col-sm-3 second_year">
                    <label for="year">II სასწავლო წელი</label>
                      <div id="box_2" class="box" ondrop="drop(event)" ondragover="allowDrop(event)">

                      </div>
                  </div>

                  <div class="col-sm-3 third_year">
                    <label for="year">III სასწავლო წელი</label>
                      <div id="box_3" class="box" ondrop="drop(event)" ondragover="allowDrop(event)">

                      </div>
                  </div>
                  <div class="col-sm-3 fourth_year">
                    <label for="year">IV სასწავლო წელი</label>
                      <div id="box_4" class="box" ondrop="drop(event)" ondragover="allowDrop(event)">

                      </div>
                  </div>
                </div>
              </div>
              <div class="col-md-2">
                <label for="year">სილაბუსის ჩამონათვალი</label>
                <div class="box" ondrop="drop(event)" ondragover="allowDrop(event)">
                    <?php foreach ($sylabuses as $key => $sylabus): ?>
                        <div id="<?php echo $sylabus->id;?>" class="btn btn-default draggable-items"  draggable="true" ondragstart="drag(event)">
                            <?php echo $sylabus->dasaxeleba;?>
                            <br>
                            <?php echo $sylabus->code;?>
                        </div>
                    <?php endforeach ?>
                    
                </div>
              </div>
              <div class="col-md-3">
                  <input type="text" id="1_st_year" name="1_st_year">
              </div>
                <div class="col-md-3">
                  <input type="text" id="2_nd_year" name="2_nd_year">
              </div>
                <div class="col-md-3" >
                  <input type="text" id="3_rd_year" name="3_rd_year">
              </div>
                <div class="col-md-3" >
                  <input type="text" id="4_th_year" name="4_th_year">
              </div>
                  <button type="button" id="prepare" onclick="prep()">Prepare</button>
            </div>
        </div>


            </div>

            <div style="overflow:auto;">
              <div style="float:right;">
                <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
              </div>
            </div>

            <!-- Circles which indicates the steps of the form: -->
            <div style="text-align:center;margin-top:40px;">
              <span class="step"></span>
              <span class="step"></span>
              <span class="step"></span>
              <span class="step"></span>

            </div>

</form>

</div>
</div>


		<!--grid-->


<script type="text/javascript">

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

    $('.weneed').change(function(){
        var id = $(this).val();
        $.ajax({
            method: "POST",
            url: "<?=base_url('main/getDistributions')?>",
            data: {id: id},
        }).done(function( data ) {             
              $('.showres').html(data);
        });         
    }); 

    $('.choosesphere').change(function(){
        var id = $(this).val();
        $.ajax({
            method: "POST",
            url: "<?=base_url('main/getSphereSub')?>",
            data: {sphere_id: id},
        }).done(function( data ) {             
              $('.showsubsphere').html(data);
        });         
    });
        
</script>
<script type="text/javascript">
   var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

function showTab(n) {
  // This function will display the specified tab of the form ...
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  // ... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    document.getElementById("nextBtn").innerHTML = "Submit";
  } else {
    document.getElementById("nextBtn").innerHTML = "Next";
  }
  // ... and run a function that displays the correct step indicator:
  fixStepIndicator(n)
}

function nextPrev(n) {
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  // Exit the function if any field in the current tab is invalid:
  //if (n == 1) return false;
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // if you have reached the end of the form... :
  if (currentTab >= x.length) {
    //...the form gets submitted:
    document.getElementById("regForm").submit();
    return false;
  }
  // Otherwise, display the correct tab:
  showTab(currentTab);
}

function validateForm() {
  // This function deals with validation of the form fields
  var x, y, i, valid = true;
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByTagName("input");
  // A loop that checks every input field in the current tab:
  for (i = 0; i < y.length; i++) {
    // If a field is empty...
    if (y[i].value == "") {
      // add an "invalid" class to the field:
      y[i].className += " invalid";
      // and set the current valid status to false:
      valid = false;
    }
  }
  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }
  return valid; // return the valid status
}

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class to the current step:
  x[n].className += " active";
}
</script>

<script>
    function allowDrop(ev) {
        ev.preventDefault();
    }

    function drag(ev) {
        ev.dataTransfer.setData("text", ev.target.id);
    }

    function drop(ev) {
        ev.preventDefault();
        var data = ev.dataTransfer.getData("text");
        ev.target.appendChild(document.getElementById(data));
    }


	

  $("#level").change(function(){
                if ($("#level").val()=='1'){
                    $("#credits").html("240 კრედიტი / 4 წელი");
                    $("#prerequisite").html("ბაკალავრიატში სწავლის უფლება აქვს მხოლოდ სრული ზოგადი განათლების დამადასტურებელი სახლემწიფო სერტიფიკატის ან მასთან გათანაბრებული დოკუმენტის მფლობელს, რომელიც ჩაირიცხება საქართველოს კანონმდებლობით დადგენილი წესით");
                    $(".first_year").show();
                    $(".second_year").show();
                    $(".third_year").show();
                    $(".fourth_year").show();
                    $("#1_st_year").show();
                    $("#2_nd_year").show();
                    $("#3_rd_year").show();
                    $("#4_th_year").show();
                }
                else if ($("#level").val()=='2'){
                    $("#credits").html("120 კრედიტი / 2 წელი");
                    $(".first_year").show();
                    $("#prerequisite").html("ბაკალავრის ან მასთან გათანაბრებული აკადემიური ხარისხის დიპლომი."); 
                    $(".second_year").show();
                    $(".third_year").hide();
                    $(".fourth_year").hide();
                    $("#1_st_year").show();
                    $("#2_nd_year").show();
                    $("#3_rd_year").hide();
                    $("#4_th_year").hide();
                }
                else if ($("#level").val()=='3'){
                    $("#credits").html("180 კრედიტი / 3 წელი");
                    $("#prerequisite").html("მაგისტრის ან მასთან გათანაბრებული აკადემიური ხარისხის დიპლომი."); 
                    $(".first_year").show();
                    $(".second_year").show();
                    $(".third_year").show();
                    $(".fourth_year").hide();
                    $("#1_st_year").show();
                    $("#2_nd_year").show();
                    $("#3_rd_year").show();
                    $("#4_th_year").hide();

                }
        });
</script>
