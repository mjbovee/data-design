<?php
/**
 * Created by PhpStorm.
 * User: michael
 * Date: 10/18/18
 * Time: 3:53 PM
 */
namespace Michaelbovee\DataDesign;
require_once ("../Classes/autoload.php");

$instance = new Profile("82f90cb6-9bf2-4387-8449-7b6a4c80a9ef", "MikeB", "michael.j.bovee@gmail.com", "7TplU3FHKll7QFqClUbYhuChCYA5mnoj7BsPvXn36w0M1gcd0bZ5tpcWdAPpO3wJvMoOzzHuVw6NC7Ot8DmqTncUNR8pJuY27", "Mike Bovee", "http://www.google.com");

var_dump($instance);