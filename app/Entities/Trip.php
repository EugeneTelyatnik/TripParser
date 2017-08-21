<?php

namespace App\Entities;

use App\Collections\DepartureCollection;


/**
 * Class Trip
 *
 * @package App\Entities
 */
class Trip extends AbstractEntity
{

    /** @var string */
    protected $title;

    /** @var string */
    protected $code;

    /** @var integer */
    protected $duration;

    /** @var string */
    protected $inclusions;

    /** @var DepartureCollection */
    protected $departures;

    /**
     * Trip constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        if (count($data) > 0) {
            $this->validate(['title', 'code', 'duration', 'inclusions', 'departures'], $data);

            $this->setTitle($data['title']);
            $this->setCode($data['code']);
            $this->setDuration($data['duration']);
            $this->setInclusions($data['inclusions']);
            $this->setDepartures($data['departures']);
        }
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return (string) $this->title;
    }

    /**
     * @param string $title
     * @return Trip
     */
    public function setTitle(string $title): Trip
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return (string) $this->code;
    }

    /**
     * @param string $code
     * @return Trip
     */
    public function setCode(string $code): Trip
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @return int
     */
    public function getDuration(): int
    {
        return (int) $this->duration;
    }

    /**
     * @param int $duration
     * @return Trip
     */
    public function setDuration(int $duration): Trip
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * @return string
     */
    public function getInclusions(): string
    {
        return (string) $this->inclusions;
    }

    /**
     * @param string $inclusions
     * @return Trip
     */
    public function setInclusions(string $inclusions): Trip
    {
        $this->inclusions = $inclusions;

        return $this;
    }

    /**
     * @return DepartureCollection
     */
    public function getDepartures(): DepartureCollection
    {
        return $this->departures;
    }

    /**
     * @param DepartureCollection $departures
     * @return Trip
     */
    public function setDepartures(DepartureCollection $departures): Trip
    {
        $this->departures = $departures;

        return $this;
    }


}