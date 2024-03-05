<?php

namespace App\Controllers;

class Page extends BaseController
{
    public function about()
    {
        echo "about page";
    }
    public function contact()
    {
        echo "contact page";
    }
    public function faqs()
    {
        echo "faqs page";
    }
    public function tos()
    {
        echo "Halaman Term of Service";
    }
    public function biodata()
    {
        echo "NAMA  : Luluk Latifa Aulia <br/>";
        echo "TTL   : Jombang, 13 Juni 2004 <br/>";
        echo "Agama : Islam <br/>"; 
    }
}
