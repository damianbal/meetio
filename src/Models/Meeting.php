<?php

namespace damianbal\Models;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @Entity(repositoryClass="damianbal\Repositories\MeetingRepository") @Table(name="meetings")
 **/
class Meeting
{
    public function __construct()
    {
        $this->attendees = new ArrayCollection();
    }

    /** @Id @Column(type="integer") @GeneratedValue */
    protected $id;

    /** @Column(type="string") */
    protected $title;

    /** @Column(type="string") */
    protected $description;

    /** @Column(type="string") */
    protected $location;

    /** @Column(type="date") */
    protected $date;

    /**
     * @OneToMany(targetEntity="damianbal\Models\Attendee", mappedBy="meeting")
     */
    protected $attendees;

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function setLocation($location)
    {
        $this->location = $location;
    }

    public function setDate($date)
    {
        $this->date = clone $date;
    }

    public function getLocation()
    {
        return $this->location;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function getAttendees(): Collection
    {
        return $this->attendees;
    }

    public function getId()
    {
        return $this->id;
    }

    public function addAttendee(Attendee $attendee)
    {
        $this->attendees[] = $attendee;
    }

    public function toJson()
    {
        return [
            'title' => $this->title,
            'location' => $this->location,
            'id' => $this->id,
            'description' => $this->description,
        ];
    }
}
