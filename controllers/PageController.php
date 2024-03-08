<?php

class PageController extends AbstractController
{
    public function legal(): void
    {
        $this->render("legal.html.twig", []);
    }

    public function admin(): void
    {
        $this->render("admin.html.twig", []);
    }
}