<?php

declare(strict_types=1);

namespace Slepic\Templating\Template;

/**
 * An implementation of TemplateInterface which wraps another implementation and keeps some default data
 * which it then supplies to the inner template upon rendering.
 *
 * Overriding default values is allowed.
 * A simple array_merge is used and so nested arrays are not merged recursively.
 * However, this may change in future.
 */
class DefaultDataTemplate implements TemplateInterface
{
    private TemplateInterface $template;
    private array $data;

    /**
     * @param TemplateInterface $template
     * @param array<string,mixed> $data
     */
    public function __construct(TemplateInterface $template, array $data)
    {
        $this->template = $template;
        $this->data = $data;
    }

    public function render(array $data): string
    {
        $allData = \array_merge($this->data, $data);
        return $this->template->render($allData);
    }
}
