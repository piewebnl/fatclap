<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CookbookRequest;
use App\Models\Cookbook;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class CookbookController extends Controller
{
    private $itemsPerPage;

    public function index(): JsonResponse
    {

        $this->itemsPerPage = config('fatclap.items_per_page');

        $cookbooks = Cookbook::where('user_id', Auth::id())->paginate($this->itemsPerPage);

        return response()->json($cookbooks);
    }

    public function getAll(): JsonResponse
    {

        $cookbooks = Cookbook::where('user_id', Auth::id())->get();

        return response()->json($cookbooks);
    }

    public function show(int $id): JsonResponse
    {
        $cookbook = Cookbook::where('user_id', Auth::id())->findOrFail($id);
        return response()->json($cookbook);
    }


    public function store(CookbookRequest $request)
    {
        return $this->storeOrUpdate($request, null);
    }


    public function update(CookbookRequest $request, $id)
    {
        return $this->storeOrUpdate($request, $id);
    }


    private function storeOrUpdate(CookbookRequest $request, ?int $id = null): JsonResponse
    {
        $cookbook = Cookbook::UpdateOrCreate(
            ['id' => $id],
            [
                'name' => $request->input('name'),
                'user_id' => Auth::id(),
            ]
        )->toArray();

        return response()->created('Cookbook stored', $cookbook);
    }


    public function destroy(int $id): JsonResponse
    {
        $cookbook = Cookbook::findOrFail($id);
        $cookbook->delete();

        return response()->deleted('Cookbook deleted');
    }
}
