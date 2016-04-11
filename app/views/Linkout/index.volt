{{content()}}
<div class="default-page">
    <div class="header">
        <h1 id="main-title" class="container">KnowledgeBaseWeb</h1>
        <h3 class="container">A web front-end to <A HREF="https://github.com/OHDSI/KnowledgeBase">KnowledgeBase</A></h3>
    </div>
    <div class="main container clearfix" style="width: 60%; min-width: 600px">
      
      <h2>Evidences: {{linkout_type}}</h2>
      <OL>	
      {% for result in results %}
      <LI>
      {% for item,values in result %}
      <B>{{item}}</B>: 
      {% if "http" in values.value %}
	<A HREF="{{values.value}}">{{values.value}}</A><BR>
      {% else %}
	{{values.value}}<BR>
      {% endif %}
      <!--
      <LI>
	URL: <A HREF="{{result.pmid.value}}">{{result.pmid.value}}</A><BR>
	Exact: {{result.exact.value}}<BR>
	Prefix: {{result.prefix.value}}<BR>
	Postfix: {{result.postfix.value}}<BR>
	Predicate Lab: {{result.predicateLab.value}}<BR><BR>
	</LI>
      !-->
      {% endfor %}
      </LI><BR><BR>
      {% endfor %}
      </OL>
    </div>
</div>
