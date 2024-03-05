<?php

class Router
{
    public function handleRequest(array $get): void
    {
        $hc = new HomeController();

        if (!isset($get["route"]))
        {
            $hc->home();
        }
    }
}