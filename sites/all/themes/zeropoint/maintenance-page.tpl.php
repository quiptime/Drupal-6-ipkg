<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="<?php print $language->language; ?>" xml:lang="<?php print $language->language; ?>">

<head>
<title><?php print $head_title ?></title>
<?php print $head ?>
<?php print $styles ?>
<?php print $scripts ?>
<script type="text/javascript"><?php /* Needed to avoid Flash of Unstyle Content in IE */ ?> </script>
<!--[if lte IE 6]>
<link type="text/css" rel="stylesheet" media="all" href="/<?php print $directory; ?>/css/ie6.css" />
<![endif]-->
<!--[if IE 7]>
<link type="text/css" rel="stylesheet" media="all" href="/<?php print $directory; ?>/css/ie7.css" />
<![endif]-->
</head>

<body class="<?php print $body_classes; ?>">

<div id="top_bg" class="page">
<div class="sizer">
<div id="topex" class="expander">
<div id="top_left">
<div id="top_right">

<div id="header" class="clear-block">
  <div id="logo">
    <?php if ($logo): ?>
      <a href="<?php print $base_path; ?>" title="<?php print t('Home'); ?>">
        <img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" />
      </a>
    <?php endif; ?>
  </div> <!-- /logo -->
  <div id="name-and-slogan">
  <?php if ($site_name): ?>
    <h1 id="site-name">
      <a href="<?php print $base_path ?>" title="<?php print t('Home'); ?>">
        <?php print $site_name; ?>
      </a>
    </h1>
  <?php endif; ?>
  <?php if ($site_slogan): ?>
    <div id="site-slogan">
      <?php print $site_slogan; ?>
    </div>
  <?php endif; ?>
  </div> <!-- /name-and-slogan -->

<br class="brclear" />

</div> <!-- /header -->

</div><!-- /top_right -->
</div><!-- /top_left -->
</div><!-- /expander -->
</div><!-- /sizer -->
</div><!-- /top_bg -->

<div id="body_bg" class="page">
<div class="sizer">
<div class="expander">
<div id="body_left">
<div id="body_right">

<div id="middlecontainer">
  <div id="wrapper">
    <div class="outer">
      <div class="float-wrap">
        <div class="colmain">
          <div id="main">
            <h1 class="title"><?php print $title ?></h1>
            <div class="tabs"><?php print $tabs ?></div>
            <?php print $help ?>
            <?php print $messages ?>
            <?php print $content; ?>
            <?php print $feed_icons; ?>
          </div>
        </div> <!-- /colmain -->
      </div> <!-- /float-wrap -->
      <br class="brclear" />
    </div><!-- /outer -->
  </div><!-- /wrapper -->
</div>

<div id="bar"></div>

</div><!-- /body_right -->
</div><!-- /body_left -->
</div><!-- /expander -->
</div><!-- /sizer -->
</div><!-- /body_bg -->

<div class="eopage">
<div class="page">
<div class="sizer">
<div class="expander">

<div id="footer-wrapper" class="clear-block">
  <div id="footer">
    <div class="legal">
      Copyright &copy; <?php print date('Y') ?> <a href="/"><?php print $site_name ?></a>. <?php print $footer_message ?>
      <div id="brand"></div>
    </div>
  </div>
</div> <!-- /footer-wrapper -->

<div id="belowme">
</div>

</div><!-- /expander -->
</div><!-- /sizer -->
</div><!-- /page -->
</div>

<?php print $closure ?>
</body>
</html>
