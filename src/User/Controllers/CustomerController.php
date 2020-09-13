<?php

namespace AvoRed\Framework\User\Controllers;

use AvoRed\Framework\Support\Facades\Tab;
use AvoRed\Framework\Database\Models\Customer;
use AvoRed\Framework\User\Requests\CustomerRequest;
use AvoRed\Framework\Database\Contracts\CustomerModelInterface;

class CustomerController
{
    /**
     * Customer Repository for controller.
     * @var \AvoRed\Framework\Database\Repository\CustomerRepository
     */
    protected $customerRepository;

    /**
     * Construct for the AvoRed Customer Group controller.
     * @param \AvoRed\Framework\Database\Contracts\CustomerModelInterface $customerRepository
     */
    public function __construct(
        CustomerModelInterface $customerRepository
    ) {
        $this->customerRepository = $customerRepository;
    }

    /**
     * Show Dashboard of an AvoRed Admin.
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $customers = $this->customerRepository->paginate();

        return view('avored::user.customer.index')
            ->with(compact('customers'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param \AvoRed\Framework\Database\Models\Customer $customer
     * @return \Illuminate\View\View
     */
    public function edit(Customer $customer)
    {
        $tabs = Tab::get('user.customer');
        
        return view('avored::user.customer.edit')
            ->with(compact('customer', 'tabs'));
    }

    /**
     * Update the specified resource in storage.
     * @param \AvoRed\Framework\Cms\Requests\CustomerRequest $request
     * @param \AvoRed\Framework\Database\Models\Customer  $customer
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CustomerRequest $request, Customer $customer)
    {
        $customer->name = $request->get('name');
        $customer->is_default = $request->get('is_default') ? 1: 0;

        $customer->save();

        return redirect()->route('admin.customer.index')
            ->with('successNotification', __(
                'avored::system.notification.updated',
                ['attribute' => __('avored::system.customer_group')]
            ));
    }

    /**
     * Remove the specified resource from storage.
     * @param \AvoRed\Framework\Database\Models\Customer  $customer
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();

        return response()->json([
            'success' => true,
            'message' => __(
                'avored::system.notification.delete',
                ['attribute' => __('avored::customer_group')]
            ),
        ]);
    }
}
