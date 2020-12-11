<?php

declare(strict_types=1);

namespace Slepic\Tests\Templating\Template;

use PHPUnit\Framework\TestCase;
use Slepic\Templating\Template\DefaultDataTemplate;
use Slepic\Templating\Template\TemplateInterface;

final class DefaultDataTemplateTest extends TestCase
{
    public function testImplements(): void
    {
        $innerTemplate = self::createMock(TemplateInterface::class);
        $template = new DefaultDataTemplate($innerTemplate, []);
        $this->assertInstanceOf(TemplateInterface::class, $template);
    }

    /**
     * @param array $defaultData
     * @param array $data
     * @param array $allData
     *
     * @dataProvider provideRenderData
     */
    public function testRender(array $defaultData, array $data, array $allData): void
    {
        $hash = \md5((string) \time());
        $innerTemplate = self::createMock(TemplateInterface::class);
        $innerTemplate->expects(self::once())
            ->method('render')
            ->with($allData)
            ->willReturn($hash);
        $template = new DefaultDataTemplate($innerTemplate, $defaultData);
        $output = $template->render($data);
        self::assertSame($hash, $output);
    }

    public function provideRenderData(): array
    {
        $hash = \md5((string) \time());
        return [
            [[], [], []],
            [
                ['default' => 'value'],
                ['test' => $hash],
                ['test' => $hash, 'default' => 'value']
            ],
            [
                ['override' => 'default'],
                ['keep' => $hash, 'override' => 'overridden'],
                ['keep' => $hash, 'override' => 'overridden']
            ],
        ];
    }
}
