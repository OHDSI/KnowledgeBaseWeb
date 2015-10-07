<?php echo $this->getContent(); ?>

<div class="default-page">
    <div class="header">
        <h1 id="main-title" class="container">KnowledgeBaseWeb</h1>
        <h3 class="container">A web front-end to <A HREF="https://github.com/OHDSI/KnowledgeBase">KnowledgeBase</A></h3>
    </div>
    <div class="main container clearfix">

      <div class="searchoptions">
	<h3>Results for <?php echo $myconcept->concept_name; ?> (id: <?php echo $myconcept->concept_id; ?>):</H3><BR><BR>

	<?php foreach ($results as $result) { ?>
	<?php if ($SearchType == 'Event') { ?>

	Evidence type: <?php echo $result->EVIDENCE; ?><BR>
	Linkout: <A HREF="<?php echo $result->LINKOUT; ?>"><?php echo $result->LINKOUT; ?></A><BR>
	Statistic Type: <?php echo $result->STATISTIC_TYPE; ?><BR>
	Count: <?php echo $result->COUNT; ?><BR>
	Drug name: <?php echo $result->DRUG; ?><BR><BR>

	<?php } elseif ($SearchType == 'Drug') { ?>

	Evidence type: <?php echo $result->EVIDENCE; ?><BR>
	Linkout: <A HREF="<?php echo $result->LINKOUT; ?>"><?php echo $result->LINKOUT; ?></A><BR>
	Statistic Type: <?php echo $result->STATISTIC_TYPE; ?><BR>
	Count: <?php echo $result->COUNT; ?><BR>
	Condition name: <?php echo $result->HOI; ?><BR><BR>

	<?php } ?>
	<?php } ?>

      </div>

    </div>
</div>
