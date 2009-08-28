<?php // $Id: block.tpl.php,v 1.1 2009/05/29 07:41:14 agileware Exp $ ?>
<div id="block-<?php echo $block->module . '-' . $block->delta; ?>" class="clear-block block block-<?php echo $block->module ?>">
  <?php if ($block->subject): ?>
    <h2 class="title"><?php echo $block->subject ?></h2>
  <?php endif;?>
  <div class="content">
    <?php echo $block->content ?>
  </div>
</div>
