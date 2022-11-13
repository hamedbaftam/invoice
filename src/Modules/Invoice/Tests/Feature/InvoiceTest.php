<?php

namespace Modules\Invoice\Tests\Feature;

use Modules\Customer\Entities\Customer;
use Modules\Product\Entities\Product;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class InvoiceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testBodyContent()
    {
        $request = $this->withHeaders(['Accept' => 'application/json'])->post(route('invoice.store'), []);
        $request->assertStatus(422);
    }

//
//    public function testCreateInvoice()
//    {
//        $this
//            ->withHeaders(['Accept' => 'application/json'])
//            ->post('/api/invoice', [
//                'customerId' => 2,
//                'products' => [
//                    [
//                        'id' => 1,
//                        'quantity' => 3
//                    ]
//                ]
//            ])
//            ->assertOk()
//            ->assertJsonPath('success', true)
//            ->assertJsonStructure([
//                'result' => [
//                    "hamed"
//                ]
//            ]);
//    }

    public function testCustomerMustBeActive()
    {
        $user = Customer::factory()->create([
            'active' => false
        ]);

        $this->withHeaders(['Accept' => 'application/json'])
            ->post('/api/invoice', [
                'customerId' => $user->id,
                'products' => []
            ])
            ->assertStatus(422)
            ->assertJsonStructure([
                'errors' => [
                    'customerId'
                ]
            ]);
    }

    public function testProductMustBeActive()
    {
        $user = Customer::factory()->create([
            'active' => true
        ]);
        $product = Product::factory()->create([
            'active' => false
        ]);


        $this->withHeaders(['Accept' => 'application/json'])
            ->post('/api/invoice', [
                'customerId' => $user->id,
                'products' => [
                    'id' => $product->id,
                    'quantity' => 1
                ]
            ])
            ->assertStatus(422)
            ->assertJsonStructure([
                'errors' => [
                    'products.id.id'
                ]
            ]);
    }

    public function testCreateNewInvoice()
    {
        $user = Customer::factory()->create([
            'active' => true
        ]);
        $product = Product::factory()->create([
            'active' => true
        ]);


        $this->withHeaders(['Accept' => 'application/json'])
            ->post('/api/invoice', [
                'customerId' => $user->id,
                'products' => [
                    [
                        'id' => $product->id,
                        'quantity' => 2
                    ]
                ]
            ])
            ->assertStatus(200)
            ->assertJsonPath('success', true)
            ->assertJsonStructure([
                'result' => [
                    'customer' => [
                        'demonstrationName'
                    ],
                    'items' => [
                        [
                            'quantity',
                            'price',
                            'amount',
                            'discount',
                            'totalAmountAfterDiscount',
                            'tax',
                            'totalAmount',
                        ]
                    ],
                    'totalAmount',
                ]

            ]);
    }


    public function testEditInvoice()
    {
        $user = Customer::factory()->create([
            'active' => true
        ]);
        $product = Product::factory()->create([
            'active' => true
        ]);

        $request = $this->withHeaders(['Accept' => 'application/json'])
            ->post('/api/invoice', [
                'customerId' => $user->id,
                'products' => [
                    [
                        'id' => $product->id,
                        'quantity' => 2
                    ]
                ]
            ]);
        $invoiceId = $request->json()['result']['invoiceId'];

        $this->withHeaders(['Accept' => 'application/json'])
            ->put('/api/invoice/' . $invoiceId, [
                'customerId' => $user->id,
                'products' => [
                    [
                        'id' => $product->id,
                        'quantity' => 2
                    ]
                ]
            ])
            ->assertStatus(200)
            ->assertJsonPath('success', true)
            ->assertJsonStructure([
                'result' => [
                    'customer' => [
                        'demonstrationName'
                    ],
                    'items' => [
                        [
                            'quantity',
                            'price',
                            'amount',
                            'discount',
                            'totalAmountAfterDiscount',
                            'tax',
                            'totalAmount',
                        ]
                    ],
                    'totalAmount',
                ]

            ]);

    }


    public function testCanRemoveInvoice()
    {

        $user = Customer::factory()->create([
            'active' => true
        ]);
        $product = Product::factory()->create([
            'active' => true
        ]);

        $request = $this->withHeaders(['Accept' => 'application/json'])
            ->post('/api/invoice', [
                'customerId' => $user->id,
                'products' => [
                    [
                        'id' => $product->id,
                        'quantity' => 2
                    ]
                ]
            ]);
        $invoiceId = $request->json()['result']['invoiceId'];

        $this->withHeaders(['Accept' => 'application/json'])
            ->delete('/api/invoice/' . $invoiceId)
            ->assertStatus(200);

    }


}
