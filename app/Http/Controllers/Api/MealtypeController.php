<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\MealtypeRequest;
use App\Models\Mealtype;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class MealtypeController extends Controller
{
    private $itemsPerPage;

    public function index(): JsonResponse
    {

        $this->itemsPerPage = config('fatclap.items_per_page');

        $mealtypes = Mealtype::where('user_id', Auth::id())->paginate($this->itemsPerPage);
        return response()->json($mealtypes);
    }


    public function getAll(): JsonResponse
    {
        $mealtypes = Mealtype::where('user_id', Auth::id())->get();
        return response()->json($mealtypes);
    }


    public function show(int $id): JsonResponse
    {
        $mealtype = Mealtype::where('user_id', Auth::id())->findOrFail($id);
        return response()->json($mealtype);
    }


    public function store(MealtypeRequest $request)
    {
        return $this->storeOrUpdate($request, null);
    }


    public function update(MealtypeRequest $request, $id)
    {
        return $this->storeOrUpdate($request, $id);
    }


    private function storeOrUpdate(MealtypeRequest $request, ?int $id = null): JsonResponse
    {
        $mealtype = Mealtype::UpdateOrCreate(
            ['id' => $id],
            [
                'name' => $request->input('name'),
                'color' => $request->input('color'),
                'user_id' => Auth::id(),
            ]
        )->toArray();

        return response()->created('Mealtype stored', $mealtype);
    }


    public function destroy(int $id): JsonResponse
    {
        $mealtype = Mealtype::findOrFail($id);
        $mealtype->delete();

        return response()->deleted('Mealtype deleted');
    }
}
