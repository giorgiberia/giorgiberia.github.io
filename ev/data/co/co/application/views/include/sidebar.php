<!--/sidebar-menu-->
<div class="sidebar-menu">
    <header class="logo1">
        <a href="#" class="sidebar-icon"> <span class="fa fa-bars"></span> </a>
    </header>
    <div style="border-top:1px ridge rgba(255, 255, 255, 0.15)"></div>
    <div class="menu">
        <ul id="menu" >
            <li><a href="<?=base_url().'main/syllabus'?>"><i class="fa fa-tachometer"></i> <span>მთავარი</span><div class="clearfix"></div></a></li>

            <li id="menu-academico" ><a href="<?=base_url().'main/create_program'?>"><i class="fa fa-envelope nav_icon"></i><span>პროგრამის დამატება</span><div class="clearfix"></div></a></li>

            <li><a href="<?=base_url().'main/create_subject'?>"><i class="fa fa-picture-o" aria-hidden="true"></i><span>საგნის დამატება</span><div class="clearfix"></div></a></li>

            <li id="menu-academico" ><a href="<?=base_url().'main/distribution'?>"><i class="fa fa-bar-chart"></i><span>საგნების განაწილება</span><div class="clearfix"></div></a></li>

            <li id="menu-academico" ><a href="<?=base_url().'main/syl_distribution'?>"><i class="fa fa-bar-chart"></i><span>სილაბუსები</span><div class="clearfix"></div></a></li>

            <li id="menu-academico" ><a href="<?=base_url().'main/prog_distribution'?>"><i class="fa fa-bar-chart"></i><span>საგანმანათლებლო<br>პროგრამები</span><div class="clearfix"></div></a></li>


            <li><a href="<?=base_url('main/syllabus')?>"><i class="fa fa-picture-o" aria-hidden="true"></i><span>ახალი სილაბუსი</span><div class="clearfix"></div></a></li>

            <li><a href="<?=base_url('main/edu_program')?>"><i class="fa fa-picture-o" aria-hidden="true"></i><span>ახალი საგანმანათლებლო<br>პროგრამა</span><div class="clearfix"></div></a></li>

        </ul>
    </div>
</div>
<script>
    var toggle = true;

    $(".sidebar-icon").click(function() {
        if (toggle)
        {
            $(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
            $("#menu span").css({"position":"absolute"});
        }
        else
        {
            $(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
            setTimeout(function() {
                $("#menu span").css({"position":"relative"});
            }, 400);
        }

        toggle = !toggle;
    });
</script>
