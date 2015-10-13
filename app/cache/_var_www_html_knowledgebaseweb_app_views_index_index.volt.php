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
		<input type="radio" id="Ingredient" name="SearchType" value="Ingredient"><label for="Ingredient">Ingredient</label> 
		<input type="radio" id="Product"    name="SearchType" value="Product"><label for="Product">Product</label>
		<input type="radio" id="Event"      name="SearchType" value="Event"><label for="Event">Event</label>
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
<h3>Results for <?php echo $myconcept->concept_name; ?> (<?php echo $myconcept->concept_id; ?>)</h3>
 <div id="example" ng-app="KendoDemos">
        <div class="demo-section k-content" ng-controller="MyCtrl">
            <div kendo-tree-view="tree"
                 k-data-source="treeData"
                 ng-click="toggle($event)">
            </div>
        </div>
    </div>

<?php if ($ispost) { ?>

<?php if ($results) { ?>
 <div class="searchresults">


	<script>
	  angular.module("KendoDemos", [ "kendo.directives" ])
		.controller("MyCtrl", function($scope){
			$scope.treeData = new kendo.data.HierarchicalDataSource({ data: [
	  
	  <?php foreach ($results as $resultType) { ?>
	  {text: "<?php echo $resultType[0]['EVIDENCE']; ?>", items:[
	  <?php foreach ($resultType as $result) { ?>	  
	  {
		text:"<?php echo $this->lookup->getName($result['RESULT_CODE']); ?> (<?php echo $result['RESULT_CODE']; ?>)",items:[
			{text:"Statistic Type: <?php echo $result['STATISTIC_TYPE']; ?>"},
			{text:"Quantity: <?php echo $result['COUNT']; ?>"},
			{text:"<?php echo $result['LINKOUT']; ?>", url:"<?php echo $result['LINKOUT']; ?>"}
		],
	  },
	  <?php } ?>
	  ]},
	  <?php } ?>
	  ]});
	  
	  $scope.toggle = function(e) {
		var dataItem = this.tree.dataItem(e.target);
		dataItem.set("expanded", !dataItem.expanded);
		};
	  })
    </script>
      </div>
<?php } else { ?>
No evidence for <?php echo $SearchType; ?> <?php echo $myconcept->concept_name; ?>
<?php } ?>
<?php } ?>

<script type="text/javascript">
$(function() {
	$( "#radio" ).buttonset();
	$( "#submit" ).button()
	$( "#search-input" ).addClass("ui-corner-all");
});

var st=$("input[name='SearchType']").val();
$('#search-input').attr('placeholder',st);
if(st == 'Product'){
	$('input:radio[name="SearchType"]').filter('[value="Drug"]').attr('checked', true);
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
    }else if (st == 'Event'){
	$('input:radio[name="SearchType"]').filter('[value="Event"]').attr('checked', true);
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
    }else if (st == 'Ingredient'){
	if($('#search-input').hasClass("ui-autocomplete-input")){
	    $('#search-input').autocomplete("destroy");
	}
	$('#search-input').autocomplete({
	    source: function (request, response) {
		$.getJSON("http://ec2-52-3-251-1.compute-1.amazonaws.com/KnowledgeBaseWeb/index/ingredienttsuggestion/" + request.term, function (data) {
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

$("input[name='SearchType']").change(function(){
    var placeholder=$(this).val();
    $('#search-input').attr('placeholder',placeholder);

    if(placeholder == 'Product'){
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
    }else if (placeholder == 'Event'){
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



   
