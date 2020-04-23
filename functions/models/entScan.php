<?php

class EntScan
{
    private $show_scanID;
    private $show_scanName;
    private $show_scanStatus;
    private $show_ScanIntroductionText;
    private $show_ScanReminderText;
    private $show_ScanStartDate;
    private $show_ScanEndDate;

    public function __construct(string $show_scanID, string $show_scanName, string $show_scanStatus, string $show_ScanIntroductionText, string $show_ScanReminderText, $show_ScanStartDate, $show_ScanEndDate)
    {
        $this->show_scanID = $show_scanID;
        $this->show_scanName = $show_scanName;
        $this->show_scanStatus = $show_scanStatus;
        $this->show_ScanIntroductionText = $show_ScanIntroductionText;
        $this->show_ScanReminderText = $show_ScanReminderText;
        $this->show_ScanStartDate = $show_ScanStartDate;
        $this->show_ScanEndDate = $show_ScanEndDate;
    }

    public function getScanID() : string
    {
        return $this->show_scanID;
    }

    public function getScanName() : string
    {
        return $this->show_scanName;
    }
 
    public function getScanStatus() : string
    {
        return $this->show_scanStatus;
    }

    public function getScanIntroductionText() : string
    {
        return $this->show_ScanIntroductionText;
    }

    public function getScanReminderText() : string
    {
        return $this->show_ScanReminderText;
    }

    public function getScanStartDate()
    {
        return $this->show_ScanStartDate;
    }

    public function getScanEndDate()
    {
        return $this->show_ScanEndDate;
    }
} 

?>