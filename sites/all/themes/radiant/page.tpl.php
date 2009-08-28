<?php // $Id: page.tpl.php,v 1.1 2009/05/29 07:41:14 agileware Exp $ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="<?php print $language->language ?>" xml:lang="<?php print $language->language ?>">

  <head>
    <title><?php echo $head_title ?></title>
    <?php echo $head ?>
    <?php echo $styles ?>
    <?php echo $scripts ?>
    <!--[if IE 6]><link rel="stylesheet" href="<?php echo $base_path . $directory; ?>/style.ie6.css" type="text/css" /><![endif]-->
    <!--[if IE 7]><link rel="stylesheet" href="<?php echo $base_path . $directory; ?>/style.ie7.css" type="text/css" media="screen" /><![endif]-->
  </head>

  <body<?php print phptemplate_body_class($left, $right); ?>>
    <div id="page">
	<?php if (!empty($navigation)): ?>
	<div class="nav">
		<div class="l"></div>
		<div class="r"></div>
		<?php echo $navigation; ?>
	</div>
	<?php endif; ?>
      <div id="header">
        <div id="headercontent">
          <?php if ($logo): ?>
            <a href="<?php echo $base_path ?>" title="<?php echo t('Home') ?>"><img src="<?php echo $logo ?>" alt="<?php echo t('Home') ?>" /></a>
          <?php endif; ?>
        </div>
      </div>
      <div id="container">
        <?php if ($left): ?>
          <div id="sidebar-left" class="sidebar">
            <?php echo $left ?>
          </div>
        <?php endif; ?>
        <div id="main">
          <div class="content-padding">
            <?php if ($mission): ?>
              <div id="mission">
                <?php echo $mission ?>
              </div>
            <?php endif; ?>
            <?php if (!$is_front) echo $breadcrumb ?>
            <?php if ($show_messages) echo $messages; ?>
            <?php if ($tabs): ?>
              <div class="tabs">
                <?php echo $tabs ?>
              </div>
            <?php endif; ?>
            <?php if ($title): ?>
              <h1 class="title"><?php echo $title ?></h1>
            <?php endif; ?>
            <?php echo $help ?>
            <?php echo $content; ?>
            <?php echo $feed_icons; ?>
          </div>
        </div>
        <?php if ($right): ?>
          <div id="sidebar-right" class="sidebar">
            <?php echo $right ?>
          </div>
        <?php endif; ?>
        <div style="clear: both;"></div>
        <div id="postcontent">
          <?php echo $footer ?>
          <div style="clear: both;"></div>
        </div>
      </div>
      <div id="footer">
        <div id="footer_copy">
          <?php echo $footer_message ?>
        </div>
      </div>
    </div>
    <?php print $closure ?>
  </body>
</html>