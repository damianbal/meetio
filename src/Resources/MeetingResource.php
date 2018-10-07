<?php

namespace damianbal\Resources;

use damianbal\Core\Resource;

class MeetingResource extends Resource
{
    public function toArray($res)
    {
        $attendeeResource = new AttendeeResource;

        return [
            'title' => $res->getTitle(),
            'location' => $res->getLocation(),
            'id' => $res->getId(),
            'description' => $res->getDescription(),
            'attendees' => $attendeeResource->collection($res->getAttendees()),
        ];
    }
}
