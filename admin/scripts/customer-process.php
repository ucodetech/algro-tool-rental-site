<?php
require_once '../../core/init.php';

$general = new General();
$show = new Show();
$customer = new Customer();



if (isset($_POST['action']) && $_POST['action'] == 'fetch_Custom') {

	$fetchCustomer = $customer->fetchCustomers();
	if ($fetchCustomer) {
		echo $fetchCustomer;
	}

}


if (isset($_POST['customer_id'])) {
	$customer_id = (int)$_POST['customer_id'];

	$get = $customer->getCustomerDetail($customer_id);
	if ($get) {
		echo $get;
	}
}
