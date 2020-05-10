<?php

declare(strict_types=1);

namespace Slepic\Templating\Template;

/**
 * An implementation of TemplateInterface using native PHP output buffering and a plain PHP script with echo calls.
 */
class OutputBufferTemplate implements TemplateInterface
{
    private string $templateFile;

    public function __construct(string $templateFile)
    {
        $this->templateFile = $templateFile;
    }

    public function render(array $data): string
    {
        if (\count($data) !== \extract($data)) {
            throw new \InvalidArgumentException(
                'Expected associative array where keys are valid variable names.'
            );
        }
        \ob_start();
        require($this->templateFile);
        return \ob_get_clean();
    }
}
