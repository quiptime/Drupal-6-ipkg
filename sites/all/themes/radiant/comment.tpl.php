<?php
// $Id: comment.tpl.php,v 1.1 2009/05/29 07:41:14 agileware Exp $

/**
 * @file comment.tpl.php
 * Default theme implementation for comments.
 *
 * Available variables:
 * - $author: Comment author. Can be link or plain text.
 * - $content: Body of the post.
 * - $date: Date and time of posting.
 * - $links: Various operational links.
 * - $new: New comment marker.
 * - $picture: Authors picture.
 * - $signature: Authors signature.
 * - $status: Comment status. Possible values are:
 *   comment-unpublished, comment-published or comment-preview.
 * - $submitted: By line with date and time.
 * - $title: Linked title.
 *
 * These two variables are provided for context.
 * - $comment: Full comment object.
 * - $node: Node object the comments are attached to.
 *
 * @see template_preprocess_comment()
 * @see theme_comment()
 */
?>
<div class="comment<?php echo ($comment->new) ? ' comment-new' : ''; echo ' '. $status ?> clear-block">
  <?php echo $picture ?>
  <?php if ($comment->new): ?>
    <span class="new"><?php echo $new ?></span>
  <?php endif; ?>
  <h3 class="commentTitle"><?php echo $title ?></h3>
  <div class="metadata">
    <div class="chronodata">
      <?php echo $submitted ?>
    </div>
  </div>
  <div class="content">
    <?php echo $content ?>
    <?php if ($signature): ?>
      <div class="user-signature clear-block">
        <?php echo $signature ?>
      </div>
    <?php endif; ?>
  </div>
  <div class="metadata">
    <?php if ($links): ?>
      <div class="links">
        <?php echo $links ?>
      </div>
    <?php endif; ?>
  </div>
</div>
