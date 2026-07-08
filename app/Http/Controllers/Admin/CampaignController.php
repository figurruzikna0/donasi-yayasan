<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Traits\HandlesFileUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CampaignController extends Controller
{
    use HandlesFileUpload;

    public function index()
    {
        $campaigns = Campaign::all();
        return view('admin.campaigns.index', compact('campaigns'));
    }

    public function create()
    {
        return view('admin.campaigns.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255|unique:campaigns,title',
            'description' => 'required|string',
            'target_amount' => 'required|numeric|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        Campaign::create([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']),
            'description' => $validated['description'],
            'target_amount' => $validated['target_amount'],
            'image' => $this->uploadFile($request->file('image'), 'campaigns'),
            'status' => 'active',
        ]);

        return redirect()->route('admin.campaigns.index')
            ->with('success', 'Kampanye berhasil ditambahkan!');
    }

    public function show(Campaign $campaign)
    {
        return view('admin.campaigns.show', compact('campaign'));
    }

    public function edit(Campaign $campaign)
    {
        return view('admin.campaigns.edit', compact('campaign'));
    }

    public function update(Request $request, Campaign $campaign)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255|unique:campaigns,title,' . $campaign->id,
            'description' => 'required|string',
            'target_amount' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = [
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']),
            'description' => $validated['description'],
            'target_amount' => $validated['target_amount'],
        ];

        if ($request->hasFile('image')) {
            $data['image'] = $this->uploadFile(
                $request->file('image'),
                'campaigns',
                $campaign->image
            );
        }

        $campaign->update($data);

        return redirect()->route('admin.campaigns.index')
            ->with('success', 'Kampanye berhasil diperbarui!');
    }

    public function destroy(Campaign $campaign)
    {
        $campaign->delete();

        return redirect()->route('admin.campaigns.index')
            ->with('success', 'Kampanye berhasil dihapus!');
    }
}
