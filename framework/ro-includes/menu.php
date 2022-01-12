<?php 
$arr_menu = array();
//echo
$q = "select menu from user where uid='".getWorkerId()."'";
$arr_menu = $rodb->getCellFromDB($q);
if(!empty($arr_menu)){
	$arr_menu = @unserialize($arr_menu);
}
if(empty($arr_menu)){
	$arr_menu = array();
	// $arr_menu[] = array("id" => "new", "url" => "?page=top_menu&amp;top_menu=new", "text" => "New", "status" => "1", "sub_menu" => array(
	// 	array("id" => "sale_bill", "url" => "?page=sale_form", "text"=>" Sale", "status" => "1"),
	// 	array("id" => "purchase", "url" => "?page=new_purchase", "text"=>" Purchase", "status" => "1"),
	// 	array("id" => "gate_pass_in", "url" => "?page=new_purchase&gatepass=in", "text"=>"Gate Pass In", "status" => "0"),
	// 	array("id" => "gate_pass_out", "url" => "?page=new_gatepass_out", "text"=>"Gate Pass Out", "status" => "0"),
	// 	array("id" => "manage_account", "url" => "?page=manage_transactions", "text"=>" Payment", "status" => "1"),
	// 	array("id" => "expenditures", "url" => "?page=new_expenditure", "text"=>" Expenditures", "status" => "1"),
	// 	array("id" => "salary", "url" => "?page=new_salary", "text"=>" Salary", "status" => "1"),
	// 	array("id" => "sale_return", "url" => "?page=new_sale_return", "text"=>" Sale Return", "status" => "0"),
	// 	array("id" => "purchase_return", "url" => "?page=new_purchase_return", "text"=>" Purchase Return", "status" => "0"),
	// 	array("id" => "production_transfer_bill", "url" => "?page=new_production", "text"=>"Issue Items", "status" => "0"),
	// 	array("id" => "worker_payment", "url" => "?page=worker_payment", "text"=>" Worker Payment", "status" => "0"),
	// 	array("id" => "new_reminder", "url" => "?page=new_reminder", "text"=>" Reminder", "status" => "1")
	// ));
	// if(isSuperAdmin()){
	// $arr_menu[] = array("id" => "management", "url" => "?page=top_menu&amp;top_menu=management", "text" => "Manage", "status" => "1", "sub_menu" => array(
	// 	array("id" => "manage_customers", "url" => "?page=manage_customers", "text" => getPartyLabel(), "status" => "1"),
	// 	array("id" => "manage_products", "url" => "?page=manage_products", "text"=>getProductLabel(), "status" => "1"),
	// 	array("id" => "manage_stock", "url" => "?page=purchase_form", "text"=>"Stock", "status" => "1"),
	// 	array("id" => "products_manager", "url" => "?page=products_manager", "text"=>"Products", "status" => "1"),
	// 	array("id" => "manage_formula", "url" => "?page=set_formula", "text"=>"Formula", "status" => "1")
	// ));
	// }
	// $arr_menu[] = array("id" => "Reports", "url" => "?page=top_menu&amp;top_menu=reports", "text" => "Reports", "status" => "1", "sub_menu" => 
	// array(
	// 	array("id" => "ledgers", "url" => "?page=ledgers", "text"=>"Ledgers", "status" => "1")
	// 	, array("id" => "credit_report", "url" => "?page=debitandcredit_report", "text"=>" Credit Report", "status" => "1")
	// 	, array("id" => "debit_credit_report", "url" => "?page=debit_credit_report", "text"=>" Debit and Credit Report", "status" => "1")
	// 	, array("id" => "sale_report", "url" => "?page=sale_report", "text"=>" Sale Report", "status" => "1")
	// 	, array("id" => "sale_report_datewise", "url" => "?page=sale_report_datewise", "text"=>" Sale Report Datewise", "status" => "1")
	// 	, array("id" => "gatepass_out_report", "url" => "?page=gatepass_out_report", "text"=>"Gatepass Out Report", "status" => "1")
	// 	, array("id" => "stock_register_report", "url" => "?page=stock_register_date", "text"=>" Stock Register Report", "status" => "1")
	// 	, array("id" => "stock_report", "url" => "?page=stock_report", "text"=>" Stock Report", "status" => "1")
	// 	, array("id" => "stock_report_datewise", "url" => "?page=stock_report_datewise", "text"=>" Stock Report Datewise", "status" => "1")
	// 	, array("id" => "stock_and_price_report", "url" => "?page=stockandprice_report", "text"=>" Stock and Price Report", "status" => "1")
	// 	, array("id" => "production_report", "url" => "?page=production_report_datewise", "text"=>" Production report", "status" => "1")
	// 	, array("id" => "purchase_report", "url" => "?page=new_purchase&type=report", "text"=>" Purchase report", "status" => "1")
	// 	, array("id" => "purchase_analysis", "url" => "?page=new_purchase&type=report&analysis=yes", "text"=>" Purchase Analysis", "status" => "1")
	// 	, array("id" => "gatepass_in_report", "url" => "?page=new_purchase&type=report&gatepass=yes", "text"=>" Gatepass In Report", "status" => "1")
	// 	, array("id" => "expenditure_report", "url" => "?page=new_expenditure&type=report", "text"=>" Expenditure report", "status" => "1")
	// 	, array("id" => "cashinhand_report", "url" => "?page=cashinhand_report&type=report", "text"=>" Cash in Hand report", "status" => "1")
	// 	, array("id" => "salary_report", "url" => "?page=salary_report&type=report", "text"=>" Salary report", "status" => "1")
	// 	, array("id" => "cpl_report", "url" => "?page=customer_price_list&type=report", "text"=>" Customer Price List Chart", "status" => "1")
	// 	, array("id" => "credit_list", "url" => "?page=credit_list&type=report", "text"=>"Credit List", "status" => "1")
	// 	, array("id" => "credit_list", "url" => "?page=credit_list&type=report", "text"=>"Credit List", "status" => "1")
	// 	, array("id" => "pandl", "url" => "?page=pandl&type=report", "text"=>" Profit / Loss", "status" => "1")
	// 	, array("id" => "worker_report", "url" => "?page=worker_report", "text"=>" Worker Report", "status" => "1")
	// 	, array("id" => "barcodes", "url" => "?page=barcodes", "text"=>"Barcodes", "status" => "1")
	// 	, array("id" => "item_price_list", "url" => "?page=item_price_list", "text"=>"Item Price List", "status" => "1")
	// 	// , array("id" => "allitems_stock", "url" => "?page=allitems_stock", "text"=>"All Items Stock Update", "status" => "1")
	// 	// , array("id" => "allledgers_balance", "url" => "?page=allledgers_balance", "text"=>"All Ledgers Balance", "status" => "1")
		
	// ));

	// $arr_menu[] = array("id" => "search", "url" => "?page=top_menu&amp;top_menu=search", "text"=>"Search", "status" => "1", "sub_menu" => array(

	// 	array("id" => "bill", "url" => "?page=find_bill", "text"=>" Bill", "status" => "1")

	// 	,array("id" => "purchase", "url" => "?page=find_purchase", "text"=>" Purchase", "status" => "1")

	// 	,array("id" => "production", "url" => "?page=find_production", "text"=>" Production", "status" => "1")

	// ));

	$arr_menu[] = array("id" => "my_account", "url" => "?page=top_menu&amp;top_menu=my_account", "text"=>"My Account", "status" => "1", "sub_menu" => array(
		array("id" => "profile", "url" => "?page=profile", "text"=>" Profile", "status" => "0"),
		array("id" => "change_password", "url" => "?page=changepassword", "text"=>" Change Password", "status" => "1"),
		array("id" => "logout", "url" => "?page=logout", "text"=>" Logout", "status" => "1")

	));
}