<?php

use App\Http\Controllers\Admin\AnalyticsController;
use App\Http\Controllers\Admin\ContentApprovalController;
use App\Http\Controllers\Admin\ExamSectionController;
use App\Http\Controllers\Admin\ExamSessionController;
use App\Http\Controllers\Admin\ExamTypeController;
use App\Http\Controllers\Admin\FutureEnhancementController;
use App\Http\Controllers\Admin\ListeningAssessmentController;
use App\Http\Controllers\Admin\ListeningAudioController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\QuestionBankController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\ReadingAssessmentController;
use App\Http\Controllers\Admin\ReadingPassageController;
use App\Http\Controllers\Admin\RolePermissionController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\ScoreHistoryController;
use App\Http\Controllers\Admin\SpeakingAssessmentController;
use App\Http\Controllers\Admin\SpeakingQuestionController;
use App\Http\Controllers\Admin\SystemSettingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\UserProgressController;
use App\Http\Controllers\Admin\UserSubscriptionController;
use App\Http\Controllers\Admin\WritingAssessmentController;
use App\Http\Controllers\Admin\WritingPromptController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Routes for the admin panel, grouped under the "admin" prefix and protected
| by Sanctum authentication with admin role middleware.
|
*/

Route::prefix('admin')->middleware([ 'auth', 'role:admin|super-admin' ])->group(function () {
    Route::group([ 'as' => 'admin.' ], function () {

        // Dashboard Routes
        Route::get('/', [ UserController::class, 'index' ])->name('dashboard.overview');
        Route::get('/dashboard-recent-activity', [ UserController::class, 'recentActivity' ])->name('dashboard.recent-activity');
        Route::get('/dashboard-system-status', [ SystemSettingController::class, 'systemStatus' ])->name('dashboard.system-status');

        Route::resource('roles', RolesController::class);
        Route::delete('roles-mass-destroy', [ RolesController::class, 'massDestroy' ])->name('roles.mass_destroy');

        // User Management Routes
        Route::prefix('users')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('users.index');
            Route::get('/trashed', [UserController::class, 'trashed'])->name('users.trashed');
            Route::get('/list', [UserController::class, 'listUsers'])->name('users.list');
            Route::post('/', [UserController::class, 'store'])->name('users.store');
            Route::get('/create', [UserController::class, 'create'])->name('users.create');
            // User search route for autocomplete (place BEFORE parameter routes)
            Route::get('/search', [UserController::class, 'searchUsers'])->name('users.search');
            Route::post('/search', [UserController::class, 'searchUsers'])->name('users.search.post');
            Route::get('/{user}', [UserController::class, 'show'])->whereNumber('user')->name('users.show');
            Route::get('/{user}/edit', [UserController::class, 'edit'])->whereNumber('user')->name('users.edit');
            Route::put('/{user}', [UserController::class, 'update'])->whereNumber('user')->name('users.update');
            Route::delete('/{user}/suspend', [UserController::class, 'suspend'])->whereNumber('user')->name('users.suspend');
            // Soft-delete
            Route::delete('/{user}', [UserController::class, 'destroy'])->whereNumber('user')->name('users.destroy');
            Route::patch('/{user}/restore', [UserController::class, 'restore'])->whereNumber('user')->middleware('role:admin')->name('users.restore');
            Route::delete('/{user}/force', [UserController::class, 'forceDestroy'])->whereNumber('user')->name('users.forceDestroy');
            Route::get('/{user}/profile', [UserController::class, 'profile'])->whereNumber('user')->name('users.profile');
        });

        // User Subscriptions Routes
        Route::prefix('subscriptions')->group(function () {
            Route::get('/', [ UserSubscriptionController::class, 'index' ])->name('subscriptions.index');
            Route::post('/plans', [ UserSubscriptionController::class, 'storePlan' ])->name('subscriptions.plans.store');
            Route::put('/plans/{plan}', [ UserSubscriptionController::class, 'updatePlan' ])->name('subscriptions.plans.update');
            Route::get('/{subscription}', [ UserSubscriptionController::class, 'show' ])->name('subscriptions.show');
            Route::post('/payment-issues', [ UserSubscriptionController::class, 'handlePaymentIssues' ])->name('subscriptions.payment-issues');
        });

        // User Progress Routes
        Route::prefix('progress')->group(function () {
            Route::get('/{user}', [ UserProgressController::class, 'index' ])->name('progress.index');
            Route::get('/{user}/reports', [ UserProgressController::class, 'reports' ])->name('progress.reports');
            Route::get('/{user}/performance', [ UserProgressController::class, 'performance' ])->name('progress.performance');
            Route::post('/{user}/study-plans', [ UserProgressController::class, 'assignStudyPlan' ])->name('progress.assign-study-plan');
        });

        // Roles & Permissions Routes
        Route::prefix('roles-permissions')->group(function () {
            Route::get('/', [ RolePermissionController::class, 'index' ])->name('roles.index');
            Route::post('/roles', [ RolePermissionController::class, 'storeRole' ])->name('roles.store');
            Route::put('/roles/{role}', [ RolePermissionController::class, 'updateRole' ])->name('roles.update');
            Route::post('/permissions', [ RolePermissionController::class, 'assignPermissions' ])->name('permissions.assign');
        });

        // Exam Management Routes
        Route::prefix('exam-types')->group(function () {
            Route::get('/', [ ExamTypeController::class, 'index' ])->name('exam-types.index');
            Route::get('/list', [ ExamTypeController::class, 'listExamTypes' ])->name('exam-types.list');
            Route::post('/', [ ExamTypeController::class, 'store' ])->name('exam-types.store');
            Route::put('/{examType}', [ ExamTypeController::class, 'update' ])->name('exam-types.update');
            Route::post('/{examType}/pricing', [ ExamTypeController::class, 'setPricing' ])->name('exam-types.pricing');
            Route::get('/{examType}', function(App\Models\ExamType $examType){
                return view('components.exam-type-form', ['examType' => $examType, 'isEdit' => true]);
            })->name('exam-types.edit-form');
        });

        Route::prefix('exam-sessions')->group(function () {
            Route::get('/active', [ ExamSessionController::class, 'activeSessions' ])->name('exam-sessions.active');
            Route::get('/completed', [ ExamSessionController::class, 'completedSessions' ])->name('exam-sessions.completed');
            Route::get('/monitor', [ ExamSessionController::class, 'monitor' ])->name('exam-sessions.monitor');
            Route::post('/{examSession}/manage', [ ExamSessionController::class, 'manage' ])->name('exam-sessions.manage');
        });

        Route::prefix('exam-sections')->group(function () {
            Route::get('/{examSection}', [ ExamSectionController::class, 'show' ])->name('exam-sections.show');
            Route::put('/{examSection}/settings', [ ExamSectionController::class, 'updateSettings' ])->name('exam-sections.settings');
            Route::get('/{examSection}/responses', [ ExamSectionController::class, 'responses' ])->name('exam-sections.responses');
        });

        // Content Management Routes
        Route::prefix('question-banks')->group(function () {
            Route::get('/', [ QuestionBankController::class, 'index' ])->name('question-banks.index');
            Route::post('/list', [ QuestionBankController::class, 'listQuestionBanks' ])->name('question-banks.list');
            Route::post('/', [ QuestionBankController::class, 'store' ])->name('question-banks.store');
            Route::put('/{questionBank}', [ QuestionBankController::class, 'update' ])->name('question-banks.update');
            Route::post('/{questionBank}/toggle', [ QuestionBankController::class, 'toggleActive' ])->name('question-banks.toggle');
            Route::post('/bulk-import', [ QuestionBankController::class, 'bulkImport' ])->name('question-banks.bulk-import');
            Route::get('/bulk-export', [ QuestionBankController::class, 'bulkExport' ])->name('question-banks.bulk-export');
        });

        Route::prefix('questions')->group(function () {
            Route::get('/', [ QuestionController::class, 'index' ])->name('questions.index');
            Route::post('/list', [ QuestionController::class, 'listQuestions' ])->name('questions.list');
            Route::post('/', [ QuestionController::class, 'store' ])->name('questions.store');
            Route::put('/{question}', [ QuestionController::class, 'update' ])->name('questions.update');
            Route::post('/{question}/approve', [ QuestionController::class, 'approve' ])->name('questions.approve');
            Route::post('/{question}/metadata', [ QuestionController::class, 'updateMetadata' ])->name('questions.metadata');
        });

        Route::prefix('reading-passages')->group(function () {
            Route::get('/', [ ReadingPassageController::class, 'index' ])->name('reading-passages.index');
            Route::get('/list', [ ReadingPassageController::class, 'listReadingPassages' ])->name('reading-passages.list');
            Route::post('/', [ ReadingPassageController::class, 'store' ])->name('reading-passages.store');
            Route::put('/{readingPassage}', [ ReadingPassageController::class, 'update' ])->name('reading-passages.update');
            Route::post('/{readingPassage}/categorize', [ ReadingPassageController::class, 'categorize' ])->name('reading-passages.categorize');
        });

        Route::prefix('listening-audios')->group(function () {
            Route::get('/', [ ListeningAudioController::class, 'index' ])->name('listening-audios.index');
            Route::get('/list', [ ListeningAudioController::class, 'listListeningAudios' ])->name('listening-audios.list');
            Route::post('/', [ ListeningAudioController::class, 'store' ])->name('listening-audios.store');
            Route::put('/{listeningAudio}', [ ListeningAudioController::class, 'update' ])->name('listening-audios.update');
            Route::post('/{listeningAudio}/transcript', [ ListeningAudioController::class, 'updateTranscript' ])->name('listening-audios.transcript');
        });

        Route::prefix('writing-prompts')->group(function () {
            Route::get('/', [ WritingPromptController::class, 'index' ])->name('writing-prompts.index');
            Route::get('/list', [ WritingPromptController::class, 'listWritingPrompts' ])->name('writing-prompts.list');
            Route::post('/', [ WritingPromptController::class, 'store' ])->name('writing-prompts.store');
            Route::put('/{writingPrompt}', [ WritingPromptController::class, 'update' ])->name('writing-prompts.update');
            Route::post('/{writingPrompt}/criteria', [ WritingPromptController::class, 'setCriteria' ])->name('writing-prompts.criteria');
        });

        Route::prefix('speaking-questions')->group(function () {
            Route::get('/', [ SpeakingQuestionController::class, 'index' ])->name('speaking-questions.index');
            Route::get('/list', [ SpeakingQuestionController::class, 'listSpeakingQuestions' ])->name('speaking-questions.list');
            Route::post('/', [ SpeakingQuestionController::class, 'store' ])->name('speaking-questions.store');
            Route::put('/{speakingQuestion}', [ SpeakingQuestionController::class, 'update' ])->name('speaking-questions.update');
            Route::post('/{speakingQuestion}/follow-ups', [ SpeakingQuestionController::class, 'updateFollowUps' ])->name('speaking-questions.follow-ups');
        });

        // Assessment Management Routes
        Route::prefix('reading-assessments')->group(function () {
            Route::get('/scores', [ ReadingAssessmentController::class, 'scores' ])->name('reading-assessments.scores');
            Route::put('/{examSection}/score', [ ReadingAssessmentController::class, 'updateScore' ])->name('reading-assessments.update-score');
            Route::get('/{examSection}/responses', [ ReadingAssessmentController::class, 'responses' ])->name('reading-assessments.responses');
            Route::post('/{examSection}/feedback', [ ReadingAssessmentController::class, 'generateFeedback' ])->name('reading-assessments.feedback');
        });

        Route::prefix('listening-assessments')->group(function () {
            Route::get('/scores', [ ListeningAssessmentController::class, 'scores' ])->name('listening-assessments.scores');
            Route::put('/{examSection}/score', [ ListeningAssessmentController::class, 'updateScore' ])->name('listening-assessments.update-score');
            Route::get('/{examSection}/responses', [ ListeningAssessmentController::class, 'responses' ])->name('listening-assessments.responses');
            Route::post('/{examSection}/feedback', [ ListeningAssessmentController::class, 'generateFeedback' ])->name('listening-assessments.feedback');
        });

        Route::prefix('writing-assessments')->group(function () {
            Route::get('/', [ WritingAssessmentController::class, 'index' ])->name('writing-assessments.index');
            Route::post('/assign-assessor', [ WritingAssessmentController::class, 'assignAssessor' ])->name('writing-assessments.assign-assessor');
            Route::get('/{writingAssessment}/ai', [ WritingAssessmentController::class, 'reviewAI' ])->name('writing-assessments.ai');
            Route::put('/{writingAssessment}/scores', [ WritingAssessmentController::class, 'updateScores' ])->name('writing-assessments.scores');
            Route::post('/{writingAssessment}/feedback', [ WritingAssessmentController::class, 'provideFeedback' ])->name('writing-assessments.feedback');
        });

        Route::prefix('speaking-assessments')->group(function () {
            Route::get('/', [ SpeakingAssessmentController::class, 'index' ])->name('speaking-assessments.index');
            Route::post('/assign-assessor', [ SpeakingAssessmentController::class, 'assignAssessor' ])->name('speaking-assessments.assign-assessor');
            Route::get('/{speakingAssessment}/ai', [ SpeakingAssessmentController::class, 'reviewAI' ])->name('speaking-assessments.ai');
            Route::put('/{speakingAssessment}/scores', [ SpeakingAssessmentController::class, 'updateScores' ])->name('speaking-assessments.scores');
            Route::post('/{speakingAssessment}/feedback', [ SpeakingAssessmentController::class, 'provideFeedback' ])->name('speaking-assessments.feedback');
        });

        Route::prefix('score-history')->group(function () {
            Route::get('/{user}', [ ScoreHistoryController::class, 'index' ])->name('score-history.index');
            Route::get('/{user}/trends', [ ScoreHistoryController::class, 'trends' ])->name('score-history.trends');
            Route::get('/{user}/export', [ ScoreHistoryController::class, 'export' ])->name('score-history.export');
        });

        // Analytics & Reporting Routes
        Route::prefix('analytics')->group(function () {
            Route::get('/users', [ AnalyticsController::class, 'userAnalytics' ])->name('analytics.users');
            Route::get('/exams', [ AnalyticsController::class, 'examAnalytics' ])->name('analytics.exams');
            Route::get('/system', [ AnalyticsController::class, 'systemAnalytics' ])->name('analytics.system');
            Route::get('/learning', [ AnalyticsController::class, 'learningAnalytics' ])->name('analytics.learning');
        });

        // Notification Management Routes
        Route::prefix('notifications')->group(function () {
            Route::get('/email/templates', [ NotificationController::class, 'emailTemplates' ])->name('notifications.email.templates');
            Route::get('/email/logs', [ NotificationController::class, 'emailLogs' ])->name('notifications.email.logs');
            Route::post('/email/settings', [ NotificationController::class, 'emailSettings' ])->name('notifications.email.settings');
            Route::post('/in-app', [ NotificationController::class, 'createInApp' ])->name('notifications.in-app.create');
            Route::get('/in-app/history', [ NotificationController::class, 'inAppHistory' ])->name('notifications.in-app.history');
            Route::get('/sms/templates', [ NotificationController::class, 'smsTemplates' ])->name('notifications.sms.templates');
            Route::post('/sms/settings', [ NotificationController::class, 'smsSettings' ])->name('notifications.sms.settings');
            Route::post('/push', [ NotificationController::class, 'pushNotifications' ])->name('notifications.push.create');
            Route::get('/push/logs', [ NotificationController::class, 'pushLogs' ])->name('notifications.push.logs');
        });

        // Payment Management Routes
        Route::prefix('payments')->group(function () {
            Route::get('/plans', [ PaymentController::class, 'plans' ])->name('payments.plans');
            Route::post('/plans', [ PaymentController::class, 'storePlan' ])->name('payments.plans.store');
            Route::put('/plans/{plan}', [ PaymentController::class, 'updatePlan' ])->name('payments.plans.update');
            Route::get('/history', [ PaymentController::class, 'history' ])->name('payments.history');
            Route::get('/refunds', [ PaymentController::class, 'refund' ])->name('payments.refunds');
            Route::post('/failures', [ PaymentController::class, 'handleFailures' ])->name('payments.failures');
            Route::post('/coupons', [ PaymentController::class, 'createCoupon' ])->name('payments.coupons.create');
            Route::get('/coupons/usage', [ PaymentController::class, 'couponUsage' ])->name('payments.coupons.usage');
        });

        // System Settings Routes
        Route::prefix('settings')->group(function () {
            Route::get('/general', [ SystemSettingController::class, 'general' ])->name('settings.general');
            Route::get('/security', [ SystemSettingController::class, 'security' ])->name('settings.security');
            Route::get('/integrations', [ SystemSettingController::class, 'integrations' ])->name('settings.integrations');
            Route::get('/exam-integrity', [ SystemSettingController::class, 'examIntegrity' ])->name('settings.exam-integrity');
            Route::get('/maintenance', [ SystemSettingController::class, 'maintenance' ])->name('settings.maintenance');
        });

        // Content Approval Workflow Routes
        Route::prefix('content-approval')->group(function () {
            Route::get('/pending', [ ContentApprovalController::class, 'pending' ])->name('content-approval.pending');
            Route::post('/approve', [ ContentApprovalController::class, 'approve' ])->name('content-approval.approve');
            Route::post('/reject', [ ContentApprovalController::class, 'reject' ])->name('content-approval.reject');
            Route::get('/approved', [ ContentApprovalController::class, 'approved' ])->name('content-approval.approved');
            Route::post('/revert', [ ContentApprovalController::class, 'revert' ])->name('content-approval.revert');
            Route::get('/rejected', [ ContentApprovalController::class, 'rejected' ])->name('content-approval.rejected');
        });

        // Test Management Routes
        Route::prefix('tests')->group(function () {
            Route::get('/', [ App\Http\Controllers\Admin\TestController::class, 'index' ])->name('tests.index');
            Route::get('/list', [ App\Http\Controllers\Admin\TestController::class, 'listTests' ])->name('tests.list');
            Route::get('/create', [ App\Http\Controllers\Admin\TestController::class, 'create' ])->name('tests.create');
            Route::post('/', [ App\Http\Controllers\Admin\TestController::class, 'store' ])->name('tests.store');
            Route::get('/{test}', [ App\Http\Controllers\Admin\TestController::class, 'show' ])->name('tests.show');
            Route::get('/{test}/edit', [ App\Http\Controllers\Admin\TestController::class, 'edit' ])->name('tests.edit');
            Route::put('/{test}', [ App\Http\Controllers\Admin\TestController::class, 'update' ])->name('tests.update');
            Route::delete('/{test}', [ App\Http\Controllers\Admin\TestController::class, 'destroy' ])->name('tests.destroy');
            Route::post('/{test}/toggle-status', [ App\Http\Controllers\Admin\TestController::class, 'toggleStatus' ])->name('tests.toggle-status');
        });

        // Test Section Management Routes
        Route::prefix('test-sections')->group(function () {
            Route::get('/{testSection}', [ App\Http\Controllers\Admin\TestSectionController::class, 'show' ])->name('test-sections.show');
            Route::get('/{testSection}/edit', [ App\Http\Controllers\Admin\TestSectionController::class, 'edit' ])->name('test-sections.edit');
            Route::put('/{testSection}', [ App\Http\Controllers\Admin\TestSectionController::class, 'update' ])->name('test-sections.update');
            Route::delete('/{testSection}', [ App\Http\Controllers\Admin\TestSectionController::class, 'destroy' ])->name('test-sections.destroy');
            Route::post('/{testSection}/reorder', [ App\Http\Controllers\Admin\TestSectionController::class, 'reorder' ])->name('test-sections.reorder');
            
            // Section Questions Management
            Route::prefix('{testSection}/questions')->group(function () {
                Route::get('/', [ App\Http\Controllers\Admin\QuestionController::class, 'index' ])->name('test-sections.questions.index');
                Route::get('/create', [ App\Http\Controllers\Admin\QuestionController::class, 'create' ])->name('test-sections.questions.create');
                Route::post('/', [ App\Http\Controllers\Admin\QuestionController::class, 'store' ])->name('test-sections.questions.store');
                Route::get('/{question}', [ App\Http\Controllers\Admin\QuestionController::class, 'show' ])->name('test-sections.questions.show');
                Route::get('/{question}/edit', [ App\Http\Controllers\Admin\QuestionController::class, 'edit' ])->name('test-sections.questions.edit');
                Route::put('/{question}', [ App\Http\Controllers\Admin\QuestionController::class, 'update' ])->name('test-sections.questions.update');
                Route::delete('/{question}', [ App\Http\Controllers\Admin\QuestionController::class, 'destroy' ])->name('test-sections.questions.destroy');
                Route::post('/{question}/reorder', [ App\Http\Controllers\Admin\QuestionController::class, 'reorder' ])->name('test-sections.questions.reorder');
            });
        });

        // Test Resource Management Routes
        Route::prefix('test-resources')->group(function () {
            Route::post('/', [ App\Http\Controllers\Admin\TestResourceController::class, 'store' ])->name('test-resources.store');
            Route::get('/{testResource}', [ App\Http\Controllers\Admin\TestResourceController::class, 'show' ])->name('test-resources.show');
            Route::put('/{testResource}', [ App\Http\Controllers\Admin\TestResourceController::class, 'update' ])->name('test-resources.update');
            Route::delete('/{testResource}', [ App\Http\Controllers\Admin\TestResourceController::class, 'destroy' ])->name('test-resources.destroy');
            Route::post('/{testResource}/upload', [ App\Http\Controllers\Admin\TestResourceController::class, 'upload' ])->name('test-resources.upload');
        });

        // Future Enhancements Routes
        Route::prefix('future-enhancements')->group(function () {
            Route::post('/vr-settings', [ FutureEnhancementController::class, 'vrSettings' ])->name('future.vr-settings');
            Route::post('/blockchain-certificates', [ FutureEnhancementController::class, 'blockchainCertificates' ])->name('future.blockchain-certificates');
            Route::get('/blockchain-certificates/verify', [ FutureEnhancementController::class, 'verifyCertificates' ])->name('future.blockchain-certificates.verify');
            Route::post('/live-tutoring', [ FutureEnhancementController::class, 'manageTutoring' ])->name('future.live-tutoring');
            Route::get('/live-tutoring/monitor', [ FutureEnhancementController::class, 'monitorTutoring' ])->name('future.live-tutoring.monitor');
            Route::post('/group-study', [ FutureEnhancementController::class, 'configureGroupStudy' ])->name('future.group-study');
        });
    });
});
