<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function abort;
use function redirect;
use function url;
use function view;

class CategoryController extends Controller
{

    // 1- get all categories form DB
    // 2- send categories to view
    public function index()
    {
        // 1- get all categories form DB by Query Builder
        // Select * from categories
        $categories = DB::table('categories')->get();
        // 2- send categories to view
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }
    public function store(Request $request)
    {

        // validate data
        //........................
        // store data in DB using Query Builder
        DB::table('categories')->insert(
            [
                'name' => $request->name,
            ]
        );
        // set session with success message
        // redirect to index page
        return redirect(url('categories'));

    }
    public function edit($id)
    {
        // get category by id
        $category = DB::table('categories')->where('id', '=', $id)->first();
        if (!$category) {
            abort(404);
        }
        // send category to view
        return view('categories.edit', compact('category'));
    }
    public function update(Request $request, $id)
    {
        // find category by id
        $category = DB::table('categories')->find($id);
        if (!$category) {
            abort(404);
        }
        // update category
        DB::table('categories')->where('id', '=', $id)->update(
            [
                'name' => $request->name,
            ]
        );
        return redirect(url('categories'));
    }
    public function destroy($id){
        // find category by id
        $category = DB::table('categories')->find($id);
        if (!$category) {
            abort(404);
        }
        // delete category
        DB::table('categories')->where('id', '=', $id)->delete();
        return redirect(url('categories'));
    }

}

// index
// create ( form )
// store
// Edit ( form )
// Update
// show
// Delete = Destroy

