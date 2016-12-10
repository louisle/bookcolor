<div class="right_col" role="main">
  <div class="row">
  	<div class="col-md-6 col-md-offset-3 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Chỉnh sửa blog</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br />
            <form id="CreateBlog" class="form-horizontal form-label-left" method="POST" action="" novalidate>

              <div class="form-group item">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Tiêu đề <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="title" name="title" required="required" class="form-control col-md-7 col-xs-12 slug-generator" value="<?php echo isset($form_data['title']) ? $form_data['title'] : '' ?>" data-bind="#url" />
                	<?php if(isset($form_error['title'])):?>
						        <ul class="parsley-errors-list filled"><li class="parsley-required"><?php echo $form_error['title'] ?></li></ul>
          			   <?php endif; ?>
                </div>
              </div>

              <div class="form-group item">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="url">URL <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="url" name="url" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo isset($form_data['url']) ? $form_data['url'] : '' ?>" />
                	<?php if(isset($form_error['url'])):?>
						        <ul class="parsley-errors-list filled"><li class="parsley-required"><?php echo $form_error['url'] ?></li></ul>
          			   <?php endif; ?>
                </div>
              </div>

              <div class="form-group item">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="status">Trạng thái
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <select name="status" id="" class="select2 form-control">
                  	<option value="0" <?php echo $form_data['status']===0 ? 'selected' : '' ?>>Ẩn</option>
                  	<option value="1" <?php echo $form_data['status']===1 ? 'selected' : '' ?>>Hiện</option>
                  </select>
                </div>
              </div>

              <div class="ln_solid"></div>
              <div class="form-group item">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                  <button type="reset"  name="reset"  class="btn btn-primary">Làm lại</button>
                  <button type="submit"  name="submit"  class="btn btn-success">Cập nhật</button>
                </div>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>