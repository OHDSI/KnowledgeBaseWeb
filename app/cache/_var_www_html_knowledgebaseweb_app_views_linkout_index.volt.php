<?php echo $this->getContent(); ?>
<div class="default-page">
    <div class="header">
        <h1 id="main-title" class="container">Experimental LAERTES Evidence Base Explorer</h1>
        <h3 class="container">An experimental web front-end to <A HREF="https://github.com/OHDSI/KnowledgeBase">The LAERTES Evidence Base </A></h3>
    </div>
    <div class="main container clearfix" style="width: 60%; min-width: 600px">
      <p>This experimental "drill down" view provides a sub-set of the
      information on each evidence item provided by the source. "an"
      and "body" elements are from
      the <a href="www.openannotation.org/spec/core/"
      target="_blank">Open Annotation Data</a> graphs used to
      represent each evidence item. Clicking on these items will take
      you to a faceted browser view of the data. 
      </p>
      <br>    
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
<p>
The LAERTES project has been funded in part by the National Library of
Medicine (1R01LM011838-01) and the National Institute of Aging
(K01AG044433-01)
</p>
