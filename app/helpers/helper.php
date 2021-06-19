<?php
// url redirect
function redirect($page) {
  header('Location: ' . URL_ROOT . '/' . $page);
}

// text check
function check_text($data) {
	return ctype_alpha($data) ? true : false;
}

// number check
function check_number($data) {
	return ctype_digit(strval($data)) ? true : false;
}

// sanitize input
function clean_input($data) {
	return htmlspecialchars(stripslashes(trim($data)));
}

// client's ip
function get_client_ip() {
	$ip = '';
	if(isset($_SERVER['HTTP_CLIENT_IP'])) {
		$ip = $_SERVER['HTTP_CLIENT_IP'];
	} else if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	} else if(isset($_SERVER['HTTP_X_FORWARDED'])) {
		$ip = $_SERVER['HTTP_X_FORWARDED'];
	} else if(isset($_SERVER['HTTP_FORWARDED_FOR'])) {
		$ip = $_SERVER['HTTP_FORWARDED_FOR'];
	} else if(isset($_SERVER['HTTP_FORWARDED'])) {
		$ip = $_SERVER['HTTP_FORWARDED'];
	} else if(isset($_SERVER['REMOTE_ADDR'])) {
		$ip = $_SERVER['REMOTE_ADDR'];
	} else {
		$ip = 'UNKNOWN';
	}

	return $ip;
}

