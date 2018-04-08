<?php
namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
class hellowordController
{
  public function homepage(){


    return new Response ('Hello World');
  }

}
