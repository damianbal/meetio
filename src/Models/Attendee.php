<?php

namespace damianbal\Models;

/**
 * @Entity @Table(name="meeting_attendees")
 **/
class Attendee
{
    /** @Id @Column(type="integer") @GeneratedValue */
    protected $id;

    /** @Column(type="string") */
    protected $name;

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setMeeting(Meeting $meeting)
    {
        $this->meeting = $meeting;
    }

    /**
     * @ManyToOne(targetEntity="damianbal\Models\Meeting", inversedBy="attendees")
     */
    protected $meeting;
}
