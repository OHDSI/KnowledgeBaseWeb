<!DOCTYPE html>
<!-- moved scripts to top of html - ben -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

<link rel="stylesheet" href="/KnowledgeBaseWeb/public/css/kendo.common-material.min.css">
<link rel="stylesheet" href="/KnowledgeBaseWeb/public/css/kendo.material.min.css">
<link rel="stylesheet" href="/KnowledgeBaseWeb/public/css/kendo.material.mobile.min.css">
<link rel="stylesheet" href="/KnowledgeBaseWeb/public/css/kendo.rtl.min.css">
<link rel="stylesheet" href="/KnowledgeBaseWeb/public/css/sails.css">
<link rel="stylesheet" href="/KnowledgeBaseWeb/public/css/KBW.css">
<script src="/KnowledgeBaseWeb/public/js/jquery-1.11.3.min.js"></script>
<script src="/KnowledgeBaseWeb/public/js/angular.min.js"></script>
<script src="/KnowledgeBaseWeb/public/js/kendo.all.min.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

<html>
  <head>
    <title>KnowledgeBaseWeb</title>

    <!-- Viewport mobile tag for sensible mobile support -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    
    <!--  
        Stylesheets and Preprocessors
        ==============================

        You can always bring in CSS files manually with `<link>` tags, or asynchronously
        using a solution like AMD (RequireJS).  Or, if you like, you can take advantage 
        of Sails' conventional asset pipeline (boilerplate Gruntfile).

        By default, stylesheets from your `assets/styles` folder are included
        here automatically (between STYLES and STYLES END). Both CSS (.css) and LESS (.less)
        are supported. In production, your styles will be minified and concatenated into
        a single file.
        
        To customize any part of the built-in behavior, just edit `tasks/pipeline.js`.
        For example, here are a few things you could do:
            
            + Change the order of your CSS files
            + Import stylesheets from other directories
            + Use a different or additional preprocessor, like SASS, SCSS or Stylus
    -->

    <!--STYLES-->
    <!-- <link rel="stylesheet" href="/styles/importer.css">-->
    <!--STYLES END-->
<!-- Default home page -->


</head>
<body>
        {{ content() }}

    <!--
        Client-side Templates
        ========================

        HTML templates are important prerequisites of modern, rich client applications.
        To work their magic, frameworks like Backbone, Angular, Ember, and Knockout require
        that you load these templates client-side.

        By default, your Gruntfile is configured to automatically load and precompile
        client-side JST templates in your `assets/templates` folder, then
        include them here automatically (between TEMPLATES and TEMPLATES END).
        
        To customize this behavior to fit your needs, just edit `tasks/pipeline.js`.
        For example, here are a few things you could do:

            + Import templates from other directories
            + Use a different template engine (handlebars, jade, dust, etc.)
            + Internationalize your client-side templates using a server-side
              stringfile before they're served.
    -->

    <!--TEMPLATES-->
    
    <!--TEMPLATES END-->


    <!--

      Client-side Javascript
      ========================

      You can always bring in JS files manually with `script` tags, or asynchronously
      on the client using a solution like AMD (RequireJS).  Or, if you like, you can 
      take advantage of Sails' conventional asset pipeline (boilerplate Gruntfile).

      By default, files in your `assets/js` folder are included here
      automatically (between SCRIPTS and SCRIPTS END).  Both JavaScript (.js) and
      CoffeeScript (.coffee) are supported. In production, your scripts will be minified
      and concatenated into a single file.
      
      To customize any part of the built-in behavior, just edit `tasks/pipeline.js`.
      For example, here are a few things you could do:
          
          + Change the order of your scripts
          + Import scripts from other directories
          + Use a different preprocessor, like TypeScript

    -->

    <!--SCRIPTS-->

    <!--SCRIPTS END-->
  </body>
</html>
