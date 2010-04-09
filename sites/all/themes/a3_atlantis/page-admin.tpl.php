<?php
// $Id: page-admin.tpl.php,v 1.1.4.4 2008/08/23 20:58:56 johnforsythe Exp $
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="<?php print $language->language ?>" xml:lang="<?php print $language->language ?>" dir="<?php print $language->dir ?>">
<head>
  <title><?php print $head_title ?></title>
  <meta http-equiv="Content-Style-Type" content="text/css" />
  <?php print $head ?>
  <?php print $styles ?>
  <?php print $scripts ?>
</head>
<body>
<div id="container">
<div id="page" class="wide-page">
  <div id="main">
    <div id="content">
      <?php print $header ?>
      <?php print $breadcrumb ?>
      <div class="tabs"><?php print $tabs ?></div>
      <?php if ($title) { ?><h1 class="title"><?php print $title ?></h1><?php } ?> 
      <?php print $help ?>
      <?php if ($show_messages && $messages) { print $messages; } ?>
      <?php print $content ?>
      <?php print $breadcrumb ?>
    </div>
    <div id="right">
      <div id="sidebar-left">
        <div class="block" id="right-toggle"><a>[<?php print t('Expand'); ?></a>]</div>
        <?php print $left ?>
        <?php print $right ?>
        <?php print $search_box ?>
      </div>
    </div>
    <div class="clear-both"></div>
  </div>
  <div class="clear-both"></div>
  <div id="header">
    <div id="title">
      <?php if ($site_name) { ?><h1><a href="<?php print $base_path ?>" title="<?php print t('Home') ?>"><?php print $site_name ?></a></h1><?php } ?>
      <?php if ($site_slogan) { ?><div class='site-slogan'><?php print $site_slogan ?></div><?php } ?>
      <div id="title-spacer"></div>
    </div>
    <div id="nav">
      <?php if (isset($primary_links)) { ?><?php print theme('links', $primary_links, array('class' =>'links', 'id' => 'navlist')) ?><?php } ?>
    </div>
  </div>
  <div id="footer">
    <?php print $footer_message . $footer ?>
    <p><a href="http://blamcast.net/">Drupal theme</a> designed by Blamcast.</p>
  </div>
</div>
</div>
<script type="text/javascript">
/* <![CDATA[ */
		$(document).ready(function(){
			$("#right-toggle").click( function() {
        $("#right-toggle").hide();
        $("#content").width("953px");
        $("#sidebar-left").css("padding-left","775px");
        $("#right").css("float","none");
        $("#content").css("border-right","1px solid #1A4864");
        $("#content").css("border-left","1px solid #1A4864");
        $("#content").css("border-bottom","1px solid #1A4864");
        $("#content").css("margin","0");
			});
    });
/* ]]> */
</script>
<?php print $closure ?>
</body>
</html>
