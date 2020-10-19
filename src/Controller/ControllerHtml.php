<?php


namespace Wallet\Controller;


abstract class ControllerHtml
{
    public function renderiza(string $pasthTemplate, array $dados): string
    {
        extract($dados);
        ob_start();
        require __DIR__ . '/../Views/' . $pasthTemplate;
        $html = ob_get_clean();

        return $html;
    }
}