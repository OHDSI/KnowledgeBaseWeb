{{content()}}
<div class="default-page">
    <div class="header">
        <h1 id="main-title" class="container">KnowledgeBaseWeb</h1>
        <h3 class="container">A web front-end to <A HREF="https://github.com/OHDSI/KnowledgeBase">KnowledgeBase</A></h3>
    </div>
    <div class="main container clearfix" style="width: 60%; min-width: 600px">

      <h2>Evidences: {{linkout_type}}<br><br></h2>
      <OL>
      {% for result in results %}
      <i>Evidence Item:</i><LI>
      {% for item,values in result %}
      <BR><B>{{item}}</B>:
      {% if item != "text" %}
       {% if "http" in values.value  %}
        {% if "-poc" in values.value %}
         <A TARGET="_blank" HREF="http://virtuoso.ohdsi.org:8890/describe/?url={{values.value|url_encode}}">{{values.value}}</A><BR>
        {% else %}
         <A TARGET="_blank" HREF="{{values.value}}">{{values.value}}</A><BR>
       {% endif %}
      {% endif %}
      {% else %}
        {{values.value}}
      {% endif %}
      {% endfor %}
      </LI><BR><BR>
      {% endfor %}
      </OL>
    </div>
</div>
