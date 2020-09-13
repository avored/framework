<?php

namespace AvoRed\Framework\User\Controllers;

use AvoRed\Framework\Support\Facades\Tab;
use AvoRed\Framework\Database\Models\Address;
use AvoRed\Framework\User\Requests\AddressRequest;
use AvoRed\Framework\Database\Contracts\AddressModelInterface;
use AvoRed\Framework\Database\Contracts\CountryModelInterface;
use AvoRed\Framework\Database\Models\Customer;

class AddressController
{
    /**
     * Address Repository for controller.
     * @var \AvoRed\Framework\Database\Repository\AddressRepository
     */
    protected $addressRepository;

    /**
     * Country Repository for controller.
     * @var \AvoRed\Framework\Database\Repository\CountryRepository
     */
    protected $countryRepository;

    /**
     * Construct for the AvoRed Address Group controller.
     * @param \AvoRed\Framework\Database\Contracts\AddressModelInterface $addressRepository
     */
    public function __construct(
        AddressModelInterface $addressRepository,
        CountryModelInterface $countryRepository
    ) {
        $this->addressRepository = $addressRepository;
        $this->countryRepository = $countryRepository;
    }

    /**
     * Show the form for editing the specified resource.
     * @param Customer $customer
     * @param Address $address
     * @return \Illuminate\View\View
     */
    public function edit(Customer $customer, Address $address)
    {
        $tabs = Tab::get('user.address');
        $typeOptions = Address::TYPEOPTIONS;
        $countryOptions = $this->countryRepository->options();
       

        return view('avored::user.address.edit')
            ->with('address', $address)
            ->with('editAddress', true)
            ->with('customer', $customer)
            ->with('typeOptions', $typeOptions)
            ->with('countryOptions', $countryOptions)
            ->with('tabs', $tabs);
    }

    /**
     * Update the specified resource in storage.
     * @param \AvoRed\Framework\Cms\Requests\AddressRequest $request
     * @param \AvoRed\Framework\Database\Models\Address  $address
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(AddressRequest $request, Customer $customer, Address $address)
    {
        $address->update($request->all());

        return redirect()->route('admin.customer.edit', ['customer' => $customer->id])
            ->with('successNotification', __(
                'avored::system.notification.updated',
                ['attribute' => __('avored::system.address')]
            ));
    }

    /**
     * Remove the specified resource from storage.
     * @param \AvoRed\Framework\Database\Models\Address  $address
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Address $address)
    {
        $address->delete();

        return response()->json([
            'success' => true,
            'message' => __(
                'avored::system.notification.delete',
                ['attribute' => __('avored::customer_group')]
            ),
        ]);
    }
}
