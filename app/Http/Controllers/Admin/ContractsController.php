<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Contract;
use App\Http\Requests\Admin\ContractRequest;
use Yajra\DataTables\Facades\DataTables;

class ContractsController extends Controller
{

    /**
     * assign roles
     */
    public function __construct()
    {
        $this->middleware('can:view_contract', ['only' => ['index', 'show', 'ajax']]);
        $this->middleware('can:create_contract', ['only' => ['create', 'store']]);
        $this->middleware('can:edit_contract', ['only' => ['edit', 'update']]);
        $this->middleware('can:delete_contract', ['only' => ['destroy']]);
    }


    public function index(): Factory|View|Application
    {
        return view('admin.contracts.index');
    }


    public function ajax(Request $request): JsonResponse
    {
        $model = Contract::query();

        return DataTables::eloquent($model)
            ->editColumn('discount', function ($contract) {
                return $contract['discount'] . ' %';
            })
            ->addColumn('action', function ($contract) {
                return view('admin.contracts._action', compact('contract'));
            })
            ->toJson();
    }

    /*
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): Factory|View|Application
    {
        return view('admin.contracts.create');
    }

    /*
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContractRequest $request): RedirectResponse
    {
        Contract::query()->create($request->except('_token', '_method', 'files'));

        session()->flash('success', __('Contract created successfully'));

        return redirect()->route('admin.contracts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /*
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id): Factory|View|Application
    {
        $contract = Contract::query()->findOrFail($id);

        return view('admin.contracts.edit', compact('contract'));
    }

    /*
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ContractRequest $request, $id): RedirectResponse
    {
        $contract = Contract::query()->findOrFail($id);
        $contract->update($request->except('_token', '_method', 'files'));

        session()->flash('success', __('Contract updated successfully'));

        return redirect()->route('admin.contracts.index');
    }

    /*
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id): RedirectResponse
    {
        $contract = Contract::query()->findOrFail($id);
        $contract->delete();

        session()->flash('success', __('Contract deleted successfully'));

        return redirect()->route('admin.contracts.index');
    }
}



