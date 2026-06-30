<?php

namespace App\Http\Controllers\Admin;

use App\Helper;
use App\Http\Controllers\Controller;
use App\Models\ServiceProcess;
use Illuminate\Http\Request;

class ServiceProcessController extends Controller
{
    public function index()
    {
        $processes = ServiceProcess::ordered()->paginate(15);

        return view('admin.service-processes.index', compact('processes'));
    }

    public function create()
    {
        return view('admin.service-processes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'step_number' => 'required|integer|min:1',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|string|max:255',
            'color' => 'nullable|string|max:7',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer',
        ]);

        $data = $request->all();
        $data['is_active'] = $request->has('is_active');
        $data['sort_order'] = $data['sort_order'] ?? $data['step_number'];

        ServiceProcess::create($data);
        $this->render();

        return redirect()->route('admin.service-processes.index')
            ->with('success', 'Service process step created successfully.');
    }

    public function edit(ServiceProcess $serviceProcess)
    {
        return view('admin.service-processes.edit', compact('serviceProcess'));
    }

    public function update(Request $request, ServiceProcess $serviceProcess)
    {
        $request->validate([
            'step_number' => 'required|integer|min:1',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|string|max:255',
            'color' => 'nullable|string|max:7',
            'sort_order' => 'nullable|integer',
        ]);

        $data = $request->all();
        $data['is_active'] = $request->has('is_active');
        $data['sort_order'] = $data['sort_order'] ?? $data['step_number'];

        $serviceProcess->update($data);
        $this->render();

        return redirect()->route('admin.service-processes.index')
            ->with('success', 'Service process step updated successfully.');
    }

    public function destroy(ServiceProcess $serviceProcess)
    {
        $serviceProcess->delete();
        $this->render();

        return redirect()->route('admin.service-processes.index')
            ->with('success', 'Service process step deleted successfully.');
    }

    public function render()
    {
        $serviceProcesses = ServiceProcess::active()->ordered()->get();
        Helper::putCache('services.process', view('admin.template.services.process', compact('serviceProcesses')));
    }
}
