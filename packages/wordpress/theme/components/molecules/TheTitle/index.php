<?php $title = explode(' ', get_the_title()); ?>
<h1>
  <span><?php echo $title[0]; ?></span>
  <?php echo str_replace($title[0], '', get_the_title()); ?>
</h1>