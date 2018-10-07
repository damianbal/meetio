<?php

namespace damianbal\Core;

class Resource
{
    public function toArray($res)
    {
        return [
           // 'name' => $res->name 
        ];
    }

    public function one($resource)
    {
        return $this->toArray($resource);
    }

    public function collection($resources)
    {
        $data = [];

        foreach($resources as $res) {
            $data[] = $this->one($res);
        }

        return $data;
    }
}
