
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?=base_url('main')?>/">მთავარი</a> <i class="fa fa-angle-right"></i></li>
        <li class="breadcrumb-item"><a href="<?=base_url('main/create_subject')?>">სილაბუსი</a> <i class="fa fa-angle-right"></i></li>
    </ol>
    <?php if (isset($logged_in)): ?>
                <div class="alert alert-danger" role="alert">
                  მომხ. shemosulia
                </div>
    <?php endif ?>
    <div class="grid-form">
        <div class="grid-form1">
            <h3>სილაბუსის შედგენის ფორმა</h3>

        <form class="form-horizontal" role="form" id="regForm" method="post" action="<?=base_url('main/add_syllabus')?>">
            <div class="tab">
                <h4 class="delimiter"><i class="fa fa-arrow-down" aria-hidden="true"></i>საგნის ტიპი</h4>
                                
                <div class="form-group">
                    <label for="selector1" class="col-sm-2 control-label">საგანი</label>
                    <div class="col-sm-8">
                    <select name="subject_id" id="subject1" class="form-control weneed">
                        <option selected>აირჩიეთ საგანი</option>
                        <?php foreach ($subjects as $key => $subject):?>
                        <option value="<?=$subject->ID;?>"><?=$subject->dasaxeleba;?></option>
                        <?php endforeach; ?>
                    </select>
                    </div>
                    <div class="col-sm-2">
                        <p class="code">Your help text!</p>
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


                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">სფერო</label>
                    <div class="col-sm-10">
                    <select name="sphere_id" class="form-control1 choosesphere">
                        <option>აირჩიეთ სფერო</option>
                        <?php foreach ($spheros as $key => $spe): ?>
                            <option value="<?=$spe->id?>"><?=$spe->name?></option>
                        <?php endforeach ?>
                    </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">ქვე სფერო</label>
                    <div class="col-sm-10">
                    <select name="subsphere_id" class="form-control1 showsubsphere">
                        <option>აირჩიეთ ქვე სფერო</option>
                    </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="selector1" class="col-sm-2 control-label">ფაკულტეტი</label>
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
                    <label for="selector1" class="col-sm-2 control-label">აკადემიური უმაღლესი განათლების საფეხური</label>
                    <div class="col-sm-10">
                    <select name="degree_id" id="selector1" class="form-control1" required>
                        <option value="Ba">ბაკალავრიატი</option>
                        <option value="2">მაგისტრატურა</option>
                        <option value="3">დოქტორანტურა</option>
                    </select>
                    </div>
                
                </div>
                
                <h4 class="delimiter"><i class="fa fa-arrow-down" aria-hidden="true"></i>ავტორი</h4>    

                <div class="form-group">
                    <label for="fullname" class="col-sm-2 control-label">გვარი, სახელი:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control1" name="fullname" placeholder="სახელი გვარი">
                    </div>
                </div>

                <div class="form-group">
                    <label for="subjects_credits" class="col-sm-2 control-label">სამუშაო ადგილი:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control1" name="work_name" placeholder="სამუშაო ადგილი">
                    </div>
                </div>

                <div class="form-group">
                    <label for="subjects_credits" class="col-sm-2 control-label">თანამდებობა:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control1" name="position_name" placeholder="თანამდებობა">
                    </div>
                </div>

                <div class="form-group">
                    <label for="subjects_credits" class="col-sm-2 control-label">ტელეფონი:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control1" name="phone_number" placeholder="599******">
                    </div>
                </div>

                <div class="form-group">
                    <label for="subjects_credits" class="col-sm-2 control-label">ელ-ფოსტა:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control1" name="email" placeholder="example@gmail.com">
                    </div>
                </div>
            </div>

            <div class="tab">
                   
                <h4 class="delimiter"><i class="fa fa-arrow-down" aria-hidden="true"></i>მიზნები</h4>                               
               
                    <?php foreach ($goals as $key => $goal): ?>
                     
                        <div class="checkbox">
                             <input type="checkbox"  name="goals[]" value="<?=$goal->id?>">  <?=$goal->name?>
                        </div>
                    <?php endforeach ?>
                   
                <h4 class="delimiter"><i class="fa fa-arrow-down" aria-hidden="true"></i>სწავლის შედეგები</h4>  
                <?php foreach ($results as $key => $result): ?>
                  
                  <div class="checkbox">
                             <input type="checkbox" name="results[]" value="<?=$result->id?>"> <?=$result->name?>
                  </div>

                <?php endforeach ?>
            </div>


            <div class="tab">
                <div class="form-group">
                    <label for="selector1" class="col-sm-2 control-label">წინაპირობა</label>
                    <div class="col-sm-8">
                    <select name="presubject_id" id="selector2" class="form-control1">
                        <option selected>არ გააჩნია</option>
                        <?php foreach ($subjects as $key => $subject):?>
                        <option value="<?=$subject->ID;?>"><?=$subject->dasaxeleba;?></option>
                        <?php endforeach; ?>
                    </select>
                    </div>
                       
                    <div class="col-sm-2">
                        <p class="code">Your help text!</p>
                    </div>
                </div>
              <!--   <h4 class="delimiter"><i class="fa fa-arrow-down" aria-hidden="true"></i>სწავლის შედეგების მიღწევის (სწავლება-სწავლის) მეთოდები</h4>  

                <div class="form-group showres"></div> -->

                <h4 class="delimiter"><i class="fa fa-arrow-down" aria-hidden="true"></i>სწავლება-სწავლის მეთოდების შესაბამისი აქტივობები:</h4>                              
               
                <?php foreach ($methods as $key => $meth): ?>
                    <div class="checkbox">
                             <input type="checkbox" name="methods[]" value="<?=$meth->id?>"> <?=$meth->name?>
                  </div>
                <?php endforeach ?>

            </div>
            <div class="tab">
                <h4 class="delimiter"><i class="fa fa-arrow-down" aria-hidden="true"></i>თემების დასახელება და შინაარსი ლექცია:</h4>      
                <table class="table">
                    <tr>
                        <th width="50" style="color:#fff">#</th>
                        <th>დასახელება</th>
                    </tr>
                    <tr>
                        <td>#1</td>
                        <td>
                            <div class="form-group">
                                <textarea rows="6" cols="4" name="lec_1" class="form-control"></textarea>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>#2</td>
                        <td>
                            <div class="form-group">
                                <textarea rows="6" cols="4" name="lec_2" class="form-control"></textarea>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>#3</td>
                        <td>
                            <div class="form-group">
                                <textarea rows="6" cols="4" name="lec_3" class="form-control"></textarea>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>#4</td>
                        <td>
                            <div class="form-group">
                                <textarea rows="6" cols="4" name="lec_4" class="form-control"></textarea>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>#5</td>
                        <td>
                            <div class="form-group">
                                <textarea rows="6" cols="4" name="lec_5" class="form-control"></textarea>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>#6</td>
                        <td>
                            <div class="form-group">
                                <textarea rows="6" cols="4" name="lec_6" class="form-control"></textarea>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>#7</td>
                        <td>
                            <div class="form-group">
                                <textarea rows="6" cols="4" name="lec_7" class="form-control"></textarea>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>#8</td>
                        <td>
                            <div class="form-group">
                                <textarea rows="6" cols="4" name="lec_8" class="form-control"></textarea>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>#9</td>
                        <td>
                            <div class="form-group">
                                <textarea rows="6" cols="4"  name="lec_9" class="form-control"></textarea>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>#10</td>
                        <td>
                            <div class="form-group">
                                <textarea rows="6" cols="4" name="lec_10" class="form-control"></textarea>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>#11</td>
                        <td>
                            <div class="form-group">
                                <textarea rows="6" cols="4" name="lec_11" class="form-control"></textarea>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>#12</td>
                        <td>
                            <div class="form-group">
                                <textarea rows="6" cols="4" name="lec_12" class="form-control"></textarea>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>#13</td>
                        <td>
                            <div class="form-group">
                                <textarea rows="6" cols="4" name="lec_13" class="form-control"></textarea>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>#14</td>
                        <td>
                            <div class="form-group">
                                <textarea rows="6" cols="4" name="lec_14" class="form-control"></textarea>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>#15</td>
                        <td>
                            <div class="form-group">
                                <textarea rows="6" cols="4" name="lec_15" class="form-control"></textarea>
                            </div>
                        </td>
                    </tr>
                </table>                         
                
                
            </div>
            <div class="tab">
                <h4 class="delimiter"><i class="fa fa-arrow-down" aria-hidden="true"></i>თემების დასახელება და შინაარსი პრაქტიკული:</h4>      
                <table class="table">
                    <tr>
                        <th width="50" style="color:#fff">#</th>
                        <th>დასახელება</th>
                    </tr>
                    <tr>
                        <td>#1</td>
                        <td>
                            <div class="form-group">
                                <textarea rows="6" cols="4" name="prac_1" class="form-control"></textarea>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>#2</td>
                        <td>
                            <div class="form-group">
                                <textarea rows="6" cols="4" name="prac_2" class="form-control"></textarea>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>#3</td>
                        <td>
                            <div class="form-group">
                                <textarea rows="6" cols="4"  name="prac_3" class="form-control"></textarea>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>#4</td>
                        <td>
                            <div class="form-group">
                                <textarea rows="6" cols="4" name="prac_4" class="form-control"></textarea>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>#5</td>
                        <td>
                            <div class="form-group">
                                <textarea rows="6" cols="4" name="prac_5" class="form-control"></textarea>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>#6</td>
                        <td>
                            <div class="form-group">
                                <textarea rows="6" cols="4" name="prac_6" class="form-control"></textarea>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>#7</td>
                        <td>
                            <div class="form-group">
                                <textarea rows="6" cols="4" name="prac_7" class="form-control"></textarea>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>#8</td>
                        <td>
                            <div class="form-group">
                                <textarea rows="6" cols="4" name="prac_8" class="form-control"></textarea>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>#9</td>
                        <td>
                            <div class="form-group">
                                <textarea rows="6" cols="4" name="prac_9" class="form-control"></textarea>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>#10</td>
                        <td>
                            <div class="form-group">
                                <textarea rows="6" cols="4" name="prac_10" class="form-control"></textarea>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>#11</td>
                        <td>
                            <div class="form-group">
                                <textarea rows="6" cols="4" name="prac_11" class="form-control"></textarea>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>#12</td>
                        <td>
                            <div class="form-group">
                                <textarea rows="6" cols="4" name="prac_12" class="form-control"></textarea>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>#13</td>
                        <td>
                            <div class="form-group">
                                <textarea rows="6" cols="4" name="prac_13"  class="form-control"></textarea>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>#14</td>
                        <td>
                            <div class="form-group">
                                <textarea rows="6" cols="4" name="prac_14" class="form-control"></textarea>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>#15</td>
                        <td>
                            <div class="form-group">
                                <textarea rows="6" cols="4" name="prac_15" class="form-control"></textarea>
                            </div>
                        </td>
                    </tr>
                </table> 
            </div>
            <div class="tab">
                <h4 class="delimiter"><i class="fa fa-arrow-down" aria-hidden="true"></i>შეფასების ფორმები და კრიტერიუმები:</h4>      
                <table class="table">
                    <tr>
                        <th width="50" style="color:#fff">#</th>
                        <th>დასახელება</th>
                    </tr>
                    <tr>
                        <td>#1</td>
                        <td>
                            <div class="form-group">
                                <label>მიმდინარე აქტივობა</label>
                                <textarea rows="6" cols="4" class="form-control" name="current_activity"></textarea>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>#2</td>
                        <td>
                            <div class="form-group">
                                <label>შუასემესტრული გამოცდა</label>
                                <textarea rows="6" cols="4" class="form-control" name="middle_exam"></textarea>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>#3</td>
                        <td>
                            <div class="form-group">
                                <label>დასკვნითი/დამატებითი გამოცდა</label>
                                <textarea rows="6" cols="4" class="form-control" name="final_exam"></textarea>
                            </div>
                        </td>
                    </tr>
                </table> 
                 <div class="form-group">
                                <label>დამატებითი ლიტერატურა</label>
                                <textarea rows="6" cols="4" class="form-control" name="basiclit"></textarea>
                 </div>

                 <div class="form-group">
                                <label>დამატებითი ლიტერატურა</label>
                                <textarea rows="6" cols="4" class="form-control" name="addtionallit"></textarea>
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
  if (n == 1 && !validateForm()) return false;
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
