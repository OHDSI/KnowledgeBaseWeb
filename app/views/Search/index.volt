{{ content() }}

<div class="default-page">
    <div class="header">
        <h1 id="main-title" class="container">KnowledgeBaseWeb</h1>
        <h3 class="container">A web front-end to <A HREF="https://github.com/OHDSI/KnowledgeBase">KnowledgeBase</A></h3>
    </div>
    <div class="main container clearfix">

      <div class="searchoptions">
	<h3>Results for {{ myconcept.concept_name}} (id: {{ myconcept.concept_id}}):</H3><BR><BR>

	{% for result in results %}
	{% if SearchType == 'Event' %}

	Evidence type: {{result.EVIDENCE}}<BR>
	Linkout: <A HREF="{{result.LINKOUT}}">{{result.LINKOUT}}</A><BR>
	Statistic Type: {{result.STATISTIC_TYPE}}<BR>
	Count: {{result.COUNT}}<BR>
	Drug name: {{result.DRUG}}<BR><BR>

	{% elseif SearchType == 'Drug' %}

	Evidence type: {{result.EVIDENCE}}<BR>
	Linkout: <A HREF="{{result.LINKOUT}}">{{result.LINKOUT}}</A><BR>
	Statistic Type: {{result.STATISTIC_TYPE}}<BR>
	Count: {{result.COUNT}}<BR>
	Condition name: {{result.HOI}}<BR><BR>

	{% endif %}
	{% endfor %}

      </div>

    </div>
</div>
