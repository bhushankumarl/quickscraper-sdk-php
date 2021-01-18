<?php

namespace QuickScraper\Main;

class QuickScraperClass
{
    public function sayHello(string $name): string
    {
        return sprintf("Hello %s!", ucfirst($name));
    }
}