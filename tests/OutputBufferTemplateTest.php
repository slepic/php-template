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
    public function testImplements()
    {
        $template = new OutputBufferTemplate(__DIR__ . '/test_ok.phtml');
        $this->assertInstanceOf(TemplateInterface::class, $template);
    }


    /**
     * Tests that test_ok.phtml template is rendered properly.
     *
     * @param mixed $data
     * @return void
     * @dataProvider provideRenderData
     */
    public function testRender($data)
    {
        $template = new OutputBufferTemplate(__DIR__ . '/test_ok.phtml');
        $output = $template->render($data);

        //prepare expected context as it should be passed to the template through require directive.
        //the data variable contains the original data, but if the data contain 'data' key then it overwrites it.
        $expectedLocalVars = \array_merge(['data' => $data], (array) $data);
        //numeric keys in data are not extracted into the context.
        foreach ($expectedLocalVars as $key => $localVar) {
            if (\is_numeric($key)) {
                unset($expectedLocalVars[$key]);
            }
        }

        //assert the test template has printed out the expected context.
        $this->assertSame(\print_r($expectedLocalVars, true), $output);
    }

    /**
     * @return array
     */
    public function provideRenderData()
    {
        return [
            [[]],
            [['test' => \md5(\time())]],
            [['data' => \md5(\time())]],
            [new \stdClass()],
            [(object) ['test' => \md5(\time())]],
            [(object) ['data' => \md5(\time())]],
            [new \ArrayObject()],
            [[15 => \md5(\time()), 'test' => \md5(\time())]],
        ];
    }
}
