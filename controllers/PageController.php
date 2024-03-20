<?php

class PageController extends AbstractController
{
    public function legal(): void
    {
        $this->render("legal.html.twig", []);
    }

    public function error404(): void
    {
        $this->render("404.html.twig", []);
    }
}

