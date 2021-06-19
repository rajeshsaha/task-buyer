<?php
class Pages extends Controller
{
	public function index() {
		$data = [ 'cookie_name' => 'buyer' ];
		$this->view('pages/index', $data);
	}
}