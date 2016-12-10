<div class="right_col" role="main">
	<div class="page-title">
	  <div class="title_left">
	    <h3>Danh mục blog <small>(<?php echo $total_result; ?>)</small></h3>
	  </div>

		<?php $this->load->view('seller/page/blog/_action') ?>
	</div>

  <div class="row">
	<div class="col-xs-12">
		<div class="x_panel">
		  <div class="x_content">

				<?php $this->load->view('seller/component/pagination', array(
					'total'=>$total_result,
					'current'=>$current_page,
					'base_path'=>'/admin/blogs',
				)); ?>

		    <table class="table">
		      <thead>
		        <tr>
		          <th>ID</th>
		          <th>Tiêu đề</th>
		          <th>Ngày cập nhật</th>
		          <th>Trạng thái</th>
		        </tr>
		      </thead>
		      <tbody>
		      <?php if(count($blogs) === 0): ?>
					<tr>
						<td colspan="4" class="text-center">
							Chưa có bài viết nào!
						</td>
					</tr>
	  			<?php endif; ?>
		      <?php foreach($blogs as $blog): ?>
		        <tr>
		          <th><?php echo $blog->id ?></th>
		          <td>
		          	<a href="/admin/blogs/edit?id=<?php echo $blog->id ?>">
		          		<?php echo $blog->title ?>
		          	</a>
		          </td>
		          <td><?php echo date('H:i:s d/m/Y', $blog->update_at) ?></td>
		          <td><?php echo $blog->getStatusTpl() ?></td>
		          <td>
					<a href="/admin/articles/add?blog_id=<?php echo $blog->id ?>" class="btn btn-default btn-xs">Tạo bài viết</a>
					<a href="/admin/blogs/edit?id=<?php echo $blog->id ?>" class="btn btn-primary btn-xs">Sửa</a>
					<a href="/admin/blogs/remove?id=<?php echo $blog->id ?>" class="btn btn-danger btn-xs remove-link">Xóa</a>
		          </td>
		        </tr>
		    	<?php endforeach; ?>
		      </tbody>
		    </table>
				
				<?php $this->load->view('seller/component/pagination', array(
					'total'=>$total_result,
					'current'=>$current_page,
					'base_path'=>'/admin/blogs',
				)); ?>

		  </div>
		</div>
	</div>
  	
  </div>
</div>