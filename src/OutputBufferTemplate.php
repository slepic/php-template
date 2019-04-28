<?php

namespace Slepic\Templating\Template;

/**
 * Class OutputBufferTemplate
 * @package Slepic\Templating
 *
 * An implementation of TemplateInterface using native PHP output buffering and a plain PHP script with echo calls.
 */
class OutputBufferTemplate implements TemplateInterface
{
    /**
     * @var string
     */
    private $templateFile;

    /**
     * OutputBufferTemplate constructor.
     * @param string $templateFile
     */
    public function __construct($templateFile)
    {
        if (!\is_string($templateFile)) {
            throw new \InvalidArgumentException('Template file must be a string.');
        }
        $this->templateFile = $templateFile;
    }

    /**
     * @param mixed $data
     * @return string
     */
    public function render($data)
    {
        \extract((array) $data);
        \ob_start();
        require($this->templateFile);
        return \ob_get_clean();
    }
}
