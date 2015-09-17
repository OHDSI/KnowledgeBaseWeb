/**
 * SearchController
 *
 * @description :: Server-side logic for managing users
 * @help        :: See http://sailsjs.org/#!/documentation/concepts/Controllers
 */

module.exports = {

    
    show: function(req,res,next){
	//search term
	var term = req.param("query");
	
	//save search term to forwarding view
	res.locals.term = term;

	//search type
	var SearchType = req.param("SearchType");

	//save search type to forwarding view
	res.locals.SearchType = SearchType;
	
	if(SearchType == 'Drug'){
	    /* we assume by now that we have a valid rxnorm concept and so don't need to check against rxnorm concepts
            var request = require("request");
	    var parseString = require("xml2js").parseString;
	    request("https://rxnav.nlm.nih.gov/REST/drugs?name=" + term,function(error,response,body){
		if( !error && response.statusCode == 200){
		    parseString(body,function(err,result){
			var drugs = {};
			for(var i in result.rxnormdata){
			    for(var j in result.rxnormdata[i]){
				if(typeof result.rxnormdata[i][j].conceptGroup !== 'undefined'){
				    for (var h in result.rxnormdata[i][j].conceptGroup){
					if(typeof result.rxnormdata[i][j].conceptGroup[h].conceptProperties != 'undefined'){
					    for(var k in result.rxnormdata[i][j].conceptGroup[h].conceptProperties){
						console.log(result.rxnormdata[i][j].conceptGroup[h].conceptProperties[k].name);
					    }
					}
				    }
				}
			    }
			}
		    });
		}
	    });
	    */
	    var request = require("request");

	    request("http://api.ohdsi.org/WebAPI/CS1/vocabulary/search/" + term, function(error,response,body){
		var returns = {};
		if(!error && response.statusCode == 200){
		    var result = JSON.parse(body);
		    for(var i in result){
			var concept_id = result[i].CONCEPT_ID;
			var concept_name = result[i].CONCEPT_NAME;
			
			console.log("concept_id" + concept_id);
			console.log("concept_name" + concept_name);
			var request2 = require("request");
			request2("http://api.ohdsi.org/WebAPI/CS1/evidence/" + concept_id, function(error2, response2, body2){
			    if(!error2 && response2.statusCode == 200){
				returns[concept_name] = body2;
			    }
			});
		    }
		}
		res.locals.results = returns;
		console.log("results: %j",returns);
	    });
	    res.view("search.ejs");
	}else{

	}
    }
};

