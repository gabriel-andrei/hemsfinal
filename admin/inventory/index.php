<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<div class="card card-outline card-primary">
	<div class="card-header">
		<h3 class="card-title">Inventory</h3>
			<div class="card-tools">
				<a href=" " id="create_new" class="btn btn-flat btn-primary"><span class="fas fa-plus"></span>  Create New</a>
			</div>
	</div>
	<div class="card-body">
		<div class="container-fluid">
        <div class="container-fluid">
			<table class="table table-bordered table-stripped">
				<colgroup>
					<col width="5%">
					<col width="15%">
					<col width="15%">
					<col width="20%">
					<col width="15%">
                    <col width="10%">
                    <col width="10%">
					<col width="15%">
				</colgroup>
				<thead>
					<tr>
						<th>#</th>
						<th>Date Created</th>
						<th>Image</th>
						<th>Name</th>
						<th>Price</th>
						<th>Available Stock</th>
                        <th>Sold</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				<?php 
					$i = 1;
						$qry = $conn->query("SELECT * from `product_list` order by (`id`) asc ");
						while($row = $qry->fetch_assoc()):
							foreach($row as $k=> $v){
								$row[$k] = trim(stripslashes($v));
							}
					?>
						<tr>
							<td class="text-center"><?php echo $i++; ?></td>
							<td><?php echo date("Y-m-d H:i",strtotime($row['date_created'])) ?></td>

							<td class="text-center"><img src="" ></td>
							<td><?php echo ucwords($row['name']) ?></td>
							<td><?php echo $row['price'] ?></td>
							<td><?php echo $row['available_stock'] ?></td>
							<td><?php echo $row['sold'] ?></td>

							<td align="center">
								 <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
				                  		Action
				                    <span class="sr-only">Toggle Dropdown</span>
				                  </button>
				                  <div class="dropdown-menu" role="menu">
				                    <a class="dropdown-item" href="?page=user/manage_user&id=<?php echo $row['id'] ?>"><span class="fa fa-edit text-primary"></span> Edit</a>
				                    <div class="dropdown-divider"></div>
				                    <a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-trash text-danger"></span> Delete</a>
				                  </div>
							</td>
						</tr>
					<?php endwhile; ?>


				
				</tbody>
			</table>
		</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		$('.delete_data').click(function(){
			_conf("Are you sure to delete this service request permanently?","delete_service_request",[$(this).attr('data-id')])
		})
		$('.view_data').click(function(){
			uni_modal("Service Request Details","service_requests/view_request.php?id="+$(this).attr('data-id'),'large')
		})
		$('#create_new').click(function(){
			uni_modal("Service Request Details","service_requests/manage_request.php",'large')
		})
		$('.edit_data').click(function(){
			uni_modal("Service Request Details","service_requests/manage_request.php?id="+$(this).attr('data-id'),'large')
		})
		$('.table').dataTable();
	})
	function delete_service_request($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=delete_request",
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