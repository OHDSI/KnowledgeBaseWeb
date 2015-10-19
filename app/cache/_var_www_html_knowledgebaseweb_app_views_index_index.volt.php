<?php echo $this->getContent(); ?>

<div class="default-page">
    <div class="header">
        <h1 id="main-title" class="container">KnowledgeBaseWeb</h1>
        <h3 class="container">A web front-end to <A HREF="https://github.com/OHDSI/KnowledgeBase">KnowledgeBase</A></h3>
    </div>
    <div class="main container clearfix" style="width: 60%; min-width: 600px">
	<div class="Search k-content">
	<form  method="post" name="SearchForm" id="SearchForm">


	      <div id="radio" class="form-item">
		<label class="allcapslabel" for="SearchType">Choose ingredient, product, or event</label>
		<P id="SearchTypeError" class="error"></P>
		<input type="radio" id="Ingredient" name="SearchType" value="Ingredient"><label for="Ingredient">Ingredient</label> 
		<input type="radio" id="Clinical Drug"    name="SearchType" value="Clinical Drug"><label for="Clinical Drug">Clinical Drug</label>
		<input type="radio" id="Health Outcome"      name="SearchType" value="Health Outcome"><label for="Health Outcome">Health Outcome</label>
	      </div>

	      <div id="searchcontent" class="form-item">
		<label class="allcapslabel" for="icon-right">Enter a search term</label>
		<span class="k-textbox k-space-right" style="width: 55%;" >
		  <input type="text" id="search-input" name="query"/>
		  <span  class="k-icon k-i-search">&nbsp;</span>
		</span>
	      </div>
	      
	      <div class="form-item">
		<input type="submit" value="Search" id="submit">
	      </div>

	</form>
	</div>
    </div>
</div>
<BR><BR>

<div class="searchresultscontainer">
<?php if ($ispost) { ?>
 <div class="searchresults">
<h2>Results for <?php echo $myconcept->concept_name; ?> (<?php echo $myconcept->concept_id; ?>)</h2>

<?php if ($results) { ?>


   <div class="tabs">

   <ul class="tab-links">
   <?php $count = 0; ?>
   <?php foreach ($results as $resultType) { ?>
   <?php if ($count == 0) { ?>
   <LI class="active"><A HREF="#tab-<?php echo $resultType[0]['EVIDENCE']; ?>"><?php echo $resultTypes[$resultType[0]['EVIDENCE']]; ?></A></LI>
   <?php } else { ?>
   <LI ><A HREF="#tab-<?php echo $resultType[0]['EVIDENCE']; ?>"><?php echo $resultTypes[$resultType[0]['EVIDENCE']]; ?></A></LI>
   <?php } ?>
   <?php $count = $count + 1; ?>
   <?php } ?>
   </UL>

   <div class="tab-content">

   <?php $count = 0; ?>
   <?php foreach ($results as $resultType) { ?>
   <div id="tab-<?php echo $resultType[0]['EVIDENCE']; ?>" class="tab <?php if ($count == 0) { ?>active<?php } ?>"><P>
       <!-- begin table -->
       <table width="100%">
	 <thead>
	   <TR>
	     <TH style="max-width:500px">Evidence</TH>
	     <TH>Statistic Type</TH>
	     <TH>Quantity</TH>
	     <TH>Linkout Information</TH>
	   </TR>
	 </thead>
	 <tbody>
	   <?php foreach ($resultType as $result) { ?>
	   <TR>
	     <TD style="max-width:500px"><?php echo $this->lookup->getName($result['RESULT_CODE']); ?> (<?php echo $result['RESULT_CODE']; ?>)</TD>
	     <TD><?php echo $result['STATISTIC_TYPE']; ?></TD>
	     <TD><?php echo $result['COUNT']; ?></TD>
	     <?php if ($result['LINKOUT'] != '') { ?>
	     <TD><div id="<?php echo $result['LINKOUT']; ?>" class="linkout-result"><A TARGET="_blank"  HREF="<?php echo $result['LINKOUT']; ?>"><img src="/KnowledgeBaseWeb/public/img/JSON.png" width="32px" height="32px"></A></div></TD>
	     <?php } else { ?>
	     <TD><img src="/KnowledgeBaseWeb/public/img/JSON.png" width="32px" height="32px" style="opacity:0.2"></TD>
	     <?php } ?>

	   </TR>
	   <?php } ?>
	 </tbody>

       </table>
       <!-- end table -->
   </P></div>
   <?php $count = $count + 1; ?>
   <?php } ?>
   </div>

   </div>
</div>
<?php } else { ?>
<P class="error">No evidence for <?php echo $SearchType; ?> <?php echo $myconcept->concept_name; ?></P>
<?php } ?>
<?php } ?>
</div>

<script type="text/javascript">
$(function() {
	$( "#radio" ).buttonset();
	$( "#submit" ).button()
	$( "#search-input" ).addClass("ui-corner-all");
	jQuery('.tabs .tab-links a').on('click', function(e)  {
	var currentAttrValue = jQuery(this).attr('href');

	// Show/Hide Tabs
        jQuery('.tabs ' + currentAttrValue).show().siblings().hide();
 
        // Change/remove current tab to active
        jQuery(this).parent('li').addClass('active').siblings().removeClass('active');
 
        e.preventDefault();
    });
});

$("#search-input").keyup(function(){
	var value = $("input[name='SearchType']:checked").val();
	console.log(value);
	if(typeof value == 'undefined'){
		$("#SearchTypeError").text("Please select a search type first");
	}
});

$("input[name='SearchType']").change(function(){
    $("#SearchTypeError").text("");
    var placeholder=$(this).val();
    $('#search-input').attr('placeholder',placeholder);

    if(placeholder == 'Clinical Drug'){
	if($('#search-input').hasClass("ui-autocomplete-input")){
	    $('#search-input').autocomplete("destroy");
	}
	$('#search-input').autocomplete({
	    source: function (request, response) {
		$.getJSON("http://ec2-52-3-251-1.compute-1.amazonaws.com/KnowledgeBaseWeb/index/productsuggestion/" + request.term, function (data) {
		    console.log(data);
		    response($.map(data, function (item) {
			return {
			    label: item.concept_name,
			    value: item.concept_id
			};
		    }));
		});
	    },
	    minLength: 3,
	    delay: 300
	});
    }else if (placeholder == 'Health Outcome'){
	if($('#search-input').hasClass("ui-autocomplete-input")){
	    $('#search-input').autocomplete("destroy");
	}
	$('#search-input').autocomplete({
	    source: function (request, response) {
		$.getJSON("http://ec2-52-3-251-1.compute-1.amazonaws.com/KnowledgeBaseWeb/index/eventsuggestion/" + request.term, function (data) {
		    console.log(data);
		    response($.map(data, function (item) {
			return {
			    label: item.concept_name,
			    value: item.concept_id
			};
		    }));
		});
	    },
	    minLength: 3,
	    delay: 300
	});	
    }else if (placeholder == 'Ingredient'){
	if($('#search-input').hasClass("ui-autocomplete-input")){
	    $('#search-input').autocomplete("destroy");
	}
	$('#search-input').autocomplete({
	    source: function (request, response) {
		$.getJSON("http://ec2-52-3-251-1.compute-1.amazonaws.com/KnowledgeBaseWeb/index/ingredientsuggestion/" + request.term, function (data) {
		    console.log(data);
		    response($.map(data, function (item) {
			return {
			    label: item.concept_name,
			    value: item.concept_id
			};
		    }));
		});
	    },
	    minLength: 3,
	    delay: 300
	});	
    }
});
</script>



   
