<?php

namespace App\Http\Controllers;

use App\Http\Requests\GenerateTextRequest;
use App\Models\SavedContent;
use App\Services\OpenAI\OpenAIService;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Inertia\Response;

class SavedContentController extends Controller
{

    /**
     * List of generated texts.
     */
    public function index(): Response
    {
        $savedContent = auth()->user()->savedContent;
        return Inertia::render('content/index', compact('savedContent'));
    }

    /**
     * Page for generating text content.
     */
    public function create(): Response
    {
        return Inertia::render('content/create', []);
    }

    /**
     * Show full text for content.
     */
    public function show(SavedContent $content): Response
    {
        Gate::authorize('view', [SavedContent::class, $content]);
        return Inertia::render('content/view', compact('content'));
    }

    /**
     * Delete saved generated text.
     */
    public function destroy(SavedContent $content): RedirectResponse
    {
        Gate::authorize('delete', [SavedContent::class, $content]);
        $content->delete();
        return redirect()->route('saved-content.index')->with('success', 'Saved content has been deleted.');
    }

    /**
     * Generate text using Open AI.
     */
    public function generateText(GenerateTextRequest $request, OpenAIService $aiService): RedirectResponse
    {
        try {
            $aiService->generateText(user: auth()->user(), data: $request->validated());
            return redirect()->route('saved-content.index')->with('success', 'Text generated');
        } catch (Exception $e) {
            Log::error('Failed to generate text: ' . $e->getMessage());
            return redirect()->route('saved-content.index')->with('error', 'Failed to generate text');
        }
    }
}
