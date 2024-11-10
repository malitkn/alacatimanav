<?php /** @noinspection ALL */

namespace App\Http\Controllers\Back;

use App\Enums\PageCategoryListType;
use App\Http\Controllers\Controller;
use App\Models\PageCategory;
use App\Http\Requests\StorePageCategoryRequest;
use App\Http\Requests\UpdatePageCategoryRequest;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class PageCategoryController extends Controller
{
    protected $pageCategories;
    protected PageCategory $pageCategory;

    public function __construct(PageCategory $pageCategory)
    {
        $this->pageCategory = $pageCategory;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('back.pages.categories.index')
            ->with('pageCategories', $this->pageCategory->paginate(4))
            ->with('allPageCategories', $this->pageCategory->all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('back.pages.categories.create')
            ->with('pageCategories', $this->pageCategory->all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePageCategoryRequest $request)
    {
        $this->pageCategory->create($request->all());
        $request->session()->now('status', ['isSuccess' => true, 'message' => __(':title adlı Sayfa kategorisi başarıyla oluşturuldu.', ['title' => $request->title])]);
        return $this->create();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PageCategory $category)
    {
        try {
            $validated = $request->validate([
                'title' => ['required', 'max:150'],
                'slug' => ['required', 'max:80', Rule::unique('page_categories', 'slug')->ignore($category)],
                'parent' => ['required',
                    // 0 eşit değil ve page_categories tablosunda yok hata döndür
                    function ($attribute, $value, $fail) {
                        if ($value !== "0" && !DB::table('page_categories')->where('id', $value)->exists()) {
                            $fail("Seçilen {$attribute} değeri geçersiz.");
                        }
                    }
                ],
                'meta_description' => ['required', 'max:150'],
                'list_type' => ['required', Rule::enum(PageCategoryListType::class)],
                'status' => ['required', 'boolean'],
            ]);
            $pageCategoryModel = PageCategory::find($category)->first();
            $pageCategoryModel->update($validated);
            return response()->json(['success' => 'İşlem başarılı!']);
        } catch (\Exception $e) {
            return response()->json($e->errors(), 500);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        try {
            $this->pageCategory->destroy($id);
            $request->session()->now('status', ['isSuccess' => true, 'message' => __('Kayıt başarıyla silindi!')]);
        } catch (\Exception $e) {
            $request->session()->now('status', ['isSuccess' => false, 'message' => __('Kayıt silinemedi!')]);
        }
        return $this->index();
    }
}
