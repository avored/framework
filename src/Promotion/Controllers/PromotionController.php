<?php
namespace AvoRed\Framework\Promotion\Controllers;

use AvoRed\Framework\Database\Contracts\PromotionCodeModelInterface;
use AvoRed\Framework\Database\Models\PromotionCode;
use AvoRed\Framework\Promotion\Requests\PromotionCodeRequest;
use AvoRed\Framework\Support\Facades\Tab;
use Illuminate\Http\Request;

class PromotionController
{
    /**
     * Promotion Code Repository for the Install Command.
     * @var \AvoRed\Framework\Database\Repository\PromotionCodeRepository
     */
    protected $repository;


    public function __construct(
        PromotionCodeModelInterface $repository
    ) {
        $this->repository = $repository;
    }

    /**
     * Show available promotion list of an AvoRed Admin.
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $promotionCodes = $this->repository->paginate();
        return view('avored::promotion.promotion-code.index')
            ->with('promotionCodes', $promotionCodes);
    }

         /**
     * Show the form for creating a new resource.
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $tabs = Tab::get('promotion.promotion-code');
        $typeOptions = PromotionCode::TYPEOPTIONS;

        return view('avored::promotion.promotion-code.create')
            ->with(compact('tabs', 'typeOptions'));
    }

    /**
     * Store a newly created resource in storage.
     * @param \AvoRed\Framework\Promotion\Requests\PromotionCodeRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PromotionCodeRequest $request)
    {
        $this->repository->create($request->all());

        return redirect()->route('admin.promotion-code.index')
            ->with('successNotification', __(
                'avored::system.notification.store',
                ['attribute' => __('avored::promotion.promotion-code.title')]
            ));
    }

    /**
     * Show the form for editing the specified resource.
     * @param \AvoRed\Framework\Database\Models\PromotionCode $promotionCode
     * @return \Illuminate\View\View
     */
    public function edit(PromotionCode $promotionCode)
    {
        $tabs = Tab::get('promotion.promotion-code');
        $typeOptions = PromotionCode::TYPEOPTIONS;

        return view('avored::promotion.promotion-code.edit')
            ->with(compact('promotionCode', 'tabs', 'typeOptions'));
    }

    /**
     * Update the specified resource in storage.
     * @param \AvoRed\Framework\Catalog\Requests\PromotionCodeRequest $request
     * @param \AvoRed\Framework\Database\Models\PromotionCode  $promotionCode
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PromotionCodeRequest $request, PromotionCode $promotionCode)
    {
        $promotionCode->update($request->all());

        return redirect()->route('admin.category.index')
            ->with('successNotification', __(
                'avored::system.notification.updated',
                ['attribute' => __('avored::promotion.promotion-code.title')]
            ));
    }

    /**
     * Remove the specified resource from storage.
     * @param \AvoRed\Framework\Database\Models\PromotionCode  $promotionCode
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(PromotionCode $promotionCode)
    {
        $promotionCode->delete();

        return response()->json([
            'success' => true,
            'message' => __(
                'avored::system.notification.delete',
                ['attribute' => __('avored::promotion.promotion-code.title')]
            ),
        ]);
    }


    /**
     * Filter for Category Table.
     * @return \Illuminate\View\View
     */
    public function filter(Request $request)
    {
        return $this->repository->filter($request->get('filter'));
    }
}
