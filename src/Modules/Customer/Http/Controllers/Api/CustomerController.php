<?php

namespace Modules\Customer\Http\Controllers\Api;

use App\utils\ApiResponse;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Customer\Entities\Customer;
use Modules\Customer\Http\Requests\CustomerRequest;
use Modules\Customer\Http\Requests\StoreCustomerRequest;
use Modules\Customer\Http\Requests\UpdateCustomerRequest;
use Modules\Customer\Transformers\CustomerCollection;
use Modules\Customer\Transformers\CustomerResource;


class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $items = Customer::query()->paginate(50);
        return (new ApiResponse(new CustomerCollection($items), 'ok'))->success();

    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('customer::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreCustomerRequest $request)
    {

        $demonstrationName = $request->get('firstName') . $request->get('lastName');

        $model = Customer::query()->create([
            'demonstration_name' => $demonstrationName,
            'active' => $request->get('active'),
            'first_name' => $request->get('firstName'),
            'last_name' => $request->get('lastName'),
            'social_id' => $request->get('socialId'),
            'birthday' => $request->get('birthday'),
            'mobile_number' => $request->get('mobileNumber'),
            'mobile_number_description' => $request->get('mobileNumberDescription'),
            'email' => $request->get('email'),
            'email_description' => $request->get('emailDescription'),
        ]);

        return (new ApiResponse(new CustomerResource($model), 'ok'))->success();
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(Customer $customer)
    {
        return (new ApiResponse(new CustomerCollection($customer), 'ok'))->success();
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('customer::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        $customer->update([
//            'demonstration_name' => $demonstrationName,
            'active' => $request->get('active'),
            'first_name' => $request->get('firstName'),
            'last_name' => $request->get('lastName'),
            'social_id' => $request->get('socialId'),
            'birthday' => $request->get('birthday'),
            'mobile_number' => $request->get('mobileNumber'),
            'mobile_number_description' => $request->get('mobileNumberDescription'),
            'email' => $request->get('email'),
            'email_description' => $request->get('emailDescription'),
        ]);

        return (new ApiResponse([], 'ok'))->success();
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return (new ApiResponse([], 'Customer has been deleted'))->success();
    }
}
