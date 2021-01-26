<?php

declare(strict_types=1);

namespace App\view;

use App\exception\AppException;
use Exception;

class View
{
    public function __construct()
    {
    }
    private function renderHTML(string $name, string $path = '', $params = null): void
    {
        $path = DIR_TEMPLATE . $path . $name . '.php';
        try {
            if (is_file($path)) {
                require $path;
            } else {
                throw new AppException('Błąd otwarcia szablonu' . $name . ' in: ' . $path);
            }
        } catch (Exception $e) {
            throw new AppException('Błąd Renderowania Strony');
        }
    }
    public function layout($params): void
    {
        header('Content-type: text/html; charset=utf-8');
        $this->renderHTML('layout', '', $params);
    }
    public function home(): void
    {
        $this->renderHTML('home', 'page/');
    }
    public function footer(): void
    {
        $this->renderHTML('footer', 'page/');
    }
}
