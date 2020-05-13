<?php
require_once '../functions/controller/ScanController.php';
$ScanFunc = new ScanController();


if(isset($_POST['scanName']) && isset($_POST['scanType']) && isset($_POST['scanComment']) && isset($_POST['scanIntroduction'])){
    $Name = $_POST['scanName'];
    $Type = $_POST['scanType'];
    $Comment = $_POST['scanComment'];
    $Introduction = $_POST['scanIntroduction'];


    $Status = "Active";
    $ReminderText = "remindertext test gr marvin";
    $startDate = "2020-05-13";
    $endDate = "2020-08-28";
    $ScanFunc->addScan($Name, $Comment, $Status, $Introduction, $ReminderText, $startDate, $endDate, $Type);

}