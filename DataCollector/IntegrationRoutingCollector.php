<?php


namespace Alpixel\Bundle\IntegrationBundle\DataCollector;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\DataCollector\DataCollector;
use Symfony\Component\Routing\RouterInterface;


/**
 * @author Benjamin HUBERT <benjamin@alpixel.fr>
 */
class IntegrationRoutingCollector extends DataCollector
{
    private $router;

    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    public function collect(Request $request, Response $response, \Exception $exception = null)
    {
        $collection = $this->router->getRouteCollection();
        $allRoutes = $collection->all();

        $integrationRoutes = [];

        foreach ($allRoutes as $route => $params) {

            $defaults = $params->getDefaults();

            if (isset($defaults['_controller'])) {
                $controllerAction = explode(':', $defaults['_controller']);
                $controller = $controllerAction[0];

                if (preg_match("@IntegrationController@", $controller)) {
                    $integrationRoutes[] = $route;
                }
            }
        }

        sort($integrationRoutes);
        $this->data = [
            "routes" => $integrationRoutes,
        ];
    }

    public function getRoutes()
    {
        return $this->data['routes'];
    }

    public function getName()
    {
        return 'alpixel.data_collector.integration.routing';
    }
}
