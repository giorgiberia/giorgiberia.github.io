<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?=base_url('main')?>">მთავარი</a> <i class="fa fa-angle-right"></i></li>
    <li class="breadcrumb-item"><a href="<?=base_url('main/create_program')?>">პროგრამის დამატება</a> <i class="fa fa-angle-right"></i></li>
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

<div class="grid-form1">    
    <form class="form-horizontal">
        <div class="form-group">
            <label for="focusedinput" class="col-sm-4 control-label">საგანმანათლებლო პროგრამის დასახელება</label>
            <div class="col-sm-6">
                <input class="form-control1" id="focusedinput" placeholder="მაგ: კომპ. მეცნიერება" type="text">
            </div>
        </div>
        <div class="form-group">
            <label for="selector1" class="col-sm-4 control-label">აირჩიეთ საგანმანათლებლო პროგრამის ტიპი:</label>
            <div class="col-sm-4">
                <select name="selector1" id="selector1" class="form-control1">
                    <?php foreach ($types as $key => $type): ?>
                        <option value="<?=$type->ID;?>"> <?=$type->saxeli;?></option>                                
                    <?php endforeach ?>
                </select>
            </div>
            <div class="col-sm-2">
                <div id="credits" class="btn btn-info" disabled style="color:red;"> 240 კრედიტი / 4 წელი </div>
            </div>
            <div class="col-sm-2">
                <div id="" class="btn btn-info" disabled style="color:red;"> არჩეული სულ :5  </div>
            </div>

        </div>

        <div class="form-group">
            <div class="col-md-12">
              <div class="col-md-10">
                <div class="form-group">
                  <div class="col-sm-3 first_year">
                    <label for="year">I სასწავლო წელი</label>
                      <div class="box" ondrop="drop(event)" ondragover="allowDrop(event)">

                      </div>
                  </div>
                  <div class="col-sm-3 second_year">
                    <label for="year">II სასწავლო წელი</label>
                      <div class="box" ondrop="drop(event)" ondragover="allowDrop(event)">

                      </div>
                  </div>

                  <div class="col-sm-3 third_year">
                    <label for="year">III სასწავლო წელი</label>
                      <div class="box" ondrop="drop(event)" ondragover="allowDrop(event)">

                      </div>
                  </div>
                  <div class="col-sm-3 fourth_year">
                    <label for="year">IV სასწავლო წელი</label>
                      <div class="box" ondrop="drop(event)" ondragover="allowDrop(event)">

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
                        </div>
                    <?php endforeach ?>
                    
                </div>
              </div>
            </div>
        </div>
        <div class="form-group">
            <label for="exampleInputFile">ასატვირთი დოკუმენტაცია</label>
            <input id="exampleInputFile" type="file">
        </div>

        <div class="panel-footer">
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2">
                    <button class="btn-primary btn" id="save">შენახვა</button>
                    <button class="btn-inverse btn">განულება</button>
                </div>
            </div>
        </div>

    </form>

   
</div>

<script type="text/javascript">
    var subjects=[];
    $('#save').click(function(){
        $('#divi .draggable-items').each(function() {
            var innerDivId = $(this).attr('id');
            subjects.push(innerDivId);
        });

        $.ajax({
            type: "POST",
            data: {subjects:subjects},
            url: "save_program",
            success: function(msg){
                $('.answer').html(msg);
            }
        });
    });

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
        $('#divi .draggable-items').each(function() {
            var innerDivId = $(this).attr('id');

        });
    }

   
        $("#selector1").change(function(){
                if ($("#selector1").val()=='1'){
                    $("#credits").html("240 კრედიტი / 4 წელი");
                    $(".first_year").show();
                    $(".second_year").show();
                    $(".third_year").show();
                    $(".fourth_year").show();
                }
                else if ($("#selector1").val()=='2'){
                    $("#credits").html("120 კრედიტი / 2 წელი");
                    $(".first_year").show();
                    $(".second_year").show();
                    $(".third_year").hide();
                    $(".fourth_year").hide();
                }
                else if ($("#selector1").val()=='3'){
                    $("#credits").html("180 კრედიტი / 3 წელი");
                    $(".first_year").show();
                    $(".second_year").show();
                    $(".third_year").show();
                    $(".fourth_year").hide();
                }
        });
</script>
