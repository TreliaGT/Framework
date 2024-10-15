<?php 

namespace App\Controllers;

use GGCode\framework\Http\Response;
use GGCode\framework\Controllers\AbstractController;

class HomeController extends AbstractController {

    public function index(): Response {
        $data = [
            'title' => 'Hello world',
            'message' => 'This is the homepage'
        ];
        // Render the 'home.index' Blade template with data
        return $this->render('home', $data);
    }

}
