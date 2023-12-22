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
}
