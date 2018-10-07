<?php

namespace damianbal\Resources;

use damianbal\Core\Resource;

class AttendeeResource extends Resource
{
    public function toArray($res)
    {
        return [
            'name' => $res->getName(),
        ];
    }
}
