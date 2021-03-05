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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
       
        $perPage = 10;
        if ($request->get('filter')) {
            $promotionCodes = $this->repository->filter($request->get('filter'));
        } else {
            $promotionCodes = $this->repository->paginate($perPage);
        }

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
                'avored::system.created_notification',
                ['attribute' => __('avored::system.promo-code')]
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

        return redirect()->route('admin.promotion-code.index')
            ->with('successNotification', __(
                'avored::system.updated_notification',
                ['attribute' => __('avored::system.promo-code')]
            ));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $id)
    {
        PromotionCode::destroy($id);

        return redirect()->route('admin.promotion-code.index')
            ->with('successNotification', __(
                'avored::system.deleted_notification',
                ['attribute' => __('avored::system.promo-code')]
            ));
    }
}
