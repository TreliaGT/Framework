<?php
namespace GGCode\framework\Controllers;

use GGCode\framework\Http\Response; 
use GGCode\framework\Http\Request; 
use eftec\bladeone\BladeOne;

abstract class AbstractController{

    protected BladeOne $blade;
    protected ?Request $request = null;

    public function __construct() {
        // Set the paths for views and cache
        $views = BASE_PATH . '/views'; // Your views directory
        $cache = BASE_PATH . '/cache'; // Where compiled Blade templates will be cached

        // Create an instance of BladeOne
        $this->blade = new BladeOne($views, $cache, BladeOne::MODE_AUTO); // Use BladeOne::MODE_AUTO for auto mode
    }

    public function render(string $template, ?array $vars = []): Response {
        try {
            // Render the Blade template with the passed variables
            $content = $this->blade->run($template, $vars);
        } catch (\Exception $e) {
            // Handle exceptions (e.g., missing templates)
            return new Response("Error rendering template: " . $e->getMessage(), 500);
        }

        return new Response($content);
    }

    public function setRequest(Request $request) : void{
        $this->request = $request;
    }   
}