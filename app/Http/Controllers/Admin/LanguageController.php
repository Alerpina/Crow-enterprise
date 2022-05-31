<?php

namespace App\Http\Controllers\Admin;

use Yajra\DataTables\DataTables;
use App\Models\Language;
use Illuminate\Http\Request;
use App\Models\Generalsetting;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class LanguageController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');

        parent::__construct();
    }

    //*** JSON Request
    public function datatables()
    {
        $datas = Language::orderBy('id');
        //--- Integrating This Collection Into Datatables
        return Datatables::of($datas)
            ->addColumn('language', function(Language $data){
                if($data->is_default){ 
                    $badge = ' <span class="badge badge-pill badge-primary">'.__("Default").'</span>';
                    return __($data->language).$badge;
                } else {
                    return __($data->language);
                }
            })
            ->addColumn('action', function (Language $data) {
                $delete = $data->id == 1 ? '' : '
                <a href="javascript:;" data-href="' . route('admin-lang-delete', $data->id) . '" data-toggle="modal" data-target="#confirm-delete" class="delete">
                    <i class="fas fa-trash-alt"></i> ' . __('Delete') . '
                </a>';
                if (Session::has('admstore')) {
                    $default = Session::get('admstore')->lang_id == $data->id ? '' : '<a class="status" data-href="' . route('admin-lang-st', ['id1' => $data->id, 'id2' => 1]) . '"><i class="icofont-globe"></i> ' . __('Set Default') . '</a>';
                } else {
                    $default = $this->storeSettings->lang_id == $data->id ? '' : '<a class="status" data-href="' . route('admin-lang-st', ['id1' => $data->id, 'id2' => 1]) . '"><i class="icofont-globe"></i> ' . __('Set Default') . '</a>';
                }
                return '
                <div class="godropdown">
                    <button class="go-dropdown-toggle"> ' . __('Actions') . '<i class="fas fa-chevron-down"></i></button>
                    <div class="action-list">
                        <a href="' . route('admin-lang-edit', $data->id) . '"> <i class="fas fa-edit"></i>' . __('Edit') . '</a>' . $delete . $default . '
                    </div>
                </div>';
            })
            ->rawColumns(['action','language'])
            ->toJson(); //--- Returning Json Data To Client Side
    }

    //*** GET Request
    public function index()
    {
        return view('admin.language.index');
    }

    //*** GET Request
    public function create()
    {
        return view('admin.language.create');
    }

    //*** POST Request
    public function store(Request $request)
    {
        //--- Validation Section
        $rules = [
            'locale'      => 'required|unique:languages,locale',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }

        //--- Validation Section Ends

        //--- Logic Section
        $input = $request->all();
        $data = new Language();
        $data->language = $input['language'];
        $data->locale = $input['locale'];
        $data->rtl = $input['rtl'];
        $data->file = $data->locale . '.json';
        unset($input['_token']);
        unset($input['language']);
        unset($input['rtl']);

        if(file_exists(resource_path("lang") . '/base_' . $data->locale . '.json')){
            copy(resource_path("lang") . '/base_' . $data->locale . '.json', resource_path("lang") . '/' . $data->locale . '.json');
        }else{
        $fields = $this->getTranslationKeys();
        sort($fields, SORT_STRING | SORT_FLAG_CASE);
        foreach ($fields as $field) {
            $translations[$field] = "";
        }
        $mydata = json_encode($translations);
        file_put_contents(resource_path("lang") . '/' . $data->file, $mydata);
        }

        $data->save();
        //--- Logic Section Ends

        //--- Redirect Section
        $msg = __('New Data Added Successfully.');
        return response()->json($msg);
        //--- Redirect Section Ends
    }

    //*** GET Request
    public function edit($id)
    {
        $fields = $this->getTranslationKeys();

        $keys = array_flip($fields);

        $data = Language::findOrFail($id);
        if(file_exists(resource_path("lang") . '/' . $data->file)){
            $data_results = file_get_contents(resource_path("lang") . '/' . $data->file);
            $langJson = json_decode($data_results, true);
            $langJson = array_filter($langJson);
            if(file_exists(resource_path("lang") . '/base_' . $data->locale . '.json')){
                $data_results_base = file_get_contents(resource_path("lang") . '/base_' . $data->locale . '.json');
                $langJsonBase = json_decode($data_results_base, true);
                $newBaseKeys = array_diff_key($langJsonBase,$langJson);
                $langJson = array_merge($newBaseKeys,$langJson);
            }
            
            $newKeys = array_diff_key($keys, $langJson);
            
            $langEdit = array_merge($newKeys, $langJson);
        }else if(file_exists(resource_path("lang") . '/base_' . $data->locale . '.json')){
            $data_results = file_get_contents(resource_path("lang") . '/base_' . $data->locale . '.json');
            $langJson = json_decode($data_results, true);

        $newKeys = array_diff_key($keys, $langJson);
        $langEdit = array_merge($newKeys, $langJson);
        }else{
            $langEdit = $keys;
        }
        ksort($langEdit, SORT_STRING | SORT_FLAG_CASE);

        return view('admin.language.edit', compact('data', 'langEdit'));
    }

    //*** POST Request
    public function update(Request $request, $id)
    {
        //--- Validation Section
        $rules = [
            'locale' => [
                'required',
                Rule::unique('languages')->ignore($id)
            ]
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        //--- Validation Section Ends

        //--- Logic Section
        $input = $request->all();
        $data = Language::findOrFail($id);
        $oldFile = $data->file; //the locale can be edited
        $oldLocale = $data->locale;
        
        $data->language = $input['language'];
        $data->locale = $input['locale'];
        $data->rtl = $input['rtl'];
        $data->file = $data->locale . '.json';

        unset($input['_token']);
        unset($input['language']);
        unset($input['rtl']);

        if ($input['locale'] != $oldLocale) {
            if ($id == 1) {
                return __("You don't have access to change this locale");
            }
            if (file_exists(resource_path("lang") . '/' .$oldFile) && !empty($oldFile)) {
                unlink(resource_path("lang") . '/' . $oldFile);
            }
            if(file_exists(resource_path("lang") . '/base_' . $data->locale . '.json')){
                copy(resource_path("lang") . '/base_' . $data->locale . '.json', resource_path("lang") . '/' . $data->locale . '.json');
            }else{
                $fields = $this->getTranslationKeys();
                sort($fields, SORT_STRING | SORT_FLAG_CASE);
                foreach ($fields as $field) {
                    $translations[$field] = "";
                }
                $mydata = json_encode($translations);
                file_put_contents(resource_path("lang") . '/' . $data->file, $mydata);
            }
        }else{
            if(file_exists(resource_path("lang") . '/' . $oldFile)){
                $data_results = file_get_contents(resource_path("lang") . '/' . $oldFile);
                $langJson = json_decode($data_results, true);
            }else if(file_exists(resource_path("lang") . '/base_' . $data->locale . '.json')){
                $data_results = file_get_contents(resource_path("lang") . '/base_' . $data->locale . '.json');
                $langJson = json_decode($data_results, true);
            }else{
                $fields = $this->getTranslationKeys();
                $langJson = array_flip($fields);
            }

        foreach ($input['fields'] as $field) {
            $translations[$field["key"]] = (!empty($field["translation"]) ? $field["translation"] : "");
        }

        $lang = array_merge($langJson, $translations);
        ksort($lang, SORT_STRING | SORT_FLAG_CASE);

        $mydata = json_encode($lang);
        file_put_contents(resource_path("lang") . '/' . $data->file, $mydata);
        }        
        $data->update();

        if($oldLocale !== $data->locale) {
            $this->fixContentLocale($oldLocale, $data->locale);
        }

        // if (file_exists(public_path().'/assets/languages/'.$old_file) && !empty($old_file)) {
        //     unlink(public_path().'/assets/languages/'.$old_file);
        // }
        //--- Logic Section Ends

        //--- Redirect Section
        $msg = __('Data Updated Successfully.');
        return response()->json($msg);
        //--- Redirect Section Ends
    }

    public function status($id1, $id2)
    {
        $data = Language::findOrFail($id1);
        $data->is_default = $id2;
        $data->update();
        $data = Language::where('id', '!=', $id1)->update(['is_default' => 0]);
        $storeAdmin = Session::has('admstore') ? Session::get('admstore') : $this->storeSettings;
        $storeAdmin->lang_id = $id1;
        $storeAdmin->update();
        //--- Redirect Section
        $msg = __('Data Updated Successfully.');
        return response()->json($msg);
        //--- Redirect Section Ends
    }

    //*** GET Request Delete
    public function destroy($id)
    {
        if ($id == 1) {
            return __("You don't have access to remove this language");
        }
        $data = Language::findOrFail($id);
        $usedLangs = Generalsetting::where('lang_id', $id)->count();
        if ($usedLangs > 0) {
            return __("You can not remove default language of any store.");
        }
        $oldFile = $data->file;
        if (file_exists(resource_path("lang") . '/' .$oldFile) && !empty($oldFile)) {
            unlink(resource_path("lang") . '/' . $oldFile);
        }
        $data->delete();
        //--- Redirect Section
        $msg = __('Data Deleted Successfully.');
        return response()->json($msg);
        //--- Redirect Section Ends
    }

    /**
     * Get translation strings from frontend views
     *
     * @return array
     */
    private function getTranslationKeys()
    {
        // Traversal logic based and adapted from https://github.com/joedixon/laravel-translation

        $translationMethods = ['trans', '__'];
        $scanPaths = [implode(",", config("view.paths")), app_path("Http/Controllers"), app_path("Providers"), app_path("Traits")];
        $disk = new Filesystem;

        $temp = [];
        $results = [];

        $matchingPattern =
            '[^\w]' . // Must not start with any alphanum or _
            '(?<!->)' . // Must not start with ->
            '(' . implode('|', $translationMethods) . ')' . // Must start with one of the functions
            "\(" . // Match opening parentheses
            "[\'\"]" . // Match " or '
            '(' . // Start a new group to match:
            '.+' . // Must start with group
            ')' . // Close group
            "[\'\"]" . // Closing quote
            "[\),]";  // Close parentheses or new parameter

        $files = $disk->allFiles($scanPaths);

        foreach ($files as $file) {
            if (!strstr(strtolower($file), "admin")) {
                if (preg_match_all("/$matchingPattern/siU", $file->getContents(), $matches)) {
                    foreach ($matches[2] as $key) {
                        $temp[] = $key;
                    }
                }
            }
        }

        $results = array_unique($temp);
        return $results;
    }

    /**
     * Replace old locale key in ALL *_translations tables
     *
     * @param string $oldLocale - the previous content locale
     * @param string $newLocale - the new content locale
     * @return void
     */
    private function fixContentLocale($oldLocale, $newLocale)
    {
        $tables = [
            'attribute',
            'attribute_option',
            'category',
            'childcategory',
            'product',
            'subcategory',
        ];

        foreach ($tables as $table) {
            DB::table("{$table}_translations")
            ->where('locale', $oldLocale)
            ->update(['locale' => $newLocale]);
        }
    }
}
