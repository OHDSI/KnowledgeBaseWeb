{{content() }}

<div class="default-page">
    <div class="header">
        <h1 id="main-title" class="container">Experimental LAERTES Evidence Base Explorer</h1>
        <h3 class="container">An experimental web front-end to <A HREF="https://github.com/OHDSI/KnowledgeBase">The LAERTES Evidence Base</A></h3>
    </div>
    <div class="main container clearfix" style="width: 60%; min-width: 600px">
	<div class="Search k-content">
	<form  method="post" name="SearchForm" id="SearchForm">
	  <p>This experimental user interface allows for
            exploration of data present in the LAERTES evidence
            base. Please see
            the <a href="http://www.ohdsi.org/web/wiki/doku.php?id=projects:workgroups:kb-wg"
		   target = "_blank">workgroup page on ohdsi.org</a> for
            more information.
          </p>
          <br>
          <p><b>NOTE:</b> At this time, data from US drug product
            labeling is only retrievable through the "Clinical Drug"
            search. This will be fixed in a future release. Also, at
            this time, there is no "linkout" data available for the
            FAERS sources.
          </p>
	  
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
{% if ispost %}
 <div class="searchresults">
<h2>Results for {{myconcept.concept_name}} ({{myconcept.concept_id}})</h2>

{% if results %}


   <div class="tabs">

   <ul class="tab-links">
   {% set count=0 %}
   {% for resultType in results %}
   {% if count == 0 %}
   <LI class="active"><A HREF="#tab-{{resultType[0]['EVIDENCE']}}">{{resultTypes[resultType[0]['EVIDENCE']]}}</A></LI>
   {% else %}
   <LI ><A HREF="#tab-{{resultType[0]['EVIDENCE']}}">{{resultTypes[resultType[0]['EVIDENCE']]}}</A></LI>
   {% endif %}
   {% set count = count+1 %}
   {% endfor %}
   </UL>

   <div class="tab-content">

   {% set count=0 %}
   {% for resultType in results %}
   <div id="tab-{{resultType[0]['EVIDENCE']}}" class="tab {%if count == 0%}active{% endif%}"><P>
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
	   {% for result in resultType %}
	   <TR>
	     <TD style="max-width:500px">{{result['RESULT_NAME']}} ({{result['RESULT_CODE']}})</TD>
	     <TD>{{result['STATISTIC_TYPE']}}</TD>
	     <TD>{{result['COUNT']}}</TD>
	     {% if result['LINKOUT'] <> '' %}
	     <TD><div id="{{result['LINKOUT']}}" class="linkout-result"><form action="/KnowledgeBaseWeb/Linkout" method="post" onsubmit="target_popup(this)"><input type="hidden" name="linkout_url" value="{{result['LINKOUT']}}"><input class="submitImgClass" type="submit" src="/KnowledgeBaseWeb/public/img/JSON.png" ><input type="hidden" name="linkout_type" value="{{result['EVIDENCE']}}"></form></div></TD>
	     {% else %}
	     <TD><img src="/KnowledgeBaseWeb/public/img/JSON.png" width="32px" height="32px" style="opacity:0.2"></TD>
	     {% endif %}

	   </TR>
	   {% endfor %}
	 </tbody>

       </table>
       <!-- end table -->
   </P></div>
   {% set count = count + 1 %}
   {% endfor %}
   </div>

   </div>
</div>
{% else %}
<P class="error">No evidence for {{SearchType}} {{myconcept.concept_name}}</P>
{% endif %}
{% endif %}
<p>
The LAERTES project has been funded in part by the National Library of
Medicine (1R01LM011838-01) and the National Institute of Aging
(K01AG044433-01)
</p>
</div>




<script type="text/javascript">

function target_popup(form){
	window.open('','formpopup');
	form.target = 'formpopup';
}

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



   
