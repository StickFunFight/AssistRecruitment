<?php


class EntAxis
{
    private $AxisId;
    private $Axisname;
    private $AxisStatus;

    /**
     * EntAxis constructor.
     * @param $AxisId
     * @param $Axisname
     * @param $AxisStatus
     */
    public function __construct($AxisId, $Axisname, $AxisStatus)
    {
        $this->AxisId = $AxisId;
        $this->Axisname = $Axisname;
        $this->AxisStatus = $AxisStatus;
    }

    /**
     * @return mixed
     */
    public function getAxisId()
    {
        return $this->AxisId;
    }

    /**
     * @param mixed $AxisId
     */
    public function setAxisId($AxisId)
    {
        $this->AxisId = $AxisId;
    }

    /**
     * @return mixed
     */
    public function getAxisname()
    {
        return $this->Axisname;
    }

    /**
     * @param mixed $Axisname
     */
    public function setAxisname($Axisname)
    {
        $this->Axisname = $Axisname;
    }

    /**
     * @return mixed
     */
    public function getAxisStatus()
    {
        return $this->AxisStatus;
    }

    /**
     * @param mixed $AxisStatus
     */
    public function setAxisStatus($AxisStatus)
    {
        $this->AxisStatus = $AxisStatus;
    }



}