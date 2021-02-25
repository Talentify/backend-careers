<?php

/**
 * @see       https://github.com/laminas/laminas-mvc-skeleton for the canonical source repository
 * @copyright https://github.com/laminas/laminas-mvc-skeleton/blob/master/COPYRIGHT.md
 * @license   https://github.com/laminas/laminas-mvc-skeleton/blob/master/LICENSE.md New BSD License
 */

declare(strict_types=1);

namespace Admin\Controller;

use Admin\Entity\Partner;
use CrEOF\Spatial\PHP\Types\Geometry\MultiPolygon;
use CrEOF\Spatial\PHP\Types\Geometry\Point;
use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    private $em;
    private $container;

    public function __construct(ContainerInterface $container,EntityManager $em)
    {
        $this->container = $container;
        $this->em = $em;
    }

    public function indexAction()
    {
        try {
            $location = new Partner();

            $location->setDocument('teste');
            $location->setOwnerName('teste');
            $location->setTradingName('teste');
            $location->setAddress(new Point(37.4220761, -122.0845187));
            $location->setCoverageArea(new MultiPolygon([
                [[[30, 20], [45, 40], [10, 40], [30, 20]]],
                [[[15, 5], [40, 10], [10, 20], [5, 10], [15, 5]]]
            ]));

            $this->em->persist($location);
            $this->em->flush();
            $this->em->clear();

            $repo = $this->em->getRepository(Partner::class);

            $result = $repo->find(1);

            $t = "t";
        }
        catch (\Exception $e) {
            $te = "tes";
        }

        return new ViewModel();
    }
}
