<?php


namespace Alpixel\AlpixelIntegrationBundle\DataCollector;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\DataCollector\DataCollector;


/**
 * @author Benjamin HUBERT <benjamin@alpixel.fr>
 */
class ScreenInfoCollector extends DataCollector
{
    public function collect(Request $request, Response $response, \Exception $exception = null)
    {
        $this->data = [];
    }

    public function getName()
    {
        return 'alpixel.data_collector.integration.screen_infos';
    }
}