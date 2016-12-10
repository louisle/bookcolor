<?php
  // $base_path = '/admin/blogs';
  // $total = 280;
  // $current = 15;
  $num_per_page = 10;

  $total_page = ceil($total / $num_per_page);

  $paging_hidden = 4;

  // calc start and off
  $first = $current - $paging_hidden;
  $last = $current + $paging_hidden;
  $show_first = TRUE;
  $show_last = TRUE;

  if($first <= 1){
    $first = 1;
    $show_first = FALSE;
  }

  if($last >= $total_page){
    $last = $total_page;
    $show_last = FALSE;
  }

?>
<nav aria-label="Page navigation">
  <ul class="pagination">
    <?php if($show_first): ?>
      <li>
        <a href="<?php echo makePageLink(1, $base_path); ?>" aria-label="Previous">
          <span aria-hidden="true">&laquo;</span>
        </a>
      </li>
    <?php endif; ?>
    <?php for($i = $first; $i <= $last; $i++): ?>
      
    <?php if($i == $current): ?>
      <li class="active"><a href="<?php echo makePageLink($i, $base_path); ?>"><?php echo $i; ?></a></li>
    <?php else: ?>
      <li><a href="<?php echo makePageLink($i, $base_path); ?>"><?php echo $i; ?></a></li>
    <?php endif; ?>

    <?php endfor; ?>
    <?php if($show_last): ?>
    <li>
      <a href="<?php echo makePageLink($total_page, $base_path); ?>" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
    <?php endif; ?>
  </ul>
</nav>