<?php

namespace Slepic\Tests\Templating\Template;

use PHPUnit\Framework\TestCase;
use Slepic\Templating\Template\OutputBufferTemplate;
use Slepic\Templating\Template\TemplateInterface;

class OutputBufferTemplateTest extends TestCase
{
    /**
     * Tests that the OutputBufferTemplate implements TemplateInterface.
     *
     * @return void
     */
    public function testImplements(): void
    {
        $template = new OutputBufferTemplate(__DIR__ . '/test_ok.phtml');
        $this->assertInstanceOf(TemplateInterface::class, $template);
    }

    /**
     * Tests that test_ok.phtml template is rendered properly.
     *
     * @param array $data
     * @return void
     * @dataProvider provideRenderData
     */
    public function testRender(array $data): void
    {
        $template = new OutputBufferTemplate(__DIR__ . '/test_ok.phtml');
        $output = $template->render($data);

        $expectedLocalVars = \array_merge(['data' => $data], $data);

        $this->assertSame(\print_r($expectedLocalVars, true), $output);
    }

    public function provideRenderData(): array
    {
        return [
            [[]],
            [['test' => \md5(\time())]],
            [['data' => \md5(\time())]],
        ];
    }

    /**
     * @param array $data
     *
     * @dataProvider provideRenderInvalidSymbolsData
     */
    public function testRenderInvalidSymbols(array $data): void
    {
        $template = new OutputBufferTemplate(__DIR__ . '/test_ok.phtml');

        $this->expectException(\Throwable::class);

        $template->render($data);
    }

    public function provideRenderInvalidSymbolsData(): array
    {
        return [
            [['a', 'b']],
            [['a' => 'b', 2 => 'c']],
            [['1badvarname' => 'value']],
        ];
    }
}
