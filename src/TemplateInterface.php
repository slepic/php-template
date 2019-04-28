<?php

namespace Slepic\Templating\Template;

/**
 * Interface TemplateInterface
 * @package Slepic\Templating
 *
 * Represents a template for rendering certain data.
 */
interface TemplateInterface
{
    /**
     * Renders the template with given data.
     *
     * @param mixed $data
     * @return string
     */
    public function render($data);
}
