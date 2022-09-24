<?php

namespace App;

class Embed
{
    public function __construct(string $title, string $description, int $color, string $url = null, array $fields = null)
    {
        $this->title = $title;
        $this->description = $description;
        $this->color = $color;
        $this->url = $url;
        $this->fields = $fields;
    }
}
