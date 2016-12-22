<div class="right_col" role="main">
	<div class="page-title">
	  <div class="title_left">
	    <h3>Danh mục bài viết <small>(<?php echo $total_result; ?>)</small></h3>
	  </div>

		<?php $this->load->view('seller/page/article/_action') ?>
	</div>

  <div class="row">
	<div class="col-xs-12">
		<div class="x_panel">
		  <div class="x_content">

				<?php $this->load->view('seller/component/pagination', array(
					'total'=>$total_result,
					'current'=>$current_page,
					'base_path'=>'/admin/articles',
				)); ?>

		    <table class="table">
		      <thead>
		        <tr>
		          <th>ID</th>
		          <th>Tiêu đề</th>
		          <th>Blog</th>
		          <th>Ngày cập nhật</th>
		          <th>Trạng thái</th>
		        </tr>
		      </thead>
		      <tbody>
		      <?php if(count($articles) === 0): ?>
					<tr>
						<td colspan="4" class="text-center">
							Chưa có bài viết nào!
						</td>
					</tr>
	  			<?php endif; ?>
		      <?php foreach($articles as $article): ?>
		        <tr>
		          <th><?php echo $article->id ?></th>
		          <td>
		          	<a href="/admin/articles/edit?id=<?php echo $article->id ?>">
		          		<?php echo $article->title ?>
		          	</a>
		          </td>
		          <td>
		          	<ul>
		          	<?php $count = 0; ?>
		          	<?php foreach($article->blogs as $blog): ?>
		          	<?php if($count > 3){break;} $count++; ?>
		          		<li>
							<a href="/admin/blogs/edit?id=<?php echo $blog->id ?>"><?php echo $blog->title ?></a>
						</li>
		          	<?php endforeach; ?>
		          	</ul>
		          </td>
		          <td><?php echo date('H:i:s d/m/Y', $article->update_at) ?></td>
		          <td><?php echo $article->getStatusTpl() ?></td>
		          <td>
					<a href="/admin/articles/edit?id=<?php echo $article->id ?>" class="btn btn-primary btn-xs">Sửa</a>
					<a href="/admin/articles/remove?id=<?php echo $article->id ?>" class="btn btn-danger btn-xs remove-link">Xóa</a>
		          </td>
		        </tr>
		    	<?php endforeach; ?>
		      </tbody>
		    </table>

				<?php $this->load->view('seller/component/pagination', array(
					'total'=>$total_result,
					'current'=>$current_page,
					'base_path'=>'/admin/articles',
				)); ?>

		  </div>
		</div>
	</div>
  	
  </div>
</div>