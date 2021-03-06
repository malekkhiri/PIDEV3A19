<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = [
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new AppBundle\AppBundle(),
            new ProjetBundle\ProjetBundle(),
            new UserBundle\UserBundle(),
            new FOS\UserBundle\FOSUserBundle(),
            new ProduitBundle\ProduitBundle(),
            new ReclamationBundle\ReclamationBundle(),
            new EvenementBundle\EvenementBundle(),
            new MagasinBundle\MagasinBundle(),
            new Knp\Bundle\TimeBundle\KnpTimeBundle(),
            new CommandeBundle\CommandeBundle(),
            new Knp\Bundle\SnappyBundle\KnpSnappyBundle(),
            new Knp\Bundle\PaginatorBundle\KnpPaginatorBundle(),
            new Nomaya\SocialBundle\NomayaSocialBundle(),
            new GrapheBundle\GrapheBundle(),
            new CMEN\GoogleChartsBundle\CMENGoogleChartsBundle(),
            new VenteLibreBundle\VenteLibreBundle(),
            new Vich\UploaderBundle\VichUploaderBundle(),
            new blackknight467\StarRatingBundle\StarRatingBundle(),
            new Mgilet\NotificationBundle\MgiletNotificationBundle(),

        ];

        if (in_array($this->getEnvironment(), ['dev', 'test'], true)) {
            $bundles[] = new Symfony\Bundle\DebugBundle\DebugBundle();
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();

            if ('dev' === $this->getEnvironment()) {
                $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
                $bundles[] = new Symfony\Bundle\WebServerBundle\WebServerBundle();
            }
        }

        return $bundles;
    }

    public function getRootDir()
    {
        return __DIR__;
    }

    public function getCacheDir()
    {
        return dirname(__DIR__).'/var/cache/'.$this->getEnvironment();
    }

    public function getLogDir()
    {
        return dirname(__DIR__).'/var/logs';
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load($this->getRootDir().'/config/config_'.$this->getEnvironment().'.yml');
    }
}
