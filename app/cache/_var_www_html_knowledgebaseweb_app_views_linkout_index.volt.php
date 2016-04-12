<?php echo $this->getContent(); ?>
<div class="default-page">
    <div class="header">
        <h1 id="main-title" class="container">KnowledgeBaseWeb</h1>
        <h3 class="container">A web front-end to <A HREF="https://github.com/OHDSI/KnowledgeBase">KnowledgeBase</A></h3>
    </div>
    <div class="main container clearfix" style="width: 60%; min-width: 600px">

      <h2>Evidences: <?php echo $linkout_type; ?><br><br></h2>
      <OL>
      <?php foreach ($results as $result) { ?>
      <i>Evidence Item:</i><LI>
      <?php foreach ($result as $item => $values) { ?>
      <BR><B><?php echo $item; ?></B>:
      <?php if ($item != 'text') { ?>
       <?php if ($this->isIncluded('http', $values->value)) { ?>
        <?php if ($this->isIncluded('-poc', $values->value)) { ?>
         <A TARGET="_blank" HREF="http://virtuoso.ohdsi.org:8890/describe/?url=<?php echo urlencode($values->value); ?>"><?php echo $values->value; ?></A><BR>
        <?php } else { ?>
         <A TARGET="_blank" HREF="<?php echo $values->value; ?>"><?php echo $values->value; ?></A><BR>
       <?php } ?>
      <?php } ?>
      <?php } else { ?>
        <?php echo $values->value; ?>
      <?php } ?>
      <?php } ?>
      </LI><BR><BR>
      <?php } ?>
      </OL>
    </div>
</div>
