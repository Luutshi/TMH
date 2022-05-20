<?php

namespace Mvc\Controllers;

use Config\Controller;
use Mvc\Models\LocationModel;
use Mvc\Models\MarketplaceModel;

class MarketplaceController extends Controller
{
    private MarketplaceModel $marketplaceModel;

    public function __construct()
    {
        $this->marketplaceModel = new MarketplaceModel();
        parent::__construct();
    }

    public function marketplaceList()
    {
        if (isset($_SESSION['user'])) {
            $products = $this->marketplaceModel->eachProducts();

            echo $this->twig->render('/Admin/Marketplace/marketplaceList.html.twig', [
                'products' => $products,
            ]);

        } else {
            header('Location: /register');
            exit;
        }
    }

    public function marketplaceCreate()
    {
        if (isset($_SESSION['user'])) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name']) && isset($_POST['category']) && isset($_POST['description']) && isset($_POST['price'])) {
                $this->marketplaceModel->insertProduct($_POST['name'], $_POST['category'], $_POST['description'], $_POST['price']);

                header('Location: /admin/marketplace');
                exit;
            } else {
                $categories = $this->marketplaceModel->eachCategories();

                echo $this->twig->render('/Admin/Marketplace/marketplaceCreate.html.twig', [
                    'categories' => $categories,
                ]);
            }
        } else {
            header('Location: /register');
            exit;
        }
    }

    public function marketplaceDelete($productID)
    {
        if (isset($_SESSION['user'])) {
            $this->marketplaceModel->deleteProduct($productID);

            header('Location: /admin/marketplace');
            exit;
        } else {
            header('Location: /register');
            exit;
        }
    }

    public function marketplaceCategoryList()
    {
        if (isset($_SESSION['user'])) {
            $products = $this->marketplaceModel->eachCategories();

            echo $this->twig->render('/Admin/Marketplace/Category/categoryList.html.twig', [
                'products' => $products,
            ]);

        } else {
            header('Location: /register');
            exit;
        }
    }

    public function marketplaceCategoryCreate()
    {
        if (isset($_SESSION['user'])) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name'])) {
                $this->marketplaceModel->insertCategory($_POST['name']);

                header('Location: /admin/marketplace/category');
                exit;
            } else {
                echo $this->twig->render('/Admin/Marketplace/Category/categoryCreate.html.twig');
            }
        } else {
            header('Location: /register');
            exit;
        }
    }

    public function marketplaceCategoryDelete($productID)
    {
        if (isset($_SESSION['user'])) {
            $this->marketplaceModel->deleteCategory($productID);

            header('Location: /admin/marketplace/category');
            exit;
        } else {
            header('Location: /register');
            exit;
        }
    }
}