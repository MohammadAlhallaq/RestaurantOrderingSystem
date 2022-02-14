<?php

namespace App\Traits;

use App\Models\AccountCurrency;
use App\Models\evaluation_model;
use App\Models\item;
use App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

trait AccountModelTrait
{

    public function scopeRestaurantDetails($query, $restaurant_id, $currency_id)
    {
        $query->with(['sub_category', 'category', 'address', 'reviews.source', 'minPrice' => function ($query) use ($currency_id) {
            $query->where('currency_id', $currency_id);
        }])
            ->where('account_type_id', 2)
            ->where('approved', 1)
            ->where('status_id', 1)
            ->where('id', $restaurant_id);
    }

    public function ScopeAllRestaurants($query, $page, $limit)
    {
        $query->with('sub_category')
            ->where('account_type_id', 2)
            ->where('approved', 1)
            ->where('status_id', 1)
            ->when(request('res_name'), function ($q) {
                return $q->where('account_name', 'like', '%' . request('res_name') . '%');
            })
            ->skip(($page - 1) * $limit)
            ->take($limit);
    }

    public function ScopeRestaurantsByCoordinates($query, $currency_id, $sub_category, $category, $lng, $lat, $radius)
    {
        $query->with('sub_category')
            ->join('address', 'account.id', '=', 'address.account_id')
            ->select('account.*',
                DB::raw("( 6371 * acos( cos( radians($lat) ) *
                       cos( radians( latitude ) )
                       * cos( radians( longitude ) - radians($lng)
                       ) + sin( radians($lat) ) *
                       sin( radians( latitude ) ) )
                     ) AS distance"))
            ->having("distance", "<", $radius)
            ->when(request('res_name'), function ($q) {
                $q->where('account_name', 'like', '%' . request('res_name') . '%');
            })
            ->when(request('category'), function ($q) use ($category) {
                $q->where('resturant_category_id', $category);
            })
            ->when(request('sub_category'), function ($q) use ($sub_category) {
                $q->whereRelation('sub_category', function ($q) use ($sub_category) {
                    $q->whereIn('sub_category.id', $sub_category);
                });
            })
            ->when(request('order_by') == 1, function ($q) {
                $q->withCount('orders')
                    ->orderBy('orders_count', 'desc');
            })->when(request('order_by') == 3, function ($q) {
                $q->orderBy('created_at', 'desc');
            })->when(request('order_by') == 4, function ($q) {
                $q->orderBy('account_name', 'asc');
            })
            ->when(request('order_by') == 5, function ($q) use ($currency_id) {
                $q->leftJoin('min_price_currency as min', 'account.id', '=', 'min.account_id')
                    ->where('currency_id', $currency_id)
                    ->orderBy('min_price', 'asc');
            })
            ->when(request('order_by') == 2, function ($q) {
                $q->withAggregate('rates as rate', 'round((avg(taste_value)+avg(clean_value)+avg(delivery_value))/3, 2)')
                    ->orderBy('rate', 'desc');
            })
            ->where('account_type_id', 2)
            ->where('approved', 1)
            ->where('status_id', 1);
    }

    public function ScopeRestaurantMenuDetails($query, $restaurant_id, $currency_id, $currency)
    {
        $query
            ->where('account_type_id', 2)
            ->where('id', $restaurant_id)
            ->where('approved', 1)
            ->where('status_id', 1)
            ->with([
                'sub_category_pivot.sub_category_name',
                'sub_category_pivot.items.sub_category',
                'sub_category_pivot.items.status',
                'sub_category_pivot.items' => function ($query) use ($restaurant_id) {
                    $query->where('restaurant_id', $restaurant_id);
                },
                'address.area.city',
                'minPrice' => function ($query) use ($currency_id) {
                    return $query->where('currency_id', $currency_id);
                },
                'sub_category_pivot.items.price' => function ($query) use ($currency) {
                    return $query->where('acc_currency_id', $currency->id);
                }]);
    }

    public function get_working_hours(): string
    {
        $time = Carbon::parse($this->opening_time)->format('G:i');
        $time .= ' - ';
        $time .= Carbon::parse($this->closing_time)->format('G:i');
        return $time;
    }

    public function text_rate($language_id): array
    {
        $rate = $this->restaurant_rate();
        $text['taste_rate'] = rate_converter($rate->taste_rate, $language_id);
        $text['clean_rate'] = rate_converter($rate->clean_rate, $language_id);
        $text['delivery_rate'] = rate_converter($rate->delivery_rate, $language_id);
        return $text;
    }

    public function restaurant_rate(): evaluation_model
    {
        return evaluation_model::where('restaurant_id', $this->id)
            ->selectRaw('cast(sum(taste_value)/count(id) as decimal(10,1)) as taste_rate,
            cast(sum(clean_value)/count(id) as decimal(10,1)) as clean_rate,
            cast(sum(delivery_value)/count(id) as decimal(10,1)) as delivery_rate')
            ->first();
    }

    public function total_rate(): string
    {
        $rate = $this->restaurant_rate();
        return "" . round(($rate->taste_rate + $rate->clean_rate + $rate->delivery_rate) / 3, 1);
    }

    public function best_seller($limit, $currency_id): Collection
    {
        $item_ids = DB::table('orders')
            ->join('order_items', 'order_items.order_id', '=', 'orders.id')
            ->where('orders.restaurant_id', $this->id)
            ->select(DB::raw('sum(item_count) as num, item_id'))
            ->groupBy('item_id')->orderBy('num', 'desc')
            ->take($limit)->pluck('item_id');

        if ($item_ids) {
            $currency = AccountCurrency::where('currency_id', $currency_id)->where('account_id', $this->id)->first();
            if (!$currency) {
                $currency = AccountCurrency::where('account_id', $this->id)->first();
            }
            return item::with(['price' => function ($query) use ($currency) {
                return $query->where('acc_currency_id', $currency->id);
            }])->whereIn('id', $item_ids)->get();
        }
    }

    public function adminNotifications()
    {
        $query = Notification::query()
            ->join('account', 'notifications.notifiable', '=', 'account.id')
            ->where('notifiable_type', 'restaurant')
            ->select('account.id', 'account.account_name', 'account.logo_path', 'notifications.data', 'notifications.type', 'notifications.created_at')
            ->orderBy('notifications.id', 'desc')->get();
        return $query;
    }

    public function restaurantNotifications()
    {
        $query = Notification::query()
            ->join('customers', 'notifications.notifiable', '=', 'customers.id')
            ->where('notified', auth()->id())
            ->where('notifiable_type', 'customer')
            ->select('customers.username', 'notifications.data', 'notifications.type', 'notifications.created_at')
            ->orderBy('notifications.id', 'desc')->get();
        return $query;

    }

    public function logoPath()
    {
        return asset('/restaurants/logo/' . $this->id . '/' . $this->logo_path);
    }

}
