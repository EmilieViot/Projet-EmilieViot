<?php

class PageController extends AbstractController
{
    public function legal(): void
    {
        $this->render("legal.html.twig", []);
    }

