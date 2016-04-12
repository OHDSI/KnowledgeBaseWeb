{{content()}}
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
<p>
The LAERTES project has been funded in part by the National Library of
Medicine (1R01LM011838-01) and the National Institute of Aging
(K01AG044433-01)
</p>
