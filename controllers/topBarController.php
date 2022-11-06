<?php

include ('models/database.php');
include ('models/details.php');

if (isset($_SESSION['userId']))
{
    $details = new Details($_SESSION);

    $empDetails = $details->getEmployeeDetails();

    // Employee Details
    $firstName = $empDetails[0]['firstName'];
    $middleName = $empDetails[0]['middleName'];
    $lastName = $empDetails[0]['lastName'];
    $gender = $empDetails[0]['gender'];
    $emailAddress = $empDetails[0]['emailAddress'];
    $phoneNumber = $empDetails[0]['phoneNumber'];
    $positionName = $details->positionName($empDetails[0]['positionId']);
    $hiredDate = date('F d, Y', strtotime($empDetails[0]['hiredDate']));
    $location = $empDetails[0]['location'];

    // Access Fields
    $type = $details->access();
    $typeName = $type[0]['type'];
    $accessType = ($type[0]['accessType'] == 0) ? "All" : "User";
}