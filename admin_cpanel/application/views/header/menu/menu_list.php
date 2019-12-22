		<?php if($header_list!=''){  for($m=0;$m<($header_list[0]->menu_level);$m++){ ?>
			<hr />
			<ol class="breadcrumb bc-3">						
				<li class="active"><strong>Menu Management for <?php echo $header_list[0]->menu_name; ?> </strong></li>
				<li class="active" style="float:right;"><a href="<?php echo site_url()."header/add_header_menu/".($m+1); ?>">Add New Menu level <?php echo ($m+1); ?> for <?php echo $header_list[0]->menu_name; ?></a></li>
			</ol>
			<div class="row" style="overflow-x: scroll;">
				<table class="table table-bordered datatable" id="menu_list">
					<thead>
						<tr>
							<th>Sl No</th>
							<th>Menu Name</th>
							<th>Menu Level</th>
							<th>Menu Level</th>
							<th>Position</th>
							<th>Status</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
					<?php if($header_menu_list!=''){ for($a=0;$a<count($header_menu_list);$a++){ if($header_menu_list[$a]->menu_level == ($m+1)){ ?>
						<tr>
							<td><?php echo ($a+1); ?></td>
							<td><?php echo $header_menu_list[$a]->menu_name; ?></td>
							<td><?php echo $header_menu_list[$a]->menu_level; ?></td>
							<td><?php echo $header_menu_list[$a]->title." (".$header_menu_list[$a]->display_name.")"; ?></td>
							<td><?php echo $header_menu_list[$a]->position; ?></td>
							<td>
								<?php if($header_menu_list[$a]->status == "ACTIVE"){ ?>
									<button type="button" class="btn btn-green btn-icon icon-left">Active<i class="entypo-check"></i></button>
								<?php }else{ ?>
										<button type="button" class="btn btn-orange btn-icon icon-left">InActive<i class="entypo-cancel"></i></button>
								<?php } ?>
							</td>
							<td class="center">
								<?php if($header_menu_list[$a]->status == "ACTIVE"){ ?>
									<a href="<?php echo site_url()."header/inactive_header_menu/".base64_encode(json_encode($header_menu_list[$a]->menu_level_details_id)); ?>" class="btn btn-orange btn-sm btn-icon icon-left"><i class="entypo-eye"></i>InActive</a>
								<?php }else{ ?>
									<a href="<?php echo site_url()."header/active_header_menu/".base64_encode(json_encode($header_menu_list[$a]->menu_level_details_id)); ?>" class="btn btn-green btn-sm btn-icon icon-left"><i class="entypo-check"></i>Active</a>
								<?php } ?>
								<a href="<?php echo site_url()."header/edit_header_menu/".base64_encode(json_encode($header_menu_list[$a]->header_details_id))."/".base64_encode(json_encode($header_menu_list[$a]->menu_level_details_id)); ?>" class="btn btn-default btn-sm btn-icon icon-left"><i class="entypo-pencil"></i>Edit</a>				
								<a href="<?php echo site_url()."header/delete_header_menu/".base64_encode(json_encode($header_menu_list[$a]->menu_level_details_id)); ?>" class="btn btn-danger btn-sm btn-icon icon-left"><i class="entypo-cancel"></i>Delete</a>
							</td>
						</tr>
					<?php } } } ?>												
					</tbody>
				</table>
			</div>
		<?php } } ?>
