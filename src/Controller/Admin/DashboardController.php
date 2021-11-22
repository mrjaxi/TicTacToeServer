<?php

namespace App\Controller\Admin;

use App\Game\Model\Game;
use App\GameData\Model\GameData;
use App\Users\Model\Users;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('TicTacToeApp');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToCrud('Game', 'fa fa-home', Game::class);
        yield MenuItem::linkToCrud('GameData', 'fa fa-home', GameData::class);
        yield MenuItem::linkToCrud('Users', 'fa fa-home', Users::class);
    }
}
