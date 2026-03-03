<?php
namespace App\Interfaces;

interface AIRequest
{
    public function endpoint();
    public function toArray();
}
