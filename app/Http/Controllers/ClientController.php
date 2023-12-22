<?php

namespace App\Http\Controllers;
use Mail;
use App\Mail\SendMail;
use App\Mail\NotifyMail;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Image;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Size;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Order_detail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash; 
class ClientController extends Controller
{
    public function showCustomerLogin()
        {
            return view('client_view/login');
        }
    
    public function CustomerLogin(Request $request) {
        $messages = [
            'email.required' => 'Vui lòng nhập địa chỉ email.',
            'email.email' => 'Địa chỉ email không hợp lệ.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
        ];
    
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], $messages);
        
        if (Auth::guard('customer')->attempt($credentials)) {

    
            if ($request->session()->has('redirect_back')) {
                $redirectRoute = $request->session()->get('redirect_back');
                $request->session()->forget('redirect_back');
                return redirect($redirectRoute)->with('success', 'Đăng nhập thành công.');
            }
    
            return redirect('/')->with('success', 'Đăng nhập thành công.');
        } else {
            // Đăng nhập thất bại
            return back()->withErrors([
                'email' => 'Thông tin đăng nhập không chính xác',
            ])->withInput($request->only('email'));
        }
    }
    
    
    public function CustomerLogout(Request $request)
    {
        Auth::guard('customer')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
    public function CustomerInfo(){
        $customer = Auth::guard('customer')->user();
        
        $bought = Order::where('customer_id',$customer->id)->get();
        return view('client_view/customer-info',compact('customer','bought'));
    }
    public function showCustomerRegister (){
        return view('client_view/register');
    }
    public function CustomerRegister(Request $request)
    {
        $messages = [
            'name.required' => 'Vui lòng nhập tên.',
            'email.required' => 'Vui lòng nhập địa chỉ email.',
            'email.email' => 'Địa chỉ email không hợp lệ.',
            'email.unique' => 'Địa chỉ email đã tồn tại.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp.',
        ];

        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:customers',
            'password' => 'required|min:6|confirmed'
        ], $messages);

        // Tạo mới một khách hàng
        $customer = new Customer;
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->password = Hash::make($request->password);
        $customer->save();

        // Redirect về trang chủ hoặc trang đăng nhập
        return redirect()->route('customer.login')->with('success', 'Đăng ký thành công! Hãy đăng nhập để tiếp tục.');
    }
    public function editCustomer($id){
        $customer = Customer::find($id);
        return view('client_view/change_info',compact('customer'));
    }
    public function updateCustomer(Request $request, $id){
        $customer = Customer::find($id);
        $rules = [
            'name' => 'required|string', 
            'email' => 'required|email|unique:customers,email,' . $customer->id, // Loại trừ email hiện tại của người dùng
        ];
    
        // Kiểm tra xem người dùng có nhập mật khẩu mới không
        if ($request->filled('password')) {
            $rules['password'] = 'required|min:8|confirmed';
        }
    
        // Xác thực dữ liệu đầu vào
        $request->validate($rules, [
            'name.required' => 'Vui lòng nhập tên.',
            'email.required' => 'Vui lòng nhập địa chỉ email.',
            'email.email' => 'Địa chỉ email không hợp lệ.',
            'email.unique' => 'Địa chỉ email đã tồn tại.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp.',
        ]);
    
        // Cập nhật thông tin người dùng (chỉ cập nhật các trường cần thiết)
        $customer->name = $request->name;
        $customer->email = $request->email;
    
        // Kiểm tra xem người dùng đã nhập mật khẩu mới hay chưa
        if ($request->filled('password')) {
            $customer->password = Hash::make($request->password);
        }

        // Lưu các trường cần cập nhật vào cơ sở dữ liệu
        $customer->save();
        return redirect()->route('customer.info');
    }
    public function contact(){
        return view('client_view/contact');
    }
    public function static(){
        return view('client_view/static01');
    }
    public function HomePage()
    {
    
        // Lấy danh sách sản phẩm từ bảng "Product"
        $sneakers = Product::where('category_id', 1)
                            ->whereHas('sizes', function ($query) {
                                $query->where('Quantity', '>', 0);
                            })      
                          ->where('ProductStatus', 1)
                          ->inRandomOrder()
                          ->take(8)
                          ->get();
    
        // Tạo một mảng để chứa thông tin sản phẩm và hình ảnh tương ứng
        $sneakersWithImages = [];
    
        // Duyệt qua danh sách sản phẩm
        foreach ($sneakers as $sneaker) {
            // Lấy hình ảnh của sản phẩm từ bảng "Image" dựa vào trường "product_id"
            $images1 = Image::where('product_id', $sneaker->id)->take(2)->pluck('url');
            $size1 = Size::where('product_id', $sneaker->id)->pluck('SizeName')->first();
            // Thêm thông tin sản phẩm và hình ảnh vào mảng
            $sneakersWithImages[] = [
                'sneaker' => $sneaker,
                'image1' => $images1[0],
                'image2' => $images1[1],
                'size' => $size1,
            ];
        }

        $slides = Product::where('category_id', 2)
        ->whereHas('sizes', function ($query) {
            $query->where('Quantity', '>', 0);
        })    
        ->where('ProductStatus', 1)
        ->inRandomOrder()
        ->take(8)
        ->get();
        $slidesWithImages = [];


        foreach ($slides as $slide) {

            $images2 = Image::where('product_id', $slide->id)->take(2)->pluck('url');
            $size2 = Size::where('product_id', $slide->id)->pluck('SizeName')->first();
            $slidesWithImages[] = [
            'slide' => $slide,
            'image1' => $images2[0],
            'image2' => $images2[1],
            'size' => $size2,
            ];
        }
        $bags = Product::where('category_id', 3)
        ->whereHas('sizes', function ($query) {
            $query->where('Quantity', '>', 0);
        })    
        ->where('ProductStatus', 1)
        ->inRandomOrder()
        ->take(8)
        ->get();
        $bagsWithImages = [];


        foreach ($bags as $bag) {

            $images3 = Image::where('product_id', $bag->id)->take(2)->pluck('url');
            $size3 = Size::where('product_id', $bag->id)->pluck('SizeName')->first();
            $bagsWithImages[] = [
            'bag' => $bag,
            'image1' => $images3[0],
            'image2' => $images3[1],
            'size' => $size3,
            ];
        }
        // Trả về view "homepage" và truyền mảng chứa thông tin sản phẩm và hình ảnh
        return view('client_view/homepage', compact('sneakersWithImages','slidesWithImages','bagsWithImages'));
    }
    public function Category(Request $request){
        $category = Category::where('id',$request->query('category'))->first(); // Truy vấn để lấy thông tin của loại
        $brands = Brand::where('category_id', $request->query('category'))->where('BraStatus', 1)->get();
        $products = Product::where('category_id', $request->query('category'))
        ->whereHas('sizes', function ($query) {
            $query->where('Quantity', '>', 0);
        })    
        ->where('ProductStatus', 1)
        ->get();
        $productsWithImages = [];


        foreach ($products as $product) {

            $images = Image::where('product_id', $product->id)->take(2)->pluck('url');
            $size = Size::where('product_id', $product->id)->pluck('SizeName')->first();;
            $productsWithImages[] = [
            'product' => $product,
            'image1' => $images[0],
            'image2' => $images[1],
            'size'=>$size,
            ];
        }
        return view('client_view/product_category', compact('productsWithImages','brands','category'));
    }
    public function filterProducts(Request $request)
    {
        $selectedBrands = $request->input('brands', []);
        $priceRanges = $request->input('priceRanges', []);
        $category = $request->query('category');

        $query = Product::query();

        // Trường hợp 1: Áp dụng bộ lọc chỉ theo thương hiệu
        if (!empty($selectedBrands) && empty($priceRanges)) {
            $query->whereIn('brand_id', $selectedBrands);
        }

        // Trường hợp 2: Áp dụng bộ lọc chỉ theo khoảng giá
        if (empty($selectedBrands) && !empty($priceRanges)) {
            foreach ($priceRanges as $priceRange) {
            if ($priceRange === 'under-1000000') {
                $query->orWhere('price', '<', 1000000);
            } elseif ($priceRange === '1000000-2000000') {
                $query->orWhereBetween('price', [1000000, 2000000]);
            } elseif ($priceRange === '2000000-3000000') {
                $query->orWhereBetween('price', [2000000, 3000000]);
            } elseif ($priceRange === '3000000-5000000') {
                $query->orWhereBetween('price', [3000000, 5000000]);
            } elseif ($priceRange === 'over-5000000') {
                $query->orWhere('price', '>', 5000000);
            }
            $query->where('category_id', $category);
        }
        if ($category !== null) {
            
            $query->where('category_id', $category);
        }
        }

        // Trường hợp 3: Áp dụng bộ lọc cả theo thương hiệu và khoảng giá
        if (!empty($selectedBrands) && !empty($priceRanges)) {
            $query->whereIn('brand_id', $selectedBrands);

            $query->where(function ($query) use ($priceRanges) {
                foreach ($priceRanges as $priceRange) {
                    if ($priceRange === 'under-1000000') {
                        $query->orWhere('price', '<', 1000000);
                    } elseif ($priceRange === '1000000-2000000') {
                        $query->orWhereBetween('price', [1000000, 2000000]);
                    } elseif ($priceRange === '2000000-3000000') {
                        $query->orWhereBetween('price', [2000000, 3000000]);
                    } elseif ($priceRange === '3000000-5000000') {
                        $query->orWhereBetween('price', [3000000, 5000000]);
                    } elseif ($priceRange === 'over-5000000') {
                        $query->orWhere('price', '>', 5000000);
                    }
                }
            });
        }

        // Trường hợp 4: Không áp dụng bộ lọc thương hiệu và giá, chỉ lọc theo category
        if (empty($selectedBrands) && empty($priceRanges)) {
            $query->where('category_id', $category);
        }
        $query->whereHas('sizes', function ($query) {
            $query->where('Quantity', '>', 0);
        }, '>', 0);
        // Lấy danh sách sản phẩm sau khi lọc
        $filteredProducts = $query->get();

        // Chuẩn bị dữ liệu cho phản hồi JSON kèm hình ảnh sản phẩm
        $productsWithImages = [];
        foreach ($filteredProducts as $product) {
            $images = Image::where('product_id', $product->id)
                            ->take(2)
                            ->pluck('url');
            $size = Size::where('product_id', $product->id)->pluck('SizeName')->first();
            $productData = [
                'product' => $product,
                'image1' => $images[0],
                'image2' => $images[1],
                'size' => $size,
            ];
            $productsWithImages[] = $productData;
        }

        // Trả về danh sách sản phẩm đã lọc dưới dạng phản hồi JSON
        return response()->json(['products' => $productsWithImages]);
    }

    public function detailProduct(Request $request){
        $product = Product::where('id', $request->query('id'))
        ->where('ProductStatus', 1)
        ->first();

        $images = Image::where('product_id', $product->id)->pluck('url');
        $sizes = Size::where('product_id', $product->id)
        ->where('Quantity', '>', 0) // Chỉ lấy kích thước có Quantity > 0
        ->get();
        $otherProducts =Product::where('brand_id', $product->brand_id)
        ->where('ProductStatus', 1)
        ->whereHas('sizes', function ($query) {
            $query->where('Quantity', '>', 0);
        })
        ->inRandomOrder()
        ->take(8)
        ->get();
        $productsWithImages = [];
        foreach ($otherProducts as $otherProduct) {
            $images1 = Image::where('product_id', $otherProduct->id)
                            ->take(2)
                            ->pluck('url');
            $size = Size::where('product_id', $otherProduct->id)->pluck('SizeName')->first();
            $productData = [
                'size' => $size, 
                'otherProduct' => $otherProduct,
                'image1' => $images1[0],
                'image2' => $images1[1],
            ];
            $productsWithImages[] = $productData;
        }

        return view('client_view/product_detail', compact('product','images','sizes','productsWithImages'));
        }
        

        public function search(Request $request){
            $keyword = $request->input('keyword');
            $products = Product::where('ProductName', 'like', '%' . $keyword . '%')
                                ->where('ProductStatus', 1)
                                ->whereHas('sizes', function ($query) {
                                    $query->where('Quantity', '>', 0);
                                })
                                ->get();
            $count = count($products);
            $productsWithImages = [];
            foreach ($products as $product) {
                $images = Image::where('product_id', $product->id)
                                ->take(2)
                                ->pluck('url');
                $size = Size::where('product_id', $product->id)->pluck('SizeName')->first();
                $productData = [
                    'size' => $size,
                    'product' => $product,
                    'image1' => $images[0],
                    'image2' => $images[1],
                ];
                $productsWithImages[] = $productData;
            }
            return view('client_view/search', compact('productsWithImages','count','keyword'));
        }
        public function deleteOrder($id){
            $order = Order::find($id);
            $order_detail = Order_detail::where('order_id',$id);
            $order_detail->delete();
            $order->delete();
            return redirect()->back();
        }
        public function showCart(){
            
            $cartItems = \Cart::getContent();
            $otherProducts =Product::where('ProductStatus', 1)
            ->whereHas('sizes', function ($query) {
                $query->where('Quantity', '>', 0);
            })
            ->inRandomOrder()
            ->take(8)
            ->get();
            $productsWithImages = [];
            foreach ($otherProducts as $otherProduct) {
                $images1 = Image::where('product_id', $otherProduct->id)
                                ->take(2)
                                ->pluck('url');
                $size = Size::where('product_id', $otherProduct->id)->pluck('SizeName')->first();
                $productData = [
                    'size' => $size, 
                    'otherProduct' => $otherProduct,
                    'image1' => $images1[0],
                    'image2' => $images1[1],
                ];
                $productsWithImages[] = $productData;
            }
            return view('client_view/cart',compact('cartItems','productsWithImages'));
        }
        public function addToCart(Request $request){

            \Cart::add([
                'id' => $request->id,
                'name' => $request->ProductName,
                'price' => $request->Price,
                'quantity' => $request->quantity,
                'attributes' => [
                    'url' => $request->URL,
                    'size' => $request->size,
                ],
            ]);
            session()->flash('success', 'Thêm vào giỏ hàng thành công');
            return redirect()->route('show.cart');
        }
        public function removeFromCart($id)
        {
            \Cart::remove($id);
            return redirect()->route('show.cart')->with('success', 'Sản phẩm đã được xóa khỏi giỏ hàng.');
        }
        public function changeQuantity(Request $request)
        {
            $itemId = $request->item_id;
            $action = $request->action;

            // Lấy mục cần thay đổi số lượng từ giỏ hàng
            $cartItem = \Cart::get($itemId);

            if ($cartItem) {
                $currentQuantity = $cartItem->quantity;


                if ($action === 'add') {
                    $newQuantity = $currentQuantity + 1;
                } elseif ($action === 'drop' && $currentQuantity > 1) {
                    $newQuantity = $currentQuantity - 1;
                } else {
                    \Cart::remove($itemId);
                    return redirect()->route('show.cart');
                }


                \Cart::remove($itemId);


                \Cart::add([
                    'id' => $cartItem->id,
                    'name' => $cartItem->name,
                    'price' => $cartItem->price,
                    'quantity' => $newQuantity,
                    'attributes' => [
                        'url' => $cartItem->attributes->url,
                        'size' => $cartItem->attributes->size,
                    ],
                ]);
            }

            return redirect()->route('show.cart');
        }
        public function showThanhtoan(){
            $cartItems = \Cart::getContent();
            $customer = Auth::guard('customer')->user();
            return view('client_view/thanhtoan',compact('cartItems','customer'));
        }
        public function thanhtoan(Request $request){
            $messages = [
                'fullname.required' => 'Vui lòng nhập họ tên.',
                'address.required' => 'Vui lòng nhập địa chỉ.',
                'phone.required' => 'Vui lòng nhập số điện thoại.',
                'phone.max' => 'Số điện thoại không được vượt quá :10 ký tự.',
                'email.required' => 'Vui lòng nhập địa chỉ email.',
                'email.email' => 'Địa chỉ email không hợp lệ.',
            ];
            
            $validatedData = $request->validate([
                'fullname' => 'required|string|max:255',
                'address' => 'required|string|max:255',
                'phone' => 'required|string|max:10',
                'email' => 'required|email|max:255',
            ], $messages);
            $thanhtoan = new order;
            $thanhtoan->fullname = $request->fullname;
            $thanhtoan->address = $request->address;
            $thanhtoan->phone = $request->phone;
            $thanhtoan->email = $request->email;
            $thanhtoan->Total = $request->Total;
            $thanhtoan->customer_id = $request->customer_id;
            $thanhtoan->status = 0;
            $thanhtoan->save();
    
            $cartItems = \Cart::getContent();
            foreach($cartItems as $item){
                $oder_detail = new order_detail;
                $oder_detail->order_id = $thanhtoan->id;
                $oder_detail->quantity = $item->quantity;
                $oder_detail->ProductName = $item->name;
                $oder_detail->Product_id = $item->id;
                $oder_detail->price = $item->price;
                $oder_detail->SizeName = $item->attributes->size;
                $oder_detail->save();
                
                $quantity_to_subtract = $item->quantity;

                $size = Size::where('product_id', $item->id)
                    ->where('SizeName', $item->attributes->size)
                    ->first();

                if ($size) {
                    $new_quantity = max($size->Quantity - $quantity_to_subtract, 0);
                    $size->Quantity = $new_quantity;
                    $size->save();
                }
            }
            Mail::to($request->email)->send(new SendMail());
            \Cart::clear();
            return redirect()->route('customer.info');
    
    
        }
        public function buynow(Request $request){
            \Cart::clear();
            \Cart::add([
                'id' => $request->id,
                'name' => $request->ProductName,
                'price' => $request->Price,
                'quantity' => $request->quantity,
                'attributes' => [
                    'url' => $request->URL,
                    'size' => $request->size,
                ],
            ]);

            return redirect()->route('show.thanhtoan');
        }
}
