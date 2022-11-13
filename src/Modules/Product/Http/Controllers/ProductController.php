<?php

namespace Modules\Product\Http\Controllers;

use App\utils\ApiResponse;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Product\Entities\Product;
use Modules\Product\Http\Requests\ProductRequest;
use Modules\Product\Transformers\ProductResource;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('product::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('product::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ProductRequest $request)
    {
        Product::query()->create([
            'item_name' => $request->get('itemName'),
            'active' => $request->get('active'),
            'selling_price' => $request->get('sellingPrice'),
            'tax' => $request->get('tax'),
            'discount_percentage' => $request->get('discountPercentage'),
            'inventory' => $request->get('inventory'),
        ]);
        return (new ApiResponse([], 'ok'))->success();
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(Product $product)
    {
        $item = new ProductResource($product);
        return (new ApiResponse($item, 'ok'))->success();
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('product::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(ProductRequest $request, Product $product)
    {
        return $product;
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
