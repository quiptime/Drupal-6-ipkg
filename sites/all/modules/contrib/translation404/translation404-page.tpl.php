<?php
/* translation_not_found tempalte file*/
?>
<div id="translation-not-found-page">
  <?php foreach($languages_info as $languages_info_item): ?>
    <div id="<?php print $languages_info_item['id']; ?>" class ="<?php print $languages_info_item['direction_class']; ?>">
      <h2 class="lang-native-name"><?php print $languages_info_item['native']; ?><h2>
      <h3 class="lang-page-desc"><?php print $languages_info_item['page_desc']; ?><h3>
      <h4 class="lang-actions-title"><?php print $languages_info_item['actions_title']; ?><h4>  
      <?php print $languages_info_item['themed_links']?>  
    </div>
  <?php endforeach; ?>
</div>