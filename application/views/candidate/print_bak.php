<?php $no = 1; ?>
<?php for ($j=1; $j<=$page; $j++) { ?>
<div class="container" id="page<?php echo $page;?>">
<page size="A4">
	<div class="row py-4">
		<div class="col-sm-12 text-center">
			<img src="<?php echo $base_url; ?>assets/logo.jpg" alt="" width="200" class="mb-3">
			<br>
			<p class="mb-0" style="font-size:18px;">ประกาศ</p>
			<p class="mb-0" style="font-size:18px;">สหกรณ์ออมทรัพย์กรมส่งเสริมการเกษตร จำกัด</p>
			<p class="mb-0" style="font-size:18px;">เรื่อง <?php echo $text; ?></p>
			<?php if (!empty($member[0]->member_group_name)): ?>
			<p class="mb-0" style="font-size:18px;">กลุ่ม <b class="text-danger"><?php echo $member[0]->member_group_name; ?></b></p>
			<?php endif ?>
			<p class="mb-0" style="font-size:18px;">ประจำปี <b class="text-danger"><?php echo $recruiting->year; ?></b></p>
			<p class="mb-0" style="font-size:18px;">--------------------</p>
			<table class="table table-bordered">
				<thead>
					<tr>
						<td>ลำดับที่</td>
						<td>ชื่อผู้สมัคร</td>
						<td>หมายเลขผู้สมัคร</td>
						<td>คะแนนที่ได้</td>
					</tr>
				</thead>
				<tbody>
					<?php 
						$limit = 10;
						$start = ($j-1) * $limit; 
						$candidates_page = array_slice( $candidates, $start, $limit );
					?>
					<?php foreach ($candidates_page as $key => $candidate) { ?>
					<tr>
						<td><?php echo $no++; ?></td>
						<td class="text-left"><?php echo $candidate['name'];?></td>
						<td><?php echo $candidate['candidate_no']; ?></td>
						<td><?php echo $candidate['score']; ?></td>
					</tr>
					<?php } ?>
					<?php for($i=1;$i<=(10-count($candidates_page));$i++) { ?>
					<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
					<?php } ?>
				</tbody>
			</table>


			<br><br><br>
		</div>
		<div class="col-sm-4"></div>
		<div class="col-sm-3"></div>
		<div class="col-sm-5 text-center">
			<?php 

			?>
			<p>ประกาศ ณ วันที่ <?php echo $month; ?></p>
			<br>
			<br>
			<p>................................................................................</p>
			<p>(................................................................................)</p>
			<p>................................................................................</p>
			<p>ประธานกรรมการ<br><?php echo $text2; ?></p>
		</div>
	</div>
</page>
</div>
<div class="page-break"></div>
<?php } ?>

<style>
		@media print {
			.page-break	{ display: block; page-break-before: always; }
			page[size="A4"] { padding:0 !important; }
		}
		body {
		  background: rgb(204,204,204); 
		  -webkit-print-color-adjust: exact !important;
		}
		page {
		  background: white;
		  display: block;
		  margin: 0 auto;
		  margin-bottom: 0.5cm;
		  box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
		}
		page[size="A4"] {  
			padding:0px 80px;
		  width: 100%;
		  /*height: 29.7cm; */
		  padding-top: 15px;
		}
		page[size="A4"][layout="landscape"] {
		  width: 29.7cm;
		  height: 21cm;  
		}
		page[size="A3"] {
		  width: 29.7cm;
		  height: 42cm;
		}
		page[size="A3"][layout="landscape"] {
		  width: 42cm;
		  height: 29.7cm;  
		}
		page[size="A5"] {
		  width: 14.8cm;
		  height: 21cm;
		}
		page[size="A5"][layout="landscape"] {
		  width: 21cm;
		  height: 14.8cm;  
		}
		@media print {
		  body, page {
		    margin: 0;
		    box-shadow: none;
		  }
		}
</style>
<script>
window.print();
</script>