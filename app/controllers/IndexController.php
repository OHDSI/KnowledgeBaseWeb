<?php

use \Concept;
use \ConceptLookup;
use \DrugHoiRelationship;
use \Phalcon\Mvc\Model\Query;

class IndexController extends ControllerBase
{

  public function eventsuggestionAction($filtercondition)
    {
      $this->view->disable();

      $query = $this->modelsManager->createQuery("select distinct concept_id,concept_name from Concept a inner join DrugHoiRelationship on hoi = concept_id where upper(concept_name) like :filter: and ".
						 "concept_class_id = 'Clinical Finding' order by concept_name");
      $results = $query->execute(
				 array('filter'=>strtoupper($filtercondition).'%')
				 );
      $results = $results->toArray();
      if(count($results) == 0){
	$empty_arr = array(0=>array('concept_id'=>0,'concept_name'=>'No Matching Results'));
	echo(json_encode($empty_arr));
      }else{
	echo(json_encode($results));
	}
    }


  public function productsuggestionAction($filtercondition)
  {	

    $this->view->disable();

    $query = $this->modelsManager->createQuery("select distinct concept_id,concept_name from Concept a inner join DrugHoiRelationship on drug = concept_id where upper(concept_name) like :filter: and ".
					       "concept_class_id = 'Clinical Drug' order by concept_name");
    $results = $query->execute(
			       array('filter'=>strtoupper($filtercondition).'%')
			       );
    $results = $results->toArray();
      if(count($results) == 0){
	$empty_arr = array(0=>array('concept_id'=>0,'concept_name'=>'No Matching Results'));
	echo(json_encode($empty_arr));
      }else{
	echo(json_encode($results));
      }

  }

  public function ingredientsuggestionAction($filtercondition)
  {
    $this->view->disable();
    
    $query = $this->modelsManager->createQuery("select distinct concept_id,concept_name from Concept a inner join DrugHoiRelationship on drug = concept_id where upper(concept_name) like :filter: and ".
					       "concept_class_id = 'Ingredient' order by concept_name");
    $results = $query->execute(
			       array('filter'=>strtoupper($filtercondition).'%')
			       );
    
    $results = $results->toArray();
      if(count($results) == 0){
	$empty_arr = array(0=>array('concept_id'=>0,'concept_name'=>'No Matching Results'));
	echo(json_encode($empty_arr));
      }else{
	echo(json_encode($results));
      }

  }

  public function indexAction()
  {

    $evidence_type = array(
			   'SPL_EU_SPC'=>'Splicer EU',
			   'SPL_SPLICER_ADR'=>'Splicer',
			   'MEDLINE_MeSH_ClinTrial'=>'MeSH CT',
			   'MEDLINE_MeSH_CR'=>'MeSH CR',
			   'MEDLINE_MeSH_Other'=>'MeSH Oth',
			   'CTD_ChemicalDisease'=>'CTD',
			   'aers_report_count'=>'FAERS Count',
			   'aers_report_prr'=>'FAERS PRR',
			   'MEDLINE_SemMedDB_CR'=>'SemMed CR',
			   'MEDLINE_SemMedDB_ClinTrial'=>'SemMed CT',
                            'MEDLINE_SemMedDB_Other'=>'SemMed Oth'
			   );

    $this->view->ispost = false;

    $this->view->resultTypes = $evidence_type;

    //$this->view->lookup = $lookup;
    
    if($this->request->isPost()){

      $this->view->ispost = true;

      $concept_id = $this->request->getPost("query","string");
      $searchtype = $this->request->getPost("SearchType","string");
      
      //echo("concept_id:".$concept_id);
      //echo("searchtype:".$searchtype);
      //echo("ben:".is_numeric($concept_id));

      if(!is_numeric($concept_id)){
	if($searchtype == 'Ingredient'){
	  $query = $this->modelsManager->createQuery("select distinct concept_id,concept_name from Concept a inner join DrugHoiRelationship on drug = concept_id where upper(concept_name) = :filter: and ".
						     "concept_class_id = 'Ingredient' order by concept_name");

	}else if ($searchtype == 'Clinical Drug'){
	  $query = $this->modelsManager->createQuery("select distinct concept_id,concept_name from Concept a inner join DrugHoiRelationship on drug = concept_id where upper(concept_name) = :filter: and ".
						     "concept_class_id = 'Clinical Drug' order by concept_name");
	}else if ($searchtype == 'Health Outcome'){
	  $query = $this->modelsManager->createQuery("select distinct concept_id,concept_name from Concept a inner join DrugHoiRelationship on hoi = concept_id where upper(concept_name) = :filter: and ".
						     "concept_class_id = 'Clinical Finding' order by concept_name");
	}
	$results = $query->execute(
				   array('filter'=>strtoupper($concept_id))
				   );
	$results_arr = $results->toArray();
	//print_r($results_arr);
	$concept_id = $results_arr[0]['concept_id'];
      }

      $myconcept = Concept::findFirstByConceptId($concept_id);
      
      $this->view->myconcept = $myconcept;
      $this->view->SearchType = $searchtype;
      
      
      if($searchtype == 'Ingredient' || $searchtype == 'Clinical Drug'){
	$json = file_get_contents("http://api.ohdsi.org/WebAPI/CS1/evidence/drug/".$concept_id);
      }else if($searchtype == 'Health Outcome'){
	$json = file_get_contents("http://api.ohdsi.org/WebAPI/CS1/evidence/hoi/".$concept_id);
      }
      $obj = json_decode($json);

      $return_obj = array();
      $i=0;
      foreach($obj as $id=>$item){
	if(!array_key_exists($item->EVIDENCE,$return_obj)){	
	  $return_obj[$item->EVIDENCE] = array();
	}
	$child_arr = $return_obj[$item->EVIDENCE];
	if(isset($item->COUNT)){
	  $count = $item->COUNT;
	}else{
	  $count = $item->VALUE;
	}
	if(isset($item->HOI)){
	  $str = 'HOI-NAME';
	  $result_code = $item->HOI;
	  $result_name = $item->$str;

	}else{
	  $str = 'DRUG-NAME';
	  $result_code = $item->DRUG;
	  $result_name = $item->$str;

	}

	$child_arr[] = array('EVIDENCE'=>$item->EVIDENCE,'RESULT_CODE'=>$result_code,'LINKOUT'=>$item->LINKOUT,'STATISTIC_TYPE'=>$item->STATISTIC_TYPE,'COUNT'=>$count,'RESULT_NAME'=>$result_name);

	$return_obj[$item->EVIDENCE] = $child_arr;
      }
      asort($return_obj);
      
      $return_obj_sorted = array();
      
      foreach($return_obj as $list){
	//print_r($list);
	usort($list, function($a,$b){
	    //return $a['COUNT'] > $b['COUNT'] ? -1: 1;
	    return $b['COUNT'] > $a['COUNT'];
	});
	//print_r($list);
	$return_obj_sorted[] = $list;
      }
      
      //$this->view->results = $obj;
      $this->view->results = $return_obj_sorted;
    }
  }
  
}

