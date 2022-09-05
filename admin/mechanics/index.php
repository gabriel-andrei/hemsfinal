<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<div class="card card-outline card-primary">
	<div class="card-header">
		<h3 class="card-title">List of Transactions</h3>
	</div>
	<div class="card-body">
		<div class="container-fluid">
        <div class="container-fluid">
			<table class="table table-bordered table-stripped">
				<colgroup>
					<col width="5%">
					<col width="15%">
					<col width="25%">
					<col width="20%">
					<col width="10%">
					<col width="15%">
					<col width="10%">
				</colgroup>
				<thead>
					<tr>
						<th>#</th>
						<th>Date Updated</th>
						<th>Client</th>
						<th>Contact</th>
						<th>Address</th>
						<th>Engine Models</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<!--<?php 
					$i = 1;
						$qry = $conn->query("SELECT * from `mechanics_list` order by (`name`) asc ");
						while($row = $qry->fetch_assoc()):
							foreach($row as $k=> $v){
								$row[$k] = trim(stripslashes($v));
							}
					?>
						<tr>
							<td class="text-center"><?php echo $i++; ?></td>
							<td><?php echo date("Y-m-d H:i",strtotime($row['date_created'])) ?></td>
							<td><?php echo ucwords($row['name']) ?></td>
							<td>
								<p class="m-0 lh-1">
								<?php echo $row['contact'] ?> <br>
								<?php echo $row['email'] ?>
								</p>
							</td>
							<td class="text-center">
                                <?php if($row['status'] == 1): ?>
                                    <span class="badge badge-success">Active</span>
                                <?php else: ?>
                                    <span class="badge badge-danger">Inactive</span>
                                <?php endif; ?>
                            </td>
							<td align="center">
								 <a href="" class="btn btn-flat p-1 btn-default btn-sm ">
				                  		<i class="far fa-eye"></i> View
				                  </a>
							</td>
						</tr>
					<?php endwhile; ?>
				-->
				</tbody>
			</table>
		</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		$('.delete_data').click(function(){
			_conf("Are you sure to delete this mechanic permanently?","delete_mechanic",[$(this).attr('data-id')])
		})
		$('.table').dataTable();
	})
	function delete_mechanic($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=delete_mechanic",
			method:"POST",
			data:{id: $id},
			dataType:"json",
			error:err=>{
				console.log(err)
				alert_toast("An error occured.",'error');
				end_loader();
			},
			success:function(resp){
				if(typeof resp== 'object' && resp.status == 'success'){
					location.reload();
				}else{
					alert_toast("An error occured.",'error');
					end_loader();
				}
			}
		})
	}
</script>