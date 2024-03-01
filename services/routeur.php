<?php

class Router
{
public function handleRequest(array $get) : void
{
$dc = new homeController();


if(!isset($get["route"]))
{
$dc->home();
}