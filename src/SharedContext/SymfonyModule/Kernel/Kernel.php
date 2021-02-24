<?php

namespace FinizensChallenge\SharedContext\SymfonyModule\Kernel;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

class Kernel extends BaseKernel
{
    use MicroKernelTrait;

    private const ROOT_PATH = __DIR__ . '/../../../..';


    protected function configureContainer(ContainerConfigurator $container): void
    {
        $container->import(self::ROOT_PATH . '/config/{packages}/*.yaml');
        $container->import(self::ROOT_PATH . '/config/{packages}/' . $this->environment . '/*.yaml');

        if (is_file(\dirname(__DIR__) . '/config/services.yaml')) {
            $container->import(self::ROOT_PATH . '/config/services.yaml');
            $container->import(self::ROOT_PATH . '/config/{services}_' . $this->environment . '.yaml');
        } elseif (is_file($path = \dirname(__DIR__) . '/config/services.php')) {
            (require $path)($container->withPath($path), $this);
        }
    }

    protected function configureRoutes(RoutingConfigurator $routes): void
    {
        $routes->import(self::ROOT_PATH . '/config/{routes}/' . $this->environment . '/*.yaml');
        $routes->import(self::ROOT_PATH . '/config/{routes}/*.yaml');

        if (is_file(\dirname(__DIR__) . '/config/routes.yaml')) {
            $routes->import(self::ROOT_PATH . '/config/routes.yaml');
        } elseif (is_file($path = \dirname(__DIR__) . '/config/routes.php')) {
            (require $path)($routes->withPath($path), $this);
        }
    }
}
