<?php


namespace Farm\Models;

//aggregate
use Farm\Enum\ObjectStatusEnum;

class ObjectModel
{

    protected int $id;

    protected string $name;

    protected int $status;

    protected Geoposition $geoposition;

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function setStatus(int $status)
    {
        if (array_key_exists($status, ObjectStatusEnum::getNames())) {
            $this->status = $status;
        }
        //TODO: maybe throw exception?
    }

    public function getGeoposition(): Geoposition
    {
        return $this->geoposition;
    }

    public function setGeoposition(Geoposition $geoposition)
    {
        $this->geoposition = $geoposition;
    }

}