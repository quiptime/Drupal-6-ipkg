<?php
// $Id: page.tpl.php,v 1.21 2009/06/23 17:59:19 jrglasgow Exp $;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="<?php print $language->language; ?>" xml:lang="<?php print $language->language; ?>">
<head>
  <title><?php print $head_title ?></title>
  <?php print $head ?>
  <?php print $styles ?>
  <?php print $scripts ?>
  <script type="text/javascript"><?php /* Needed to avoid Flash of Unstyle Content in IE */ ?> </script>
  <!--
  // this block of JS is supposed to extend the suckerfish rollovers, but it
  // seems to have no effect that I can perceive except to change the background
  // color and keep it hard encoded: not css dependant
  <script type="text/javascript">
  $(document).ready(function(){
    // Code for extending suckerfish rollovers
    $("#suckerfishmenu .content ul.menu:first > li").hover(function(event){
      $(this).children("> a").css("background",$("#footer a").css("color"));
    },function(event){
      $(this).children("> a").css("background","#3f3f3f");
    });
  });  
  </script>
  -->
  <?php if (theme_get_setting('simply_modern_width')) { ?>
    <style type="text/css">
    #page, #squeeze-top {
      width : <?php print (theme_get_setting('simply_modern_fixedwidth') + 22); ?>px;
    }
    #top-center {
      width : <?php print theme_get_setting('simply_modern_fixedwidth'); ?>px;
    }
    #top-container {
    padding:0;
    }
    #squeeze-top {
      background:#020202 url('<?php print url(drupal_get_path('theme', 'simply_modern') .'/images/top_gradient_dark.jpg' )?>') repeat-x;
      margin:0 auto;
    }
    </style>
  <?php } else { ?>
    <style type="text/css">
    #page, #top-center {
      width: 95%;
    }

    </style>
  <?php }  ?>
  <?php if ($left_sidebar_width = theme_get_setting('simply_modern_leftsidebarwidth')) { ?>
    <style type="text/css">
    body.sidebar-left #main {
      margin-left: -<?php print $left_sidebar_width; ?>px;
    }
    body.sidebars #main {
      margin-left: -<?php print $left_sidebar_width; ?>px;
    }
    body.sidebar-left #squeeze {
      margin-left: <?php print $left_sidebar_width; ?>px;
    }
    body.sidebars #squeeze {
      margin-left: <?php print $left_sidebar_width; ?>px;
    }
    #sidebar-left {
      width: <?php print $left_sidebar_width; ?>px;
    }
    </style>
  <?php }  ?>
  <?php if ($right_sidebar_width = theme_get_setting('simply_modern_rightsidebarwidth')) { ?>
    <style type="text/css">
    body.sidebar-right #main {
      margin-right: -<?php print $right_sidebar_width; ?>px;
    }
    body.sidebars #main {
      margin-right: -<?php print $right_sidebar_width; ?>px;
    }
    body.sidebar-right #squeeze {
      margin-right: <?php print $right_sidebar_width; ?>px;
    }
    body.sidebars #squeeze {
      margin-right: <?php print $right_sidebar_width; ?>px;
    }
    #sidebar-right {
      width: <?php print $right_sidebar_width; ?>px;
    }
    </style>
  <?php }  ?>
  <?php if (theme_get_setting('simply_modern_fontfamily')) { ?>
    <style type="text/css">
    body {
      font-family : <?php print theme_get_setting('simply_modern_fontfamily'); ?>;
    }
    </style>
  <?php }  ?>
  <?php if (theme_get_setting('simply_modern_fontfamily') == 'Custom') { ?>
    <?php if (theme_get_setting('simply_modern_customfont')) { ?>
      <style type="text/css">
      body {
        font-family : <?php print theme_get_setting('simply_modern_customfont'); ?>;
      }
      </style>
    <?php }  ?>
  <?php }  ?>
  <?php if (theme_get_setting('simply_modern_iepngfix')) { ?>
<!--[if lte IE 6]>
<script type="text/javascript"> 
    $(document).ready(function(){ 
        $(document).pngFix(); 
    }); 
</script> 
<![endif]-->
  <?php } ?>
  <?php if (theme_get_setting('simply_modern_usecustomlogosize')) { ?>
    <style type="text/css">
    img#logo {
      width : <?php print theme_get_setting('simply_modern_logowidth'); ?>px;
      height: <?php print theme_get_setting('simply_modern_logoheight'); ?>px;
    }
    </style>
  <?php }  ?>
  <style type="text/css">
  body {
  <?php if (theme_get_setting('usecustombodybg')) { ?>  
    background-image:url('/<?php print theme_get_setting('body_bg_path') ?>');
    <?php if (theme_get_setting('bodytile') == 'vertical') { ?>
    background-repeat:repeat-y;
    <?php } ?>
    <?php if (theme_get_setting('bodytile') == 'horizontal') { ?>
    background-repeat:repeat-x;
    <?php } ?>
    <?php if (theme_get_setting('bodytile') == 'fulltile') { ?>
    background-repeat:repeat;
    <?php } ?>
  <?php } ?>
  <?php if (theme_get_setting('background_color')) { ?>
    background-color:#<?php print theme_get_setting('background_color'); ?>;
    background-image:none;
  <?php } ?>
  }
  </style>
  
 
  <style type="text/css">
  #header {
  <?php if (theme_get_setting('default_custom') == 'custom') { ?>
    background-image:url('<?php print url(theme_get_setting('masthead_bg_path')) ?>');
    <?php if (theme_get_setting('mastheadfixedfluid') ) { ?>
        height:<?php print theme_get_setting('mastheadfixedfluid') ?>px;
      <?php } ?>
    <?php if (theme_get_setting('mastheadtile') == 'fulltile') { ?>
    background-repeat:repeat;
    <?php } else if (theme_get_setting('mastheadtile') == 'vertical') { ?>
    background-repeat:repeat-y;
    <?php } else if (theme_get_setting('mastheadtile') == 'horizontal') { ?>
    background-repeat:repeat-x;
    <?php } ?>
  <?php } else if (theme_get_setting('default_custom') == 'none') { ?>
    background-image:none;
  <?php } else if (theme_get_setting('default_custom') == 'default') { ?>
    <?php if (theme_get_setting('mastheadfixedfluid')) {?>
      min-height:<?php print theme_get_setting('mastheadfixedfluid'); ?>px;
    <?php } ?>
  <?php } ?>
  <?php if (theme_get_setting('masthead_color')) { ?>
    background-color:#<?php print theme_get_setting('masthead_color'); ?>;
    background-image:none;
  <?php } ?>
  }
  </style>
<!--[if IE]>
<style type="text/css" media="all">@import "<?php print base_path() . path_to_theme() ?>/css/ie.css";</style>
<![endif]-->
  <?php if ($suckerfish) { ?>
    <?php if (theme_get_setting('simply_modern_suckerfish')) { ?>
<!--[if lte IE 6]>
<script type="text/javascript" src="<?php print $GLOBALS['base_url']."/"; print $directory; ?>/js/suckerfish.js"></script>
<![endif]-->
    <?php }  ?>
  <?php } ?>
  <?php if ( (theme_get_setting('simply_modern_sidebar_positions') == 'left' )) { ?>
  <style type="text/css">
  #sidebar-right {
    position:relative;
    left:4px;
  }
  </style>
  <?php } ?>
  <?php if ( (theme_get_setting('simply_modern_sidebar_positions') == 'right' )) { ?>
  <style type="text/css">
  #sidebar-left {
    position:relative;
    right:4px;
  }
  </style>
  <?php } ?>
  <!-- <script type="text/javascript" src="<?php print $GLOBALS['base_url']."/"; print $directory; ?>/js/pickstyle.js"></script> -->
</head>
<body<?php print phptemplate_body_class($sidebar_left, $sidebar_right); ?>>
  <div id="simplemenu_container"></div>
  <div id="simplemenu_closing-div" style="clear:both;"></div>
  <?php
  $arg_count = 0;
  $class="";
  for ($i = 0; $i <=10; $i++) {
    if(arg($i)) {
      if ($arg_count) {
        $class .= '-';
      }
      $class .= arg($i);
      $arg_count++;
    }
  }
  ?>
  <?php if ($banner): ?>
    <div id="banner">
      <?php print $banner; ?>
    </div>
  <?php endif ?>
  <?php if (theme_get_setting('toggle_search') || theme_get_setting('toggle_logo') || theme_get_setting('toggle_primary_links')) { ?>
  <div id="top-container">
    <div id="squeeze-top">
      <div id="top-center">
        <div id="logo-title">
            <?php if ($logo) { ?>
                <a href="<?php print $base_path; ?>" title="<?php print t('Home'); ?>"> <img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" id="logo" /> </a>
            <?php } ?>
          </div><!-- /logo-title -->
          <?php if (isset($primary_links) ) { ?>
            <div id="primarymenu">
            <?php if (isset($primary_links)) : ?>
              <?php print theme('links', $primary_links, array('class' => 'links primary-links')) ?>
            <?php endif; ?>
            <?php print $search_box; ?>
            </div>
        <?php } ?>
        </div>
      </div>
  </div>
  <?php } else { ?>
    <style type="text/css">
      #banner {background-color:transparent;}
    </style>
  <?php } ?>
  <div id="page" <?php print ($class ? 'class="'. $class .'"' : ''); ?>><div id="shadow-right"><div id="page-bg">
  <?php if (theme_get_setting('toggle_name') || theme_get_setting('toggle_slogan') || $header) { ?>
    <div id="header" class="clear-block">
      <div id="name-and-slogan">
        <?php if ($site_name): ?>
          <h1 class='site-name'> <a href="<?php print $base_path ?>" title="<?php print t('Home'); ?>"> <?php print $site_name; ?> </a> </h1>
        <?php endif; ?>
        <?php if ($site_slogan): ?>
          <div class='site-slogan'> <?php print $site_slogan; ?> </div>
        <?php endif; ?>
      </div><!-- /name-and-slogan -->
      
    <?php if ($header): ?>
        <div style="clear:both"></div>
        <?php print $header; ?>
      <?php endif; ?>
    </div><!-- /header -->
    <?php } ?>
    <?php if ($suckerfish): ?>
        <div style="clear:both"></div>
        <div id="suckerfishmenu" class="clear-block"> <?php print $suckerfish; ?> </div>
    <?php endif; ?>
    <?php
      $section1count = 0;
      if ($user1)  { $section1count++; }
      if ($user2)  { $section1count++; }
      if ($user3)  { $section1count++; }
    ?>
    <?php if ($section1count): ?>
      <?php $section1width = 'width' . floor(99 / $section1count); ?>
      <div class="clear-block clr" id="section1">
        <div class="sections">
          <?php if ($user1): ?>
            <div class="section <?php echo $section1width; ?>"><?php print $user1; ?></div>
          <?php endif; ?>
          <?php if ($user2): ?>
            <div class="section <?php echo $section1width; ?>"><?php print $user2; ?></div>
          <?php endif; ?>
          <?php if ($user3): ?>
            <div class="section <?php echo $section1width; ?>"><?php print $user3; ?></div>
          <?php endif; ?>
        </div>
        <div style="clear:both"></div>
      </div><!-- /section1 -->
    <?php endif; ?>
    <div id="middlecontainer">
      <?php if ((theme_get_setting('simply_modern_sidebar_positions') == 'left') || (theme_get_setting('simply_modern_sidebar_positions') == 'split')) { ?>
        <?php if ($sidebar_left) { ?>
          <div id="sidebar-left"><?php print $sidebar_left; ?> </div>
        <?php  }?>
      <?php } ?>
      <?php if ( (theme_get_setting('simply_modern_sidebar_positions') == 'left' )) { ?>
        <?php if ($sidebar_right) { ?>
          <div id="sidebar-right"><?php print $sidebar_right; ?> </div>
        <?php } ?>
      <?php } ?>
      <div id="main">
        <div id="squeeze">
          <?php if (theme_get_setting('simply_modern_breadcrumb')): ?>
            <?php if ($breadcrumb): ?>
              <div id="breadcrumb"> <?php print $breadcrumb; ?> </div>
            <?php endif; ?>
          <?php endif; ?>
          <?php if ($mission) { ?>
            <div id="mission"><?php print $mission; ?></div>
          <?php } ?>
          <div id="squeeze-content">
            <?php
              $page_class = '';
              $count = 0;
              for ($i = 0; $i <= 5; $i++) {
                if (($count > 0) && arg($i)) {
                  $page_class .= '-';
                }
                $page_class .= arg($i);
                $count++;
              }
            ?>
            <div id="inner-content" <?php if ($page_class) {print ' class="'. $page_class .'" ';}?>>
             <?php if ($content_top):?>
                <div id="content-top"><?php print $content_top; ?></div>
              <?php endif; ?>
              <h1 class="title"><?php print $title; ?></h1>
              <div class="tabs"><?php print $tabs; ?></div>
              <?php print $help; ?>
              <?php if ($show_messages) { print $messages; } ?>
              <?php print $content; ?> 
              <?php print $feed_icons; ?>
              <?php if ($content_bottom): ?>
                <div id="content-bottom"><?php print $content_bottom; ?></div>
              <?php endif; ?>
            </div><!-- /inner-content -->
          </div><!-- /squeeze-content -->
        </div><!-- /squeeze -->
      </div><!-- /main -->
      <?php if ((theme_get_setting('simply_modern_sidebar_positions') == 'right')) { ?>
        <?php if ($sidebar_left) {?>
          <div id="sidebar-left"><?php print $sidebar_left; ?> </div>
        <?php } ?>
      <?php } ?>
      <?php if (((theme_get_setting('simply_modern_sidebar_positions') == 'right') || (theme_get_setting('simply_modern_sidebar_positions') == 'split'))) { ?>
        <?php if ($sidebar_right) { ?>
          <div id="sidebar-right"><?php print $sidebar_right; ?> </div>
        <?php } ?>
      <?php } ?>
    </div><!-- /middle-container -->
    <div style="clear:both"></div>
    <?php
      $section2count = 0;
      if ($user4)  { $section2count++; }
      if ($user5)  { $section2count++; }
      if ($user6)  { $section2count++; }
    ?>
    <?php if ($section2count): ?>
      <?php $section2width = 'width' . floor(99 / $section2count); ?>
      <div class="clear-block clr" id="section2">
        <div class="sections">
          <?php if ($user4): ?>
            <div class="section <?php echo $section2width ?>"><?php print $user4; ?></div>
          <?php endif; ?>
          <?php if ($user5): ?>
            <div class="section <?php echo $section2width ?>"><?php print $user5; ?></div>
          <?php endif; ?>
          <?php if ($user6): ?>
            <div class="section <?php echo $section2width ?>"><?php print $user6; ?></div>
          <?php endif; ?>
        </div>
        <div style="clear:both"></div>
      </div><!-- /section2 -->
    <?php endif; ?>
    <?php if (isset($secondary_links)) : ?>
      <div id="secondary-links">
        <?php print theme('links', $secondary_links, array('class' => 'links secondary-links')); ?> 
        <div style="clear:both"></div>
      </div>
    <?php endif; ?>
    <div id="footer">
      <?php if ($footer_region) { ?>
        <div id="footer-region"><?php print $footer_region; ?></div>
      <?php } ?>
      <?php if ($footer_message) { ?>
        <div id="footer-message"><?php print $footer_message; ?></div>
      <?php } ?>
    <div style="color:gray"><strong>THEME DESIGN</strong> Copyright &#169; 2009 under <a href="http://www.gnu.org/licenses/gpl.html" target="_blank">GPL</a> by <a href="http://www.tributemedia.com" title="High Performing, Industry Specific Websites" target="_blank">Tribute Media</a>. Site Powered by <a href="http://drupal.org/">Drupal</a>.</div>
    </div><!-- /footer -->
  <div style="clear:both"></div>
  <?php print $closure; ?></div></div>
  </div> <!-- /page -->
</body>
</html>