<?php

namespace Kingga\LaravelWorkflowTimesheet;

use Kingga\LaravelWorkflowTimesheet\WorkflowJob;
use Kingga\LaravelWorkflowTimesheet\WorkflowTask;
use Kingga\LaravelWorkflowTimesheet\WorkflowWeek;
use Kingga\LaravelWorkflowTimesheet\WorkflowEntry;
use Kingga\LaravelWorkflowTimesheet\Policies\WorkflowJobPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider;
use Kingga\LaravelWorkflowTimesheet\Policies\WorkflowTaskPolicy;
use Kingga\LaravelWorkflowTimesheet\Policies\WorkflowWeekPolicy;
use Kingga\LaravelWorkflowTimesheet\Policies\WorkflowEntryPolicy;

class WorkflowTimesheetServiceProvider extends AuthServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        WorkflowWeek::class => Policies\WorkflowWeekPolicy::class,
        WorkflowEntry::class => Policies\WorkflowEntryPolicy::class,
        WorkflowJob::class => Policies\WorkflowJobPolicy::class,
        WorkflowTask::class => Policies\WorkflowTaskPolicy::class,
    ];

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/migrations');
        $this->registerPolicies();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
