<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\UserRepository;
use App\Repositories\Interfaces\BatchRepositoryInterface;
use App\Repositories\BatchRepository;
use App\Repositories\Interfaces\BoardRepositoryInterface;
use App\Repositories\BoardRepository;
use App\Repositories\Interfaces\InquiryRepositoryInterface;
use App\Repositories\InquiryRepository;
use App\Repositories\Interfaces\ChapterRepositoryInterface;
use App\Repositories\ChapterRepository;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use App\Repositories\CourseRepository;
use App\Repositories\Interfaces\FeeRepositoryInterface;
use App\Repositories\FeeRepository;
use App\Repositories\Interfaces\FeeTypeRepositoryInterface;
use App\Repositories\FeeTypeRepository;
use App\Repositories\Interfaces\FeeStructureRepositoryInterface;
use App\Repositories\FeeStructureRepository;
use App\Repositories\Interfaces\FeeCategoryRepositoryInterface;
use App\Repositories\FeeCategoryRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(BatchRepositoryInterface::class, BatchRepository::class);
        $this->app->bind(BoardRepositoryInterface::class, BoardRepository::class);
        $this->app->bind(InquiryRepositoryInterface::class, InquiryRepository::class);
        $this->app->bind(ChapterRepositoryInterface::class, ChapterRepository::class);
        $this->app->bind(CourseRepositoryInterface::class, CourseRepository::class);
        $this->app->bind(FeeRepositoryInterface::class, FeeRepository::class);
        $this->app->bind(FeeTypeRepositoryInterface::class, FeeTypeRepository::class);
        $this->app->bind(FeeStructureRepositoryInterface::class, FeeStructureRepository::class);
        $this->app->bind(FeeCategoryRepositoryInterface::class, FeeCategoryRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
