<?php

namespace App\Http\Controllers\Client;

use App\Events\OrderSuccessEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\OrderCheckoutRequest;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderPayment;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('client.pages.order.cart', ['cart' => $cart]);
    }

    public function checkout()
    {
        $user = Auth::user();
        $cart = session()->get('cart', []);
        return view('client.pages.order.checkout', ['user' => $user, 'cart' => $cart]);
    }

    public function success()
    {
        return view('client.pages.order.success');
    }

    public function add(Request $request)
    {
        $productId = $request->productId;
        $product = Product::find($productId);

        if (!$product) {
            return response()->json(['message' => 'Không tìm thấy sản phẩm!'], 404);
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            if ($cart[$productId]['quantity'] >= 5) {
                return response()->json(['message' => 'Sản phẩm đã đạt số lượng tối đa. Không thể thêm nữa.'], 400);
            }
            $cart[$productId]['quantity']++;
        } else {
            if (count($cart) >= 5) {
                return response()->json(['message' => 'Giỏ hàng đã đầy. Không thể thêm sản phẩm mới.'], 400);
            }
            $cart[$productId] = [
                'name' => $product->name,
                'image_url' => $product->image_url,
                'quantity' => 1,
                'price' => $product->price,
                'promotion' => $product->promotion ?? null
            ];
        }

        $totalProducts = count($cart);
        $totalPrice = array_sum(array_map(function ($item) {
            return ($item['promotion'] ?? $item['price']) * $item['quantity'];
        }, $cart));

        session()->put('cart', $cart);

        return response()->json([
            'message' => 'Thêm sản phẩm vào giỏ hàng thành công!',
            'totalProducts' => $totalProducts,
            'totalPrice' => number_format($totalPrice, 2, '.', ',')
        ]);
    }

    public function addProductItem(Request $request, string $productId)
    {
        $qty = $request->qty;

        if ($qty <= 0) {
            throw new Exception("Số lượng sản phẩm phải lớn hơn 0.");
        }

        $cart = session()->get('cart', []);

        if (array_key_exists($productId, $cart)) {
            if ($qty > 5) {
                return response()->json(['message' => 'Sản phẩm chỉ được mua tối đa 5 món.'], 400);
            }

            $cart[$productId]['quantity'] = $qty;

            $totalPrice = array_sum(array_map(function ($item) {
                return ($item['promotion'] ?? $item['price']) * $item['quantity'];
            }, $cart));

            session()->put('cart', $cart);

            return response()->json([
                'message' => 'Cập nhật sản phẩm trong giỏ hàng thành công',
                'totalPrice' => number_format($totalPrice, 2, '.', ',')
            ]);
        } else {
            throw new Exception("Không thể cập nhật sản phẩm trong giỏ hàng");
        }
    }

    public function getCartTotal()
    {
        $cart = session()->get('cart', []);

        $totalPrice = array_sum(array_map(function ($item) {
            return ($item['promotion'] ?? $item['price']) * $item['quantity'];
        }, $cart));

        return response()->json([
            'totalPriceFormatted' => number_format($totalPrice, 2, '.', ',')
        ]);
    }

    public function destroy()
    {
        session()->put('cart', []);
        return response()->json(['totalProducts' => 0, 'message' => 'Your Cart Is Empty']);
    }

    public function deleteItem(string $productId)
    {
        $cart = session()->get('cart', []);
        if (array_key_exists($productId, $cart)) {
            unset($cart[$productId]);
            session()->put('cart', $cart);
            $totalProducts = count($cart);
            $totalPrice = array_sum(array_map(function ($item) {
                return ($item['promotion'] ?? $item['price']) * $item['quantity'];
            }, $cart));

            return response()->json([
                'totalProducts' => $totalProducts,
                'totalPrice' => number_format($totalPrice, 2, '.', ','),
                'message' => 'Xóa sản phẩm thành công!'
            ]);
        } else {
            throw new Exception("Can not remove this!");
        }
    }

    public function placeOrder(OrderCheckoutRequest $request)
    {
        try {
            DB::beginTransaction();
            $order = new Order();
            $order->user_id = Auth::user()->id;
            $order->address = $request->address;
            $order->note = $request->note;
            $order->status = Order::PENDING;
            $order->total = $this->getTotalPrice();
            $order->save(); // Insert

            // Insert Order Item
            $cart = session()->get('cart', []);
            foreach ($cart as $productId => $item) {
                $orderItem = new OrderItem();
                $orderItem->order_id = $order->id;
                $orderItem->product_id = $productId;
                $orderItem->name = $item['name'];
                $orderItem->image = $item['image_url'] ?? null;
                $orderItem->quantity = $item['quantity'];
                $orderItem->price = $item['price'];
                $orderItem->promotion = $item['promotion'] ?? null;
                $orderItem->save(); // Insert
            }


            // Update phone for user
            $user = Auth::user();
            $user->phone = $request->phone;
            $user->address = $request->address;
            $user->save(); // Update

            if (in_array($request->payment_method, ['VNBANK', 'INTCARD'])) {
                // VNPay
                $vnp_TxnRef = $order->id; // Mã giao dịch thanh toán tham chiếu của merchant
                $vnp_Amount = $order->total * 23500; // Số tiền thanh toán
                $vnp_Locale = 'vn'; // Ngôn ngữ chuyển hướng thanh toán
                $vnp_BankCode = $request->payment_method; // Mã phương thức thanh toán
                $vnp_IpAddr = $_SERVER['REMOTE_ADDR']; // IP Khách hàng thanh toán

                date_default_timezone_set('Asia/Ho_Chi_Minh');
                $startTime = date("YmdHis");
                $expire = date('YmdHis', strtotime('+15 minutes', strtotime($startTime)));

                $inputData = array(
                    "vnp_Version" => "2.1.0",
                    "vnp_TmnCode" => config('myconfig.vnpay.TmnCode'),
                    "vnp_Amount" => $vnp_Amount * 100,
                    "vnp_Command" => "pay",
                    "vnp_CreateDate" => date('YmdHis'),
                    "vnp_CurrCode" => "VND",
                    "vnp_IpAddr" => $vnp_IpAddr,
                    "vnp_Locale" => $vnp_Locale,
                    "vnp_OrderInfo" => "Thanh toán GD:" . $vnp_TxnRef,
                    "vnp_OrderType" => "other",
                    "vnp_ReturnUrl" => config('myconfig.vnpay.Returnurl'),
                    "vnp_TxnRef" => $vnp_TxnRef,
                    "vnp_ExpireDate" => $expire,
                    "vnp_BankCode" => $vnp_BankCode
                );

                ksort($inputData);
                $query = "";
                $i = 0;
                $hashdata = "";
                foreach ($inputData as $key => $value) {
                    if ($i == 1) {
                        $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
                    } else {
                        $hashdata .= urlencode($key) . "=" . urlencode($value);
                        $i = 1;
                    }
                    $query .= urlencode($key) . "=" . urlencode($value) . '&';
                }

                $vnp_Url = config('myconfig.vnpay.Url') . "?" . $query;
                $vnpSecureHash = hash_hmac('sha512', $hashdata, config('myconfig.vnpay.HashSecret'));
                $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;

                DB::commit(); // Commit the transaction before redirecting
                return redirect()->to($vnp_Url);
            } else {
                // COD
                $orderPayment = new OrderPayment();
                $orderPayment->total = $order->total;
                $orderPayment->payment_method = 'COD';
                $orderPayment->status = 'success';
                $orderPayment->reason = null;
                $orderPayment->order_id = $order->id;
                $orderPayment->save();

                // Clear cart
                session()->put('cart', []);

                // Public event
                event(new OrderSuccessEvent($order));
                DB::commit();
            }
            return redirect()->route('home.cart.success')->with('success', 'Đặt hàng thành công');
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
    }

    private function getTotalPrice(): float
    {
        $totalPrice = 0;
        $cart = session()->get('cart', []);
        foreach ($cart as $item) {
            $totalPrice += ($item['promotion'] ?? $item['price']) * $item['quantity'];
        }
        return $totalPrice;
    }

    public function vnpayCallBack(Request $request)
    {
        $order = Order::find($request->vnp_TxnRef);
        if (!$order) {
            throw new Exception("Không tìm thấy đơn hàng");
        }

        $orderPayment = new OrderPayment();
        $orderPayment->total = $order->total;
        $orderPayment->payment_method = 'VNPay';
        $orderPayment->status = $request->vnp_ResponseCode === '00' ? 'success' : 'fail';
        $orderPayment->reason = OrderPayment::RESPONSE_CODE_VNPAY[$request->vnp_ResponseCode];
        $orderPayment->order_id = $order->id;

        $message = '';
        if ($orderPayment->status === 'success') {
            event(new OrderSuccessEvent($order));
            session()->put('cart', []);
            $message = 'Đặt hàng thành công';
        } else {
            $message = 'Đặt hàng thất bại';
        }
        $orderPayment->save();
        return redirect()->route('home.cart.success')->with('message', $message);
    }
}