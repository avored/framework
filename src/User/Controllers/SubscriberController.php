<?php

namespace AvoRed\Framework\User\Controllers;

use AvoRed\Framework\Database\Contracts\SubscriberModelInterface;
use AvoRed\Framework\Database\Models\Subscriber;
use AvoRed\Framework\Tab\Tab;
use AvoRed\Framework\User\Requests\SubscriberRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

class SubscriberController extends Controller
{
    /**
     * @var \AvoRed\Framework\Database\Repository\SubscriberRepository
     */
    protected $subscriberRepository;

    /**
     *
     * @param \AvoRed\Framework\Database\Repository\SubscriberRepository $repository
     */
    public function __construct(
        SubscriberModelInterface $repository,
    ) {
        $this->subscriberRepository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        $subscribers = $this->subscriberRepository->paginate();

        return view('avored::user.subscriber.index')
            ->with('subscribers', $subscribers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function create()
    {
        $tabs = Tab::get('user.subscriber');

        return view('avored::user.subscriber.create')
            ->with('tabs', $tabs);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param SubscriberRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(SubscriberRequest $request)
    {
        $this->subscriberRepository->create($request->all());

        return redirect(route('admin.subscriber.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Subscriber  $subscriber
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function edit(Subscriber $subscriber)
    {
        $tabs = Tab::get('user.subscriber');

        return view('avored::user.subscriber.edit')
            ->with('subscriber', $subscriber)
            ->with('tabs', $tabs);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param SubscriberRequest  $request
     * @param Subscriber $subscriber
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(SubscriberRequest $request, Subscriber $subscriber)
    {
        $subscriber->update($request->all());

        return redirect(route('admin.subscriber.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Subscriber $subscriber
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Subscriber $subscriber)
    {
        $subscriber->delete();

        return new JsonResponse([
            'success' => true,
            'message' => __('avored::system.success_delete_message', ['attribute' => __('avored::system.subscriber')]),
        ]);
    }
}
