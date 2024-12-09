<?php

class Plane
{
    private $id;
    private $code;
    private $model;
    private $totalSeats;

    function __construct($code, $model, $totalSeats, $id = null)
    {
        $this->id = $id;
        $this->code = $code;
        $this->model = $model;
        $this->totalSeats = $totalSeats;
    }

    public function getId()
    {
        return $this->id;
    }
    function getCode()
    {
        return $this->code;
    }

    function getModel()
    {
        return $this->model;
    }

    function getTotalSeats()
    {
        return $this->totalSeats;
    }
}
