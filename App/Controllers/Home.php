<?php declare(strict_types=1);

namespace App\Controllers;

use Core\View;
use Core\Controller;

class Home extends Controller
{
    public function indexAction()
    {
        View::render('Home/index.php');
    }
}
