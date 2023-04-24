<?php
//
// File generated by ... on the 2023-04-10T11:50:42+0200
// Please do not edit manually
//

/**
 * Classes and menus for itop-request-template (version 2.0.5)
 *
 * @author      iTop compiler
 * @license     http://opensource.org/licenses/AGPL-3.0
 */
define('REQUEST_TEMPLATE_QUERY', 'SELECT RequestTemplate WHERE servicesubcategory_id = :servicesubcategory_id AND service_id=:service_id');



class RequestTemplate extends Template
{
	public static function Init()
	{
		$aParams = array(			'category' => 'bizmodel,searchable,servicemgmt',
			'key_type' => 'autoincrement',
			'name_attcode' => array('name'),
			'image_attcode' => '',
			'state_attcode' => '',
			'reconc_keys' => array('name', 'servicesubcategory_id', 'service_id'),
			'db_table' => 'tpl_request',
			'db_key_field' => 'id',
			'db_finalclass_field' => '',
			'style' =>  new ormStyle(null, null, null, null, null, null),);
		MetaModel::Init_Params($aParams);
		MetaModel::Init_InheritAttributes();
		MetaModel::Init_AddAttribute(new AttributeExternalKey("service_id", array("targetclass"=>'Service', "allowed_values"=>null, "sql"=>'service_id', "is_null_allowed"=>false, "on_target_delete"=>DEL_AUTO, "depends_on"=>array(), "display_style"=>'select', "always_load_in_tables"=>false)));
		MetaModel::Init_AddAttribute(new AttributeExternalField("service_name", array("allowed_values"=>null, "extkey_attcode"=>'service_id', "target_attcode"=>'name', "always_load_in_tables"=>false)));
		MetaModel::Init_AddAttribute(new AttributeExternalKey("servicesubcategory_id", array("targetclass"=>'ServiceSubcategory', "allowed_values"=>new ValueSetObjects("SELECT ServiceSubcategory WHERE service_id =:this->service_id"), "sql"=>'servicesubcategory_id', "is_null_allowed"=>false, "on_target_delete"=>DEL_AUTO, "depends_on"=>array('service_id'), "display_style"=>'select', "always_load_in_tables"=>false)));
		MetaModel::Init_AddAttribute(new AttributeExternalField("servicesubcategory_name", array("allowed_values"=>null, "extkey_attcode"=>'servicesubcategory_id', "target_attcode"=>'name', "always_load_in_tables"=>false)));



		MetaModel::Init_SetZListItems('details', array (
  0 => 'name',
  1 => 'service_id',
  2 => 'servicesubcategory_id',
  3 => 'label',
  4 => 'description',
  5 => 'field_list',
));
		MetaModel::Init_SetZListItems('standard_search', array (
  0 => 'name',
  1 => 'service_id',
  2 => 'servicesubcategory_id',
  3 => 'label',
  4 => 'description',
));
		MetaModel::Init_SetZListItems('default_search', array (
  0 => 'name',
  1 => 'servicesubcategory_id',
));
		MetaModel::Init_SetZListItems('list', array (
  0 => 'service_id',
  1 => 'servicesubcategory_id',
  2 => 'label',
));
;
	}



public function GetTargetClass()
	{
        $iSubCategory = $this->Get('servicesubcategory_id');
        $oSubCategory = MetaModel::GetObject('ServiceSubcategory', $iSubCategory);
	    if (is_null($oSubCategory))
        {
            throw new Exception('Missing Service Subcategory');
        }
        $sRequestType =$oSubCategory->Get('request_type');
	    if ($sRequestType == 'incident')
        {
            if (class_exists('Incident'))
            {
                return 'Incident';
            }
        }
        if (class_exists('UserRequest'))
        {
            return 'UserRequest';
        }
        throw new Exception("The selected Service Subcategory is incompatible with your installation options (request type '$sRequestType' not supported)");
	}

}
//
// Menus
//
class MenuCreation_itop_request_template extends ModuleHandlerAPI
{
	public static function OnMenuCreation()
	{
		global $__comp_menus__; // ensure that the global variable is indeed global !
		$__comp_menus__['ServiceManagement'] = new MenuGroup('ServiceManagement', 60, 'fas fa-hands-helping' , null, UR_ACTION_MODIFY, UR_ALLOWED_YES, null);
		$__comp_menus__['RequestTemplate'] = new OQLMenuNode('RequestTemplate', "SELECT RequestTemplate", $__comp_menus__['ServiceManagement']->GetIndex(), 9, true , null, UR_ACTION_MODIFY, UR_ALLOWED_YES, null, true);
	}
} // class MenuCreation_itop_request_template