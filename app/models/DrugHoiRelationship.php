<?php

use \Concept;

class DrugHoiRelationship extends \Phalcon\Mvc\Model
{


    /**
     *
     * @var string
     */
    public $id;

    /**
     *
     * @var integer
     */
    public $drug;

    /**
     *
     * @var string
     */
    public $rxnorm_drug;

    /**
     *
     * @var integer
     */
    public $hoi;

    /**
     *
     * @var string
     */
    public $snomed_hoi;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("public");
	$this->hasOne('drug','Concept','concept_id',array('alias'=>'Drug'));
	$this->hasOne('hoi','Concept','concept_id',array('alias'=>'HOI'));
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'drug_hoi_relationship';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return DrugHoiRelationship[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return DrugHoiRelationship
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
