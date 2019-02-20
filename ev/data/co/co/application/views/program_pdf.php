<!DOCTYPE html>
<html>
<head>
	<title></title>

</head>
<style type="text/css" media="print">
@media print {
  @page { 
  	margin: 0.5cm;
  	size:auto;
   }
  body { margin: 0.5cm; }
}
	.wrp{
		word-wrap: break-word;
	}
</style>
<?php 

        $this->db->select('*');
        $this->db->from('faculties');
        $this->db->where('id', $prog->faculty_id);
        $facultycode =  $this->db->get()->row()->code;

        $this->db->select('*');
        $this->db->from('languages');
        $this->db->where('id', $prog->language_id);
        $language=  $this->db->get()->row(); 

        // if ($syl->language_id == 1) {
        // 	$lancode = 'G';	
        // }else if($syl->language_id == 2){
        // 	$lancode = 'R';
        // }else $lancode = 'E';
       

        $this->db->select('*');
        $this->db->from('degrees');
        $this->db->where('id', $prog->degree_id);
        $degree =  $this->db->get()->row();

		$this->db->select('*');
        $this->db->from('results_to_program');
        $this->db->where('program_id', $prog->id);
        $results =  $this->db->get()->result();

		$this->db->select('*');
        $this->db->from('methods_to_program');
        $this->db->where('program_id', $prog->id);
        $methods =  $this->db->get()->result();
	?>
<body>
	<br>
	<img src="<?=base_url('assets/images/logo.jpg')?>">
	<br>
	<center><b>საგანმანათლებლო პროგრამა</b></center>

	<table border="1" width="50%">
		<tr>
			<td>პროგრამის დასახელება: <?=$prog->edu_program_name_ka?></td>
			<td><?=$prog->edu_program_name_en?></td>
		</tr>		
	</table>
	<br>
	<h3>აკადემიური უმაღლესი განათლების საფეხური: <?=$degree->name?></h3><br>
	<br>

	<h3>პროგრამის ხელმძღვანელი</h3>
	<br>
	<table border="1" width="50%">
		<tr>
			<td> სახელი , გვარი</td>
			<td><?=$prog->fullname?></td>
		</tr>
	</table>

	<h3>მისანიჭებელი კვალიფიკაცია და პროგრამის მოცულობა კრედიტებით : <?=$prog->qualification2?></h3>
	<br>

	<h3>სწავლების ენა: <?=$language->name?></h3>
	<br>
	
	<h3>პროგრამის მიზანი : <?=$prog->program_goal?></h3>
	<br>
	
	<h3>პროგრამაზე დაშვების წინაპირობა : <?=$prog->prerequisite?></h3>
	<br>

	<h3>სწავლის შედეგები / კომპეტენტურობები :</h3>
	<br>

	<ul>	
	<?php foreach ($results as $key => $val): ?>
		<?php 
			$this->db->select('name,descr');
	        $this->db->from('results_edu');
	        $this->db->where('id', $val->result_id);
	        $result =  $this->db->get()->row();	
        ?>
			<li><b><?=$result->name?></b> - <?=$result->descr?></li>	
	<?php endforeach ?>
	</ul>
	<br>
	<h3><b>სწავლის შედეგების მიღწევის (სწავლება-სწავლის) ფორმები და მეთოდები</b></h3>
	<ul>	
	<?php foreach ($methods as $key => $val): ?>
		<?php 
			$this->db->select('name,descr');
	        $this->db->from('methods_edu');
	        $this->db->where('id', $val->method_id);
	        $result =  $this->db->get()->row();	
        ?>
			<li><b><?=$result->name?></b> - <?=$result->descr?></li>	
	<?php endforeach ?>
	</ul>

	<br>
	<h3><b>სტუდენტის ცოდნის შეფასების სისტემა</b></h3>
	<br>	
		<div class="wrp">
			<p>შეფასება ხდება 100 ქულიანი სკალით.
			დადებითი შეფასებებია: </p>
			<ul>
				<li>(A) - ფრიადი - შეფასების 91-100 ქულა;</li>
				<li>(B) - ძალიან კარგი - შეფასების 81-90 ქულა; </li>
				<li>(C) - კარგი - შეფასების 71-80 ქულა;  </li>
				<li>(D) - დამაკმაყოფილებელი - შეფასების 61-70 ქულა;   </li>
				<li>(E) - საკმარისი - შეფასების 51-60 ქულა. </li>
				<p>უარყოფითი შეფასებებია: </p>
				<li>(FX) - ვერ ჩააბარა - შეფასების 41-50 ქულა, რაც ნიშნავს, რომ სტუდენტს ჩასაბარებლად მეტი მუშაობა სჭირდება და ეძლევა დამოუკიდებელი მუშაობით დამატებით გამოცდაზე ერთხელ გასვლის უფლება;</li>
				<li>(F) - ჩაიჭრა - შეფასების 40 ქულა და ნაკლები, რაც ნიშნავს, რომ სტუდენტის მიერ ჩატარებული სამუშაო არ არის საკმარისი და მას საგანი ახლიდან აქვს შესასწავლი.</li>
			</ul>		
		</div>
	<br>
	<h3>დასაქმების სფერო : <?=$prog->sphere?></h3>
	<br>

	<h3>პროგრამის განხოციელებისათვის აუცილებელი ადამინური და მატერიალური  რესურსი : <?=$prog->requisite?></h3>
	<br>



<table width="100%" border="1" style="text-align: center">
  <tbody>
    <tr>
      <td rowspan="2">№</td>
      <td rowspan="2">სილაბუსის კოდი</td>
      <td rowspan="2">საგანი</td>
      <td rowspan="2">დაშვების წინაპირობა </td>
      <td colspan="4">ECTS კრედიტები <br> სასწავლო წელი</td>
    </tr>
    <tr>
      <td>I</td>
      <td>II</td>
      <td>III</td>
      <td>IV</td>
    </tr>
    <tr>
   			
    </tr>
  
  </tbody>
</table>



<!-- 

	<h3><b>შეფასების ფორმები და მეთოდები:</b></h3>
	<br>
	<table border="1" width="100%">
		<tr>
			<td>მიმდინარე აქტივობა</td>
			<td><?=$syl->current_activity?></td>
		</tr>
			<tr>
			<td>შუასემესტრული გამოცდა</td>
			<td><?=$syl->middle_exam?></td>
		</tr>
		<tr>
			<td>დასკვნითი/დამატებითი გამოცდა</td>
			<td><?=$syl->final_exam?></td>
		</tr>
	</table>
	<br>
	<br>


	<h3><b>ძირითადი ლიტერატურა</b></h3>
	<p><?=$syl->basiclit?></p>

	<h3><b>დამხმარე ლიტერატურა</b></h3>
	<p><?=$syl->addtionallit?></p>

	<h3><b>სილაბუსის ავტორი:</b></h3>
	<p><?=$syl->fullname?></p>
 -->

<script type="text/javascript">
	window.print();
</script>

</body>
</html>