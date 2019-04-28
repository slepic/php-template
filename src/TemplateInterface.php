<?php

namespace Slepic\Templating;

/**
 * Interface TemplateInterface
 * @package Slepic\Templating
 *
 * Represents a template for rendering certain data.
 */
interface TemplateInterface
{
    /**
     * @param mixed $data
     * @return string
     * @throws \Exception if the $data does not satisfy requirements of the concrete template implementation.
     */
    public function render($data);
}
