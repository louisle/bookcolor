<?php
$base_path = '/admin/links';
if($parentLink->id != 0){
	$base_path.="?parent=".$parentLink->id;
}
?>
<div class="right_col" role="main">
	<div class="page-title">
	  <div class="title_left">
	    <h3>Danh mục link <small>(<?php echo $total_result; ?>)</small></h3>
	    <?php if($parentLink->id != 0): ?>
	    	<a href="<?php echo $parentLink->parent->getAdminPath(); ?>"><i class="fa fa-angle-left"></i> Quay lại <?php echo $parentLink->parent->title; ?></a>
		<?php endif; ?>
	  </div>

		<?php $this->load->view('seller/page/link/_action') ?>
	</div>

  <div class="row">
	<div class="col-xs-12">
		<div class="x_panel">
		  <div class="x_content">

				<?php $this->load->view('seller/component/pagination', array(
					'total'=>$total_result,
					'current'=>$current_page,
					'base_path'=>$base_path,
				)); ?>

		    <table class="table">
		      <thead>
		        <tr>
		          <th>ID</th>
		          <th>Tiêu đề</th>
		          <th>Trỏ đến</th>
		          <th>Ngày cập nhật</th>
		          <th>Ngày tạo</th>
		          <th>Trạng thái</th>
		        </tr>
		      </thead>
		      <tbody>
		      <?php if(count($links) === 0): ?>
					<tr>
						<td colspan="6" class="text-center">
							Chưa có link nào!
						</td>
					</tr>
	  			<?php endif; ?>
		      <?php foreach($links as $link): ?>
		        <tr>
		          <th><?php echo $link->id ?></th>
		          <td>
		          	<a href="/admin/links/?parent=<?php echo $link->id ?>">
		          		<span class="label label-primary"><?php echo $link->target_type; ?></span>
		          		<?php echo $link->title ?>
		          	</a>
		          </td>
		          <td>
		          	<?php if($link->targetObject != NULL): ?>
		          	<a href="<?php echo $link->targetObject->getAdminPath(); ?>" target="_blank"><?php echo $link->targetObject->title; ?></a>
		          	<?php endif; ?>
		          </td>
		          <td><?php echo date('H:i:s d/m/Y', $link->update_at) ?></td>
		          <td><?php echo $link->getStatusTpl() ?></td>
		          <td>
								<a href="/admin/links/add?parent=<?php echo $link->id ?>" class="btn btn-default btn-xs">Tạo sublink</a>
								<a href="/admin/links/edit?id=<?php echo $link->id ?>" class="btn btn-primary btn-xs">Sửa</a>
								<a href="/admin/links/remove?id=<?php echo $link->id ?>" class="btn btn-danger btn-xs remove-link">Xóa</a>
		          </td>
		        </tr>
		    	<?php endforeach; ?>
		      </tbody>
		    </table>

				<?php $this->load->view('seller/component/pagination', array(
					'total'=>$total_result,
					'current'=>$current_page,
					'base_path'=>$base_path,
				)); ?>

		  </div>
		</div>
	</div>
  	
  </div>
</div>