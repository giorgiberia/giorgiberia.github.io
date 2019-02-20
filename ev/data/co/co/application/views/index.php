<?php
error_reporting(E_ALL);
$this->load->view('include/header');
$this->load->view($content);
$this->load->view('include/sidebar');
$this->load->view('include/footer');
