<ul class="podcast-filter">
  <li class="term reset"><?php echo __('all','sonaar') ?></li>
  <?php foreach($termsObj as $term ) :?>
  <li class="term"><?php echo $term->name?></li>
<?php endforeach ?>
</ul>