<?php

namespace Tests\Unit;

use App\Models\News;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NewsModelTest extends TestCase
{
    use RefreshDatabase;

    public function test_published_scope_only_returns_published_news()
    {
        News::factory()->count(3)->create(['status' => 'published']);
        News::factory()->count(2)->draft()->create();

        $published = News::published()->get();

        $this->assertCount(3, $published);
    }

    public function test_draft_news_not_included_in_published_scope()
    {
        News::factory()->create(['status' => 'published']);
        News::factory()->draft()->create();

        $publishedIds = News::published()->pluck('id')->toArray();
        $draft = News::where('status', 'draft')->first();

        $this->assertNotContains($draft->id, $publishedIds);
    }

    public function test_generate_slug_creates_unique_slug()
    {
        $judul = 'Berita Kegiatan Santunan';
        $slug1 = News::generateSlug($judul);
        $this->assertEquals('berita-kegiatan-santunan', $slug1);

        News::factory()->create(['judul' => $judul, 'slug' => $slug1]);
        $slug2 = News::generateSlug($judul);
        $this->assertNotEquals($slug1, $slug2);
    }
}
