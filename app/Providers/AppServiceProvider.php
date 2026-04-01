<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Product;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderItem;
use App\Models\StockAdjustment;
use App\Models\StockMovement;
use App\Models\Supplier;
use App\Models\User;
use App\Policies\CategoryPolicy;
use App\Policies\ProductPolicy;
use App\Policies\PurchaseOrderItemPolicy;
use App\Policies\PurchaseOrderPolicy;
use App\Policies\StockAdjustmentPolicy;
use App\Policies\StockMovementPolicy;
use App\Policies\SupplierPolicy;
use App\Policies\UserPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);
        Gate::policy(User::class,UserPolicy::class);
        Gate::policy(Category::class,CategoryPolicy::class);
        Gate::policy(Supplier::class,SupplierPolicy::class);
        Gate::policy(Product::class,ProductPolicy::class);
        Gate::policy(PurchaseOrder::class,PurchaseOrderPolicy::class);
        Gate::policy(PurchaseOrderItem::class,PurchaseOrderItemPolicy::class);
        Gate::policy(StockMovement::class,StockMovementPolicy::class);
        Gate::policy(StockAdjustment::class,StockAdjustmentPolicy::class);
        Gate::define('manage-users',function(User $user){
            return $user->role === 'admin';
        });
    }
}
