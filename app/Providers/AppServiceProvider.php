<?php

namespace App\Providers;

use App\Repositories\Repository;
use App\Repositories\RepositoryInterface;
use App\Servicos\CadastrarServico;
use App\Servicos\EnviarEmailServico;
use App\UseCases\CadastrarInterface;
use App\UseCases\EnviarEmailInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(RepositoryInterface::class, Repository::class);

        $this->app->bind(CadastrarInterface::class, CadastrarServico::class);

        $this->app->bind(EnviarEmailInterface::class, EnviarEmailServico::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
