<?php

declare(strict_types=1);

namespace Slepic\Templating\Template;

/**
 * Represents a template for rendering certain data.
 */
interface TemplateInterface
{
    /**
     * Renders the template with given data.
     *
     * @param array<string,mixed> $data
     * @return string
     */
    public function render(array $data): string;
}
