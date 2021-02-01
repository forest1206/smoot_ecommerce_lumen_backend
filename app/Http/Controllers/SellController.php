<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CategoryBasedField;
use App\Models\CategoryBasedFieldInputType;
use App\Models\CategoryBasedFieldLookupValue;
use App\Models\CategoryType;
use App\Models\CategoryTypes;
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Http\Resources\CategoryResource;

class SellController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function getLookupCategories() {
        $categories = Category::where(["level" => 0])->get();
        return CategoryResource::collection($categories);
    }

    public function getCategoryIdByType(Request $request) {
        $categoryId = [];
        // dd(CategoryTypes::where('value', $request->query('value'))->value('id'));
        $CategoryIDs = CategoryType::where("category_type_id", CategoryTypes::where('value', $request->query('value'))->value('id'))->get();
        foreach($CategoryIDs as $ttt) {
            $categoryId[] = $ttt->last_category_id;
        }
        return response()->json($categoryId, config("constants.SERVER_STATUS_CODES.SUCCESS"));
    }
}