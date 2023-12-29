<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Image;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Size;
use App\Models\Customer;
use App\Models\Order;
use App\Models\User;
use App\Models\Order_detail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash; 


class AdminController extends Controller
{
    public function showAdminLogin()
    {
        return view('admin_view/login');
    }
    public function adminLogin(Request $request){
        $messages = [
            'email.required' => 'Vui lòng nhập địa chỉ email.',
            'email.email' => 'Địa chỉ email không hợp lệ.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
        ];
    
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], $messages);
    
        if (Auth::attempt($credentials)) {
            return redirect('/admin/dashboard')->with('success', 'Đăng nhập thành công.');
        } else {
            // Đăng nhập thất bại
            
            return back()->withErrors([
                'email' => 'Thông tin đăng nhập không chính xác',
            ])->withInput($request->only('email'));
        }   
    }
    public function dashboard(){
        $countProduct = count(Product::get());
        $countOrder1 = count(Order::where('Status',1)->get());
        $countOrder2 = count(Order::where('Status',0)->get());
        $countBrand = count(Brand::get());
        $countCustomer = count(Customer::get());
        $countUser = count(User::get());
        $sum = Order::get()->sum('Total');
        return view('admin_view/dashboard',compact('countBrand','countCustomer','countUser','countOrder1','countOrder2','sum','countProduct'));
    }
    public function showUser(){
        $users = User::get();
        return view('admin_view/admin_user',compact('users'));
    }
    public function showAddUser()
    {
        return view('admin_view/adduser');
    }
    public function addUser(Request $request){
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

        
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->level = $request->level;
        $user->save();
        return redirect()->route('show.user');
    }

    public function deleteUser($id)
    {
        // Tìm người dùng theo ID
        $user = User::find($id);
        $count = count(Order::where('user_id',$id)->get());

        if($count == 0) {
        $user->delete();}

        return redirect()->route('show.user');
    }
    
    public function editUser($id){
        $user = User::find($id);

        return view('admin_view/edituser', compact('user'));
    }
    public function updateUser(Request $request, $id){
        $user = User::find($id);
        $rules = [
            'name' => 'required|string', 
            'email' => 'required|email|unique:users,email,' . $user->id, // Loại trừ email hiện tại của người dùng
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
        $user->name = $request->name;
        $user->email = $request->email;
    
        // Kiểm tra xem người dùng đã nhập mật khẩu mới hay chưa
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->level = $request->level;
        // Lưu các trường cần cập nhật vào cơ sở dữ liệu
        $user->save();
        return redirect()->route('show.user');
    }
    public function showProduct()
    {
        $products = Product::get();
        $countProduct = count($products);
        $countAdminProduct = count(Product::where('ProductStatus',0)->get());        
    
        // Tạo một mảng để chứa thông tin sản phẩm và hình ảnh tương ứng
        $productsWithImages = [];
    
        // Duyệt qua danh sách sản phẩm
        foreach ($products as $product) {
            $totalQuantity = Size::where('product_id', $product->id)->sum('quantity');
            // Lấy hình ảnh của sản phẩm từ bảng "Image" dựa vào trường "product_id"
            $image = Image::where('product_id', $product->id)->pluck('url');
            $brand = Brand::where('id', $product->brand_id)->pluck('BrandName');
            $category = Category::where('id', $product->category_id)->pluck('CatName');
            // Thêm thông tin sản phẩm và hình ảnh vào mảng
            $productsWithImages[] = [
                'product' => $product,
                'total_quantity' => $totalQuantity,
                'image' => $image[0],
                'brand' => $brand[0],
                'category' => $category[0],
            ];
        }
        return view('admin_view/admin_prod', compact('productsWithImages','countProduct', 'countAdminProduct'));
    }
    public function showAddProduct(){
        $categories = Category::get();
        return view('admin_view/addprod',compact('categories'));
    }
    public function getBrands(Request $request) {
        $category_id = $request->input('category_id');
        // Lấy danh sách các thương hiệu dựa trên category_id
        $brands = Brand::where('category_id', $category_id)->get();
    
        return response()->json($brands);
    }
    public function addProduct(Request $request){

        $validatedData = $request->validate([
            'ProductName' => 'required',
            'Price' => 'required',
            'ProductDescription' => 'required',
            'img1' => 'required',
            'img2' => 'required',
        ], [
            'ProductName.required' => 'Vui lòng nhập tên sản phẩm',
            'Price.required' => 'Vui lòng nhập giá sản phẩm',
            'ProductDescription.required' => 'Vui lòng nhập mô tả sản phẩm',
            'img1.required' => 'Vui lòng chọn ảnh sản phẩm',
            'img2.required' => 'Vui lòng chọn ảnh sản phẩm',
        ]);
    
        $product = new Product;
        $product->brand_id = $request->brand_id;
        $product->category_id = $request->category_id;
        $product->ProductName = $request->ProductName;
        $product->Price = $request->Price;
        $product->ProductDescription = $request->ProductDescription;
        $product->ProductStatus = 0;
        $product->save();

        $img_link1 = new Image;
        $img1 = $request->img1;
        $storedPath1 = $img1->move('img', $img1->getClientOriginalName());
        $img_link1->URL= $storedPath1;
        $img_link1->product_id = $product->id;
        $img_link1->save();

        $img_link2 = new Image;
        $img2 = $request->img2;
        $storedPath2 = $img2->move('img', $img2->getClientOriginalName());
        $img_link2->URL= $storedPath2;
        $img_link2->product_id = $product->id;
        $img_link2->save();

    
        return redirect()->route('show.product');
    }
    public function productDetail($id){
        $product = Product::find($id);
        $category = Category::where('id', $product->category_id)->pluck('CatName');
        $brand = Brand::where('id', $product->brand_id)->pluck('BrandName');
        $images = Image::where('product_id', $product->id)->get();
        $sizes = Size::where('product_id', $product->id)->get();
        return view('admin_view/product_detail',compact('brand','category','product','images','sizes'));
    }
    public function showAdminProduct(){
        $products = Product::where('ProductStatus',0)->get();
        $countAdminProduct = count(Product::where('ProductStatus',0)->get()); 
    
        // Tạo một mảng để chứa thông tin sản phẩm và hình ảnh tương ứng
        $productsWithImages = [];
    
        // Duyệt qua danh sách sản phẩm
        foreach ($products as $product) {
            $totalQuantity = Size::where('product_id', $product->id)->sum('quantity');
            // Lấy hình ảnh của sản phẩm từ bảng "Image" dựa vào trường "product_id"
            $image = Image::where('product_id', $product->id)->pluck('url');
            $brand = Brand::where('id', $product->brand_id)->pluck('BrandName');
            $category = Category::where('id', $product->category_id)->pluck('CatName');
            // Thêm thông tin sản phẩm và hình ảnh vào mảng
            $productsWithImages[] = [
                'product' => $product,
                'total_quantity' => $totalQuantity,
                'image' => $image[0],
                'brand' => $brand[0],
                'category' => $category[0],
            ];
        }
        return view('admin_view/admin_prod_a1', compact('productsWithImages','countAdminProduct'));
    }
    public function editProduct($id){
        $product = Product::find($id);
        $categories = Category::get();
        $brands = Brand::where('category_id', $product->category_id)->get();
        return view('admin_view/editprod', compact('product','categories','brands'));
    }
    public function updateProduct(Request $request, $id){
        $product = Product::find($id);
        $validatedData = $request->validate([
            'ProductName' => 'required',
            'Price' => 'required',
            'ProductDescription' => 'required',
        ], [
            'ProductName.required' => 'Vui lòng nhập tên sản phẩm',
            'Price.required' => 'Vui lòng nhập giá sản phẩm',
            'ProductDescription.required' => 'Vui lòng nhập mô tả sản phẩm',
        ]);
        $product->brand_id = $request->brand_id;
        $product->category_id = $request->category_id;
        $product->ProductName = $request->ProductName;
        $product->Price = $request->Price;
        $product->ProductDescription = $request->ProductDescription;
        $product->ProductStatus = 0;
        $product->save();
        return redirect()->route('show.product');
    }
    public function approveProduct($id){
        $product = Product::find($id);
        $product->ProductStatus = 1;
        $product->save();
        return redirect()->route('show.product');
    }
    public function deleteProduct($id){
        $product = Product::find($id);
        $images = Image::where('product_id',$product->id);
        $sizes = Size::where('product_id',$product->id);
        $images->delete();
        $sizes->delete();
        $product->delete();
        return redirect()->route('show.product');
    }
    public function addSize(Request $request)
    {
        $validatedData = $request->validate([
            'SizeName' => 'required|string|max:255',
            'Quantity' => 'required|integer|min:1',
        ], [
            'SizeName.required' => 'Vui lòng nhập tên kích thước.',
            'SizeName.string' => 'Tên kích thước phải là chuỗi.',
            'SizeName.max' => 'Tên kích thước không được vượt quá :max ký tự.',
            'Quantity.required' => 'Vui lòng nhập số lượng.',
            'Quantity.integer' => 'Số lượng phải là số nguyên.',
            'Quantity.min' => 'Số lượng phải lớn hơn hoặc bằng :min.',
        ]);
    
        // Lưu kích thước vào cơ sở dữ liệu
        $size = new Size;
        $size->product_id = $request->product_id;
        $size->SizeName = $request->SizeName;
        $size->Quantity = $request->Quantity;
        $size->save();
        return back();
    }
    public function updateSize(Request $request,$id){
        $validatedData = $request->validate([
            'SizeName' => 'required|string|max:255',
            'Quantity' => 'required|integer|min:1',
        ], [
            'SizeName.required' => 'Vui lòng nhập tên kích thước.',
            'SizeName.string' => 'Tên kích thước phải là chuỗi.',
            'SizeName.max' => 'Tên kích thước không được vượt quá :max ký tự.',
            'Quantity.required' => 'Vui lòng nhập số lượng.',
            'Quantity.integer' => 'Số lượng phải là số nguyên.',
            'Quantity.min' => 'Số lượng phải lớn hơn hoặc bằng :min.',
        ]);
        $size = Size::find($id);
        $size->product_id = $request->product_id;
        $size->SizeName = $request->SizeName;
        $size->Quantity = $request->Quantity;
        $size->save();
        return back();
    }
    public function deleteSize($id)
    {
        
        $size = Size::find($id);


        
        $size->delete();

        return back();
    }
    public function addImage(Request $request)
    {
        $validatedData = $request->validate([
            'URL' => 'required|image|mimes:jpeg,png,jpg,gif',
        ], [
            'URL.required' => 'Hãy chọn một hình ảnh.',
            'URL.image' => 'Tệp phải là hình ảnh hợp lệ (jpeg, png, jpg, gif).',
            'URL.mimes' => 'Tệp phải có định dạng jpeg, png, jpg, gif.',
        ]);
        

        if ($request->hasFile('URL')) {
            $img = new Image;
            $URL = $request->URL;
            $storedPath1 = $URL->move('img', $URL->getClientOriginalName());
            $img->URL= $storedPath1;
            $img->product_id = $request->product_id;
            $img->save();
        }


        return redirect()->back();
    }
    public function updateImage(Request $request,$id)
    {
        $validatedData = $request->validate([
            'URL' => 'required|image|mimes:jpeg,png,jpg,gif',
        ], [
            'URL.required' => 'Hãy chọn một hình ảnh.',
            'URL.image' => 'Tệp phải là hình ảnh hợp lệ (jpeg, png, jpg, gif).',
            'URL.mimes' => 'Tệp phải có định dạng jpeg, png, jpg, gif.',
        ]);
        

        if ($request->hasFile('URL')) {
            $img = Image::find($id);
            $URL = $request->URL;
            $storedPath1 = $URL->move('img', $URL->getClientOriginalName());
            $img->URL= $storedPath1;
            $img->product_id = $request->product_id;
            $img->save();
        }


        return redirect()->back();
    }
    public function deleteImage($id)
    {
        
        $image = Image::find($id);
        $productId = $image->product_id; // Lấy product_id từ ảnh

    // Đếm số lượng ảnh của sản phẩm
        $imageCount = Image::where('product_id', $productId)->count();
        if($imageCount > 2){
            $image->delete();
        }

        return back();
    }
    public function showBrand(){
        $brands = Brand::get();
        $countBrand = count($brands);
        $countAdminBrand = count(Brand::where('BraStatus',0)->get());
        $brandWithCategory = [];
        $categories = Category::get();
        foreach ($brands as $brand) {
            
            $category = Category::where('id', $brand->category_id)->pluck('CatName');
           
            $brandWithCategory[] = [
                'brand' => $brand,
                'category' => $category[0],
            ];
        }

        return view('admin_view/brand', compact('brandWithCategory','categories','countAdminBrand','countBrand'));

    }
    public function addBrand(Request $request){
        $validatedData = $request->validate([
            'BrandName' => 'required',
        ], [
            'BrandName.required' => 'Hãy nhập tên thương hiệu.',
        ]);
        $brand = new Brand;
        $brand->BrandName = $request->BrandName;
        $brand->category_id = $request->category_id;
        $brand->BraStatus = 0;
        $brand->save();
        return back();
    }
    public function deleteBrand($id){
        $brand = Brand::find($id);
        $productCount = Product::where('brand_id', $id)->count();
        
        if($productCount == 0){
            $brand->delete();
        }

        return back();
    }
    public function editBrand($id){
        $brand = Brand::find($id);
        $categories = Category::get();
        return view('admin_view/editbrand', compact('brand','categories'));
    }
    public function updateBrand(Request $request,$id){
        $validatedData = $request->validate([
            'BrandName' => 'required',
        ], [
            'BrandName.required' => 'Hãy nhập tên thương hiệu.',
        ]);
        $brand = Brand::find($id);
        $brand->BrandName = $request->BrandName;
        $brand->category_id = $request->category_id;
        $brand->BraStatus = 0;
        $brand->save();
        return redirect()->route('show.brand');
    }
    public function showAdminBrand(){
        $brands = Brand::where('BraStatus',0)->get();
        $countAdminBrand = count(Brand::where('BraStatus',0)->get());
        $brandWithCategory = [];
        foreach ($brands as $brand) {
            
            $category = Category::where('id', $brand->category_id)->pluck('CatName');
           
            $brandWithCategory[] = [
                'brand' => $brand,
                'category' => $category[0],
            ];
        }

        return view('admin_view/brand_admin', compact('brandWithCategory','countAdminBrand'));

    }
    public function approveBrand($id){
        $brand = Brand::find($id);
        $brand->BraStatus = 1;
        $brand->save();
        return redirect()->route('show.brand');
    }

    public function showOrder(){
        $orders = Order::get();
        $orderWithUser = [];
        $countOrder1 = count(Order::where('Status',1)->get());
        $countOrder2 = count(Order::where('Status',0)->get());
        $countTotalOrder = count($orders);
        $sumTotal = $orders->sum('Total');
        foreach ($orders as $order) {
            
            $user = User::find($order->user_id); // Tìm user dựa trên user_id

            if ($user) { // Kiểm tra xem user có tồn tại hay không
                $orderWithUser[] = [
                    'order' => $order,
                    'user' => $user->name, // Truy cập thuộc tính 'name' của user
                ];
            } else {
                $orderWithUser[] = [
                    'order' => $order,
                    'user' => "",
                ];
            }
        }
        return view('admin_view/admin_order', compact('orderWithUser','sumTotal','countOrder2','countOrder1','countTotalOrder'));
        
    }
    public function showOrderDetail($id){
        $order = Order::find($id);
        $order_detail = Order_detail::where('order_id',$id)->get();
        return view('admin_view/order_detail', compact('order','order_detail'));
    }
    public function approveOrder($id){
        $order = Order::find($id);
        $order->Status = 1;
        $order->user_id = Auth::user()->id;
        $order->save();
        return redirect()->route('show.order');
    }
    public function deleteOrder($id){
        $order = Order::find($id);
        $order_detail = Order_detail::where('order_id',$id);
        $order_detail->delete();
        $order->delete();
        return redirect()->route('show.order');
    }

    public function showCustomer(){
        $customers = Customer::get();
        return view('admin_view/admin_customer',compact('customers'));
    }
    public function editCustomer($id){
        $customer = Customer::find($id);

        return view('admin_view/editcustomer', compact('customer'));
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
        return redirect()->route('show.customer');
    }
    public function deleteCustomer($id)
    {
        // Tìm người dùng theo ID
        $customer = Customer::find($id);
        $count = count(Order::where('customer_id',$id)->get());

        if($count == 0) {
        $customer->delete();}

        return redirect()->route('show.customer');
    }
    public function adminLogout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('show.admin.login');
    }
}
