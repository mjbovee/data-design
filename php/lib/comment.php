<?php

namespace Michaelbovee\DataDesign;
require_once ("../Classes/autoload.php");

$date = new \DateTime('now');

$instance = new Comment("b02fe7f8-69df-4915-9448-166358834b83", "4475e376-1105-4daf-899c-2b05be714958", "6c5acd42-b90b-4a86-9c01-9a5a37577541", "here's a comment", $date);

var_dump($instance);