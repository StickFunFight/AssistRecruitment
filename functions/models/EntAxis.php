<?php


class EntAxis
{
    public $AxisId;
    public $AxisName;
    public $AxisStatus;

    /**
     * EntAxis constructor.
     * @param $AxisId
     * @param $AxisName
     * @param $AxisStatus
     */
    public function __construct($AxisId, $AxisName, $AxisStatus)
    {
        $this->AxisId = $AxisId;
        $this->AxisName = $AxisName;
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
    public function getAxisName()
    {
        return $this->AxisName;
    }

    /**
     * @param mixed $AxisName
     */
    public function setAxisName($AxisName)
    {
        $this->AxisName = $AxisName;
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