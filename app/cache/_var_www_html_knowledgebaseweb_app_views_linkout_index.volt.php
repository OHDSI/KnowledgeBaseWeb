<?php echo $this->getContent(); ?>
<div class="default-page">
    <div class="header">
        <h1 id="main-title" class="container">KnowledgeBaseWeb</h1>
        <h3 class="container">A web front-end to <A HREF="https://github.com/OHDSI/KnowledgeBase">KnowledgeBase</A></h3>
    </div>
    <div class="main container clearfix" style="width: 60%; min-width: 600px">
      
      <h2>Evidences: <?php echo $linkout_type; ?></h2>
      <OL>	
      <?php foreach ($results as $result) { ?>
      <LI>
      <?php foreach ($result as $item => $values) { ?>
      <B><?php echo $item; ?></B>: 
      <?php if ($this->isIncluded('http', $values->value)) { ?>
	<A HREF="<?php echo $values->value; ?>"><?php echo $values->value; ?></A><BR>
      <?php } else { ?>
	<?php echo $values->value; ?><BR>
      <?php } ?>
      <!--
      <LI>
	URL: <A HREF="<?php echo $result->pmid->value; ?>"><?php echo $result->pmid->value; ?></A><BR>
	Exact: <?php echo $result->exact->value; ?><BR>
	Prefix: <?php echo $result->prefix->value; ?><BR>
	Postfix: <?php echo $result->postfix->value; ?><BR>
	Predicate Lab: <?php echo $result->predicateLab->value; ?><BR><BR>
	</LI>
      !-->
      <?php } ?>
      </LI><BR><BR>
      <?php } ?>
      </OL>
    </div>
</div>
