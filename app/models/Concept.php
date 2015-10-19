<?php

class Concept extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $concept_id;

    /**
     *
     * @var string
     */
    public $concept_name;

    /**
     *
     * @var string
     */
    public $domain_id;

    /**
     *
     * @var string
     */
    public $vocabulary_id;

    /**
     *
     * @var string
     */
    public $concept_class_id;

    /**
     *
     * @var string
     */
    public $standard_concept;

    /**
     *
     * @var string
     */
    public $concept_code;

    /**
     *
     * @var string
     */
    public $valid_start_date;

    /**
     *
     * @var string
     */
    public $valid_end_date;

    /**
     *
     * @var string
     */
    public $invalid_reason;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("public");
        $this->hasMany('concept_id', 'CareSite', 'place_of_service_concept_id', array('alias' => 'CareSite'));
        $this->hasMany('concept_id', 'CohortAttribute', 'value_as_concept_id', array('alias' => 'CohortAttribute'));
        $this->hasMany('concept_id', 'CohortDefinition', 'definition_type_concept_id', array('alias' => 'CohortDefinition'));
        $this->hasMany('concept_id', 'ConceptClass', 'concept_class_concept_id', array('alias' => 'ConceptClass'));
        $this->hasMany('concept_id', 'ConditionEra', 'condition_concept_id', array('alias' => 'ConditionEra'));
        $this->hasMany('concept_id', 'ConditionOccurrence', 'condition_concept_id', array('alias' => 'ConditionOccurrence'));
        $this->hasMany('concept_id', 'ConditionOccurrence', 'condition_type_concept_id', array('alias' => 'ConditionOccurrence'));
        $this->hasMany('concept_id', 'ConditionOccurrence', 'condition_source_concept_id', array('alias' => 'ConditionOccurrence'));
        $this->hasMany('concept_id', 'Death', 'death_type_concept_id', array('alias' => 'Death'));
        $this->hasMany('concept_id', 'Death', 'cause_concept_id', array('alias' => 'Death'));
        $this->hasMany('concept_id', 'Death', 'cause_source_concept_id', array('alias' => 'Death'));
        $this->hasMany('concept_id', 'DeviceCost', 'currency_concept_id', array('alias' => 'DeviceCost'));
        $this->hasMany('concept_id', 'DeviceExposure', 'device_concept_id', array('alias' => 'DeviceExposure'));
        $this->hasMany('concept_id', 'DeviceExposure', 'device_type_concept_id', array('alias' => 'DeviceExposure'));
        $this->hasMany('concept_id', 'DeviceExposure', 'device_source_concept_id', array('alias' => 'DeviceExposure'));
        $this->hasMany('concept_id', 'Domain', 'domain_concept_id', array('alias' => 'Domain'));
        $this->hasMany('concept_id', 'DoseEra', 'drug_concept_id', array('alias' => 'DoseEra'));
        $this->hasMany('concept_id', 'DoseEra', 'unit_concept_id', array('alias' => 'DoseEra'));
        $this->hasMany('concept_id', 'DrugCost', 'currency_concept_id', array('alias' => 'DrugCost'));
        $this->hasMany('concept_id', 'DrugEra', 'drug_concept_id', array('alias' => 'DrugEra'));
        $this->hasMany('concept_id', 'DrugExposure', 'drug_concept_id', array('alias' => 'DrugExposure'));
        $this->hasMany('concept_id', 'DrugExposure', 'drug_type_concept_id', array('alias' => 'DrugExposure'));
        $this->hasMany('concept_id', 'DrugExposure', 'route_concept_id', array('alias' => 'DrugExposure'));
        $this->hasMany('concept_id', 'DrugExposure', 'dose_unit_concept_id', array('alias' => 'DrugExposure'));
        $this->hasMany('concept_id', 'DrugExposure', 'drug_source_concept_id', array('alias' => 'DrugExposure'));
        $this->hasMany('concept_id', 'DrugStrength', 'drug_concept_id', array('alias' => 'DrugStrength'));
        $this->hasMany('concept_id', 'DrugStrength', 'ingredient_concept_id', array('alias' => 'DrugStrength'));
        $this->hasMany('concept_id', 'DrugStrength', 'amount_unit_concept_id', array('alias' => 'DrugStrength'));
        $this->hasMany('concept_id', 'DrugStrength', 'numerator_unit_concept_id', array('alias' => 'DrugStrength'));
        $this->hasMany('concept_id', 'DrugStrength', 'denominator_unit_concept_id', array('alias' => 'DrugStrength'));
        $this->hasMany('concept_id', 'FactRelationship', 'domain_concept_id_1', array('alias' => 'FactRelationship'));
        $this->hasMany('concept_id', 'FactRelationship', 'domain_concept_id_2', array('alias' => 'FactRelationship'));
        $this->hasMany('concept_id', 'FactRelationship', 'relationship_concept_id', array('alias' => 'FactRelationship'));
        $this->hasMany('concept_id', 'Measurement', 'measurement_concept_id', array('alias' => 'Measurement'));
        $this->hasMany('concept_id', 'Measurement', 'measurement_type_concept_id', array('alias' => 'Measurement'));
        $this->hasMany('concept_id', 'Measurement', 'operator_concept_id', array('alias' => 'Measurement'));
        $this->hasMany('concept_id', 'Measurement', 'value_as_concept_id', array('alias' => 'Measurement'));
        $this->hasMany('concept_id', 'Measurement', 'unit_concept_id', array('alias' => 'Measurement'));
        $this->hasMany('concept_id', 'Measurement', 'measurement_source_concept_id', array('alias' => 'Measurement'));
        $this->hasMany('concept_id', 'Note', 'note_type_concept_id', array('alias' => 'Note'));
        $this->hasMany('concept_id', 'Observation', 'observation_concept_id', array('alias' => 'Observation'));
        $this->hasMany('concept_id', 'Observation', 'observation_type_concept_id', array('alias' => 'Observation'));
        $this->hasMany('concept_id', 'Observation', 'value_as_concept_id', array('alias' => 'Observation'));
        $this->hasMany('concept_id', 'Observation', 'qualifier_concept_id', array('alias' => 'Observation'));
        $this->hasMany('concept_id', 'Observation', 'unit_concept_id', array('alias' => 'Observation'));
        $this->hasMany('concept_id', 'Observation', 'observation_source_concept_id', array('alias' => 'Observation'));
        $this->hasMany('concept_id', 'ObservationPeriod', 'period_type_concept_id', array('alias' => 'ObservationPeriod'));
        $this->hasMany('concept_id', 'Person', 'gender_concept_id', array('alias' => 'Person'));
        $this->hasMany('concept_id', 'Person', 'race_concept_id', array('alias' => 'Person'));
        $this->hasMany('concept_id', 'Person', 'ethnicity_concept_id', array('alias' => 'Person'));
        $this->hasMany('concept_id', 'Person', 'gender_source_concept_id', array('alias' => 'Person'));
        $this->hasMany('concept_id', 'Person', 'race_source_concept_id', array('alias' => 'Person'));
        $this->hasMany('concept_id', 'Person', 'ethnicity_source_concept_id', array('alias' => 'Person'));
        $this->hasMany('concept_id', 'ProcedureCost', 'currency_concept_id', array('alias' => 'ProcedureCost'));
        $this->hasMany('concept_id', 'ProcedureCost', 'revenue_code_concept_id', array('alias' => 'ProcedureCost'));
        $this->hasMany('concept_id', 'ProcedureOccurrence', 'procedure_concept_id', array('alias' => 'ProcedureOccurrence'));
        $this->hasMany('concept_id', 'ProcedureOccurrence', 'procedure_type_concept_id', array('alias' => 'ProcedureOccurrence'));
        $this->hasMany('concept_id', 'ProcedureOccurrence', 'modifier_concept_id', array('alias' => 'ProcedureOccurrence'));
        $this->hasMany('concept_id', 'ProcedureOccurrence', 'procedure_source_concept_id', array('alias' => 'ProcedureOccurrence'));
        $this->hasMany('concept_id', 'Provider', 'specialty_concept_id', array('alias' => 'Provider'));
        $this->hasMany('concept_id', 'Provider', 'gender_concept_id', array('alias' => 'Provider'));
        $this->hasMany('concept_id', 'Provider', 'specialty_source_concept_id', array('alias' => 'Provider'));
        $this->hasMany('concept_id', 'Provider', 'gender_source_concept_id', array('alias' => 'Provider'));
        $this->hasMany('concept_id', 'Relationship', 'relationship_concept_id', array('alias' => 'Relationship'));
        $this->hasMany('concept_id', 'SourceToConceptMap', 'target_concept_id', array('alias' => 'SourceToConceptMap'));
        $this->hasMany('concept_id', 'Specimen', 'specimen_concept_id', array('alias' => 'Specimen'));
        $this->hasMany('concept_id', 'Specimen', 'specimen_type_concept_id', array('alias' => 'Specimen'));
        $this->hasMany('concept_id', 'Specimen', 'unit_concept_id', array('alias' => 'Specimen'));
        $this->hasMany('concept_id', 'Specimen', 'anatomic_site_concept_id', array('alias' => 'Specimen'));
        $this->hasMany('concept_id', 'Specimen', 'disease_status_concept_id', array('alias' => 'Specimen'));
        $this->hasMany('concept_id', 'VisitCost', 'currency_concept_id', array('alias' => 'VisitCost'));
        $this->hasMany('concept_id', 'VisitOccurrence', 'visit_concept_id', array('alias' => 'VisitOccurrence'));
        $this->hasMany('concept_id', 'VisitOccurrence', 'visit_type_concept_id', array('alias' => 'VisitOccurrence'));
        $this->hasMany('concept_id', 'VisitOccurrence', 'visit_source_concept_id', array('alias' => 'VisitOccurrence'));
        $this->hasMany('concept_id', 'Vocabulary', 'vocabulary_concept_id', array('alias' => 'Vocabulary'));
        $this->belongsTo('vocabulary_id', 'Vocabulary', 'vocabulary_id', array('alias' => 'Vocabulary'));
        $this->belongsTo('domain_id', 'Domain', 'domain_id', array('alias' => 'Domain'));
        $this->belongsTo('concept_class_id', 'ConceptClass', 'concept_class_id', array('alias' => 'ConceptClass'));
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'concept';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Concept[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Concept
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
