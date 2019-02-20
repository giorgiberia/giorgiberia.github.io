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
<body>
	<br>
	<img src="<?=base_url('assets/images/logo.jpg')?>">
	<br>
	<center><b>სასწავლო კურსის პროგრამა (სილაბუსი) </b></center>
	<?php 
		$this->db->select('*');
        $this->db->from('subjects');
        $this->db->where('ID', $syl->subject_id);
        $subject_name =  $this->db->get()->row()->dasaxeleba;

        $this->db->select('*');
        $this->db->from('education_sphere');
        $this->db->where('id', $syl->sphere_id);
        $spherecode =  $this->db->get()->row()->code;

        $this->db->select('*');
        $this->db->from('education_sphere');
        $this->db->where('id', $syl->subsphere_id);
        $subspherecode =  $this->db->get()->row()->code;

        $this->db->select('*');
        $this->db->from('faculties');
        $this->db->where('id', $syl->faculty_id);
        $facultycode =  $this->db->get()->row()->code;

        $this->db->select('*');
        $this->db->from('languages');
        $this->db->where('id', $syl->language_id);
        $language=$this->db->get()->row(); 

        // if ($syl->language_id == 1) {
        // 	$lancode = 'G';	
        // }else if($syl->language_id == 2){
        // 	$lancode = 'R';
        // }else $lancode = 'E';

        $this->db->select('*');
        $this->db->from('ganawileba');
        $this->db->where('sagani_ID', $syl->subject_id);
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
        $this->db->where('id', $syl->degree_id);
        $degree =  $this->db->get()->row();

        $this->db->select('*');
        $this->db->from('goals_to_sylabus');
        $this->db->where('sylabus_id', $syl->id);
        $goals =  $this->db->get()->result();

        $this->db->select('*');
        $this->db->from('subjects');
        $this->db->where('id', $syl->presubject_id);     
        $presub_name =  $this->db->get()->row();

		$this->db->select('*');
        $this->db->from('results_to_sylabus');
        $this->db->where('sylabus_id', $syl->id);
        $results =  $this->db->get()->result();

	?>

	<table border="1" width="50%">
		<tr>
			<td><?=$subject_name?></td>
		</tr>		
	</table>
	<br>
	<h1>სასწავლო კურსის კოდი: <?=$spherecode.$subspherecode."00".$facultycode.$language->code."1-".$str?></h1><br>
	<br>
	<h3>აკადემიური უმაღლესი განათლების საფეხური: <?=$degree->name?></h3><br>
	<br>
	<h3>სწავლების ენა: <?=$language->name?></h3>
	<br>
	<h3>ავტორი/ავტორები</h3>
	<br>
	<table border="1" width="50%">
		<tr>
			<td>გვარი,სახელი</td>
			<td><?=$syl->fullname?></td>
		</tr>
			<tr>
			<td>სამუშაო ადგილი</td>
			<td><?=$syl->work_name?></td>
		</tr>
		<tr>
			<td>თანამდებობა</td>
			<td><?=$syl->position_name?></td>
		</tr>
		<tr>
			<td>ტელეფონი</td>
			<td><?=$syl->phone_number?></td>
		</tr>
		<tr>
			<td>ელ-ფოსტა</td>
			<td><?=$syl->email?></td>
		</tr>
	</table>
	<br>
	<ul>	
	<?php foreach ($goals as $key => $val): ?>
		<?php 
			$this->db->select('*');
	        $this->db->from('goals');
	        $this->db->where('id', $val->goal_id);
	        $goal_name =  $this->db->get()->row()->name;	
        ?>
			<li><?=$goal_name?></li>	
	<?php endforeach ?>
	</ul>

	<br>
	<h3><?if($presub_name){echo $presub_name->dasaxeleba;}?></h3>
	<br>
	<ul>	
	<?php foreach ($results as $key => $val): ?>
		<?php 
			$this->db->select('*');
	        $this->db->from('results');
	        $this->db->where('id', $val->result_id);
	        $result_name =  $this->db->get()->row()->name;	
        ?>
			<li><?=$result_name?></li>	
	<?php endforeach ?>
	</ul>
	<br>
	<h3><b>სწავლის შედეგების მიღწევის (სწავლება-სწავლის) მეთოდები</b></h3>

	<ul>
		<?php if ($arr->leqcia_sak > 0): ?>
			<li>ლექცია</li>
		<?php endif ?>
		<?php if ($arr->praqtikuli_sak > 0): ?>
			<li>პრაქტიკული</li>
		<?php endif ?>
		<?php if ($arr->laboratoriuli_sak > 0): ?>
			<li>ლაბორატორიული</li>
		<?php endif ?>
		<?php if ($arr->praqtikuli_dam > 0): ?>
			<li>პრაქტიკა</li>
		<?php endif ?>
		<?php if ($arr->laboratoriuli_sak > 0): ?>
			<li>ლაბორატორიული</li>
		<?php endif ?>
			<li>კონსულტაცია</li>
			<li>დამოუკიდებელი მუშაობა</li>
	</ul>
	<br>
		<p>სწავლება-სწავლის მეთოდების შესაბამისი აქტივობები: (დისკუსია, დებატები, პრეზენტაცია, ჯგუფური მუშაობა და სხვ.)</p><br>

		<p>კრედიტების რაოდენობა: <?=$arr->credits?></p>
	<br>
	<h3>საათების განაწილება სტუდენტის დატვირთვის შესაბამისად (სთ.)</h3>
	<table >
		<tr>
			<td>ლექცია</td>
			<td><?=$arr->leqcia_sak?></td>
		</tr>
		<tr>
			<td>სემინარი (ჯგუფში მუშაობა):</td>
			<td></td>
		</tr>
		<tr>
			<td>პრაქტიკული:</td>
			<td><?=$arr->praqtikuli_sak?></td>
		</tr>
		<tr>
			<td>ლაბორატორიული:</td>
			<td></td>
		</tr>
		<tr>
			<td>საკურსო სამუშაო/პროექტი:</td>
			<td></td>
		</tr>
		<tr>
			<td>პრაქტიკა:</td>
			<td></td>
		</tr>
		<tr>
			<td>შუასემესტრული /დასკვნითი გამოცდა:</td>
			<td>1</td>
		</tr>
		<tr>
			<td>დამოუკიდებელი მუშაობა:</td>
			<td><?=$arr->leqcia_dam+$arr->praqtikuli_dam+$arr->laboratoriuli_dam?></td>
		</tr>
	</table>
	<br>
	
	<h3><b>№ თემის დასახელება და შინაარსი - ლექცია</b></h3>
	<ul>
		<?php  for ($i=1; $i < 15; $i++) :?>
			<?php 
				$var = "lec_".$i;
			?>
			<li><?=$syl->$var?></li>

		<?php endfor;?>

	</ul>
	<br>

	<h3><b>№ თემის დასახელება და შინაარსი - პრაქტიკა</b></h3>
	<ul>
		<?php  for ($i=1; $i < 15; $i++) :?>
			<?php 
				$var = "prac_".$i;
			?>
			<li><?=$syl->$var?></li>

		<?php endfor;?>

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


<script type="text/javascript">
	window.print();
</script>

</body>
</html>