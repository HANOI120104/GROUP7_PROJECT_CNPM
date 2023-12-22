<?php
namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
use Illuminate\Support\Facades\Hash;

class Customer extends Model implements Authenticatable
{
    use AuthenticatableTrait;
    protected $table = 'customers';
    // Phương thức implement từ Authenticatable
    public function getAuthIdentifierName()
    {
        return 'email'; // Thay 'email' bằng trường dùng để xác định định danh người dùng của bạn
    }

    // Phương thức implement từ Authenticatable
    public function getAuthIdentifier()
    {
        return $this->email; // Thay 'email' bằng trường dùng để xác định định danh người dùng của bạn
    }

    // Phương thức implement từ Authenticatable
    public function getAuthPassword()
    {
        return $this->password;
    }

    // Phương thức để mã hóa mật khẩu trước khi lưu vào cơ sở dữ liệu
    public function setAuthPassword($password)
    {
        $this->password = Hash::make($password);
    }
}
