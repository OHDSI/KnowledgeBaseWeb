{{content() }}

<div class="default-page">
    <div class="header">
        <h1 id="main-title" class="container">KnowledgeBaseWeb</h1>
        <h3 class="container">A web front-end to <A HREF="https://github.com/OHDSI/KnowledgeBase">KnowledgeBase</A></h3>
    </div>
    <div class="main container clearfix">
	<div class="Search">
	<form  method="post" name="SearchForm" id="SearchForm">
	  Search for:<BR><BR>
	  Drug <input type="radio" id="SearchType" name="SearchType" value="Drug"> or Event <input id="SearchType" type="radio" name="SearchType" value="Event"><BR><BR>
	  <div id="typeahead_div"><input id="search-input" placeholder="" type="text" name="query"><input type="submit" value="submit"></div>
	</form>
	</div>
    </div>
</div>

{% if results %}

 <div class="searchresults">
	<h3>Results for {{ myconcept.concept_name}} (id: {{ myconcept.concept_id}}):</H3><BR><BR>

	{% for result in results %}
	{% if SearchType == 'Event' %}

	Evidence type: {{result.EVIDENCE}}<BR>
	Linkout: <A HREF="{{result.LINKOUT}}">{{result.LINKOUT}}</A><BR>
	Statistic Type: {{result.STATISTIC_TYPE}}<BR>
	Count: {{result.COUNT}}<BR>
	Drug name: {{lookup.getName(result.DRUG)}}<BR><BR>

	{% elseif SearchType == 'Drug' %}

	Evidence type: {{result.EVIDENCE}}<BR>
	Linkout: <A HREF="{{result.LINKOUT}}">{{result.LINKOUT}}</A><BR>
	Statistic Type: {{result.STATISTIC_TYPE}}<BR>
	{% if result.COUNT %}
	Count: {{result.COUNT}}<BR>
	{% elseif result.VALUE %}
	Value: {{result.VALUE}}<BR>
	{% endif %}
	Condition name: {{lookup.getName(result.HOI)}}<BR><BR>

	{% endif %}
	{% endfor %}

      </div>
{% else %}
no evidence for {{SearchType}} {{myconcept.concept_name}}
{% endif %}

<script type="text/javascript">

var st = $("input[name='SearchType']").val();
$('#search-input').attr('placeholder',st);
if(st == 'Drug'){
	$('input:radio[name="SearchType"]').filter('[value="Drug"]').attr('checked', true);
	if($('#search-input').hasClass("ui-autocomplete-input")){
	    $('#search-input').autocomplete("destroy");
	}
	$('#search-input').autocomplete({
	    source: function (request, response) {
		$.getJSON("http://ec2-52-3-251-1.compute-1.amazonaws.com/KnowledgeBaseWeb/index/drugsuggestion/" + request.term, function (data) {
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
    }

$("input[name='SearchType']").change(function(){
    var placeholder=$(this).val();
    $('#search-input').attr('placeholder',placeholder);

    if(placeholder == 'Drug'){
	if($('#search-input').hasClass("ui-autocomplete-input")){
	    $('#search-input').autocomplete("destroy");
	}
	$('#search-input').autocomplete({
	    source: function (request, response) {
		$.getJSON("http://ec2-52-3-251-1.compute-1.amazonaws.com/KnowledgeBaseWeb/index/drugsuggestion/" + request.term, function (data) {
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
    }
});




</script>
