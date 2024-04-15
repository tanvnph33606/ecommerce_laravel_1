<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMenuCatalogueRequest;
use App\Repositories\Interfaces\MenuRepositoryInterface as MenuRepository;
use App\Services\Interfaces\MenuCatalogueServiceInterface as MenuCatalogueService;
use App\Services\Interfaces\MenuServiceInterface as MenuService;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    protected $menuRepository;
    protected $menuCatalogueService;
    protected $menuService;
    public function __construct(
        MenuRepository $menuRepository,
        MenuCatalogueService $menuCatalogueService,
        MenuService $menuService,
    ) {
        parent::__construct();
        $this->menuRepository = $menuRepository;
        $this->menuCatalogueService = $menuCatalogueService;
        $this->menuService = $menuService;
    }

    public function createCatalogue(StoreMenuCatalogueRequest $request)
    {
        $successMessage = $this->getToastMessage('menuCatalogue', 'success', 'create');
        $errorMessage = $this->getToastMessage('menuCatalogue', 'error', 'create');

        $response = $this->menuCatalogueService->create();
        if ($response !== false) {
            return response()->json([
                'type' => 'success',
                'message' => $successMessage,
                'data' => $response
            ]);
        }

        return response()->json([
            'type' => 'error',
            'message' => $errorMessage,
        ]);
    }

    public function drag(Request $request)
    {
        $successMessage = $this->getToastMessage('menu', 'success', 'show');
        $errorMessage = $this->getToastMessage('menu', 'error', 'show');

        $menuCatalogueId = $request->menu_catalogue_id;
        $json = json_decode($request->json, true);
        $response = $this->menuService->dragUpdate($json, $menuCatalogueId);
        if ($response !== false) {
            return response()->json([
                'type' => 'success',
                'message' => $successMessage,
            ]);
        }

        return response()->json([
            'type' => 'error',
            'message' => $errorMessage,
        ]);
    }
}
