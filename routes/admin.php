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
    // Dashboard Routes
    Route::get('/', [ UserController::class, 'index' ])->name('admin.dashboard.overview');
    Route::get('/dashboard-recent-activity', [ UserController::class, 'recentActivity' ])->name('admin.dashboard.recent-activity');
    Route::get('/dashboard-system-status', [ SystemSettingController::class, 'systemStatus' ])->name('admin.dashboard.system-status');

    // User Management Routes
    Route::prefix('users')->group(function () {
        Route::get('/', [ UserController::class, 'index' ])->name('admin.users.index');
        Route::get('/list', [ UserController::class, 'listUsers' ])->name('admin.users.list');
        Route::post('/', [ UserController::class, 'store' ])->name('admin.users.store');
        Route::get('/create', [ UserController::class, 'create' ])->name('admin.users.create');
        Route::get('/{user}', [ UserController::class, 'show' ])->name('admin.users.show');
        Route::put('/{user}', [ UserController::class, 'update' ])->name('admin.users.update');
        Route::delete('/{user}/suspend', [ UserController::class, 'suspend' ])->name('admin.users.suspend');
        Route::delete('/{user}/deactivate', [ UserController::class, 'deactivate' ])->name('admin.users.deactivate');
        Route::get('/{user}/profile', [ UserController::class, 'profile' ])->name('admin.users.profile');
    });

    // User Subscriptions Routes
    Route::prefix('subscriptions')->group(function () {
        Route::get('/', [ UserSubscriptionController::class, 'index' ])->name('admin.subscriptions.index');
        Route::post('/plans', [ UserSubscriptionController::class, 'storePlan' ])->name('admin.subscriptions.plans.store');
        Route::put('/plans/{plan}', [ UserSubscriptionController::class, 'updatePlan' ])->name('admin.subscriptions.plans.update');
        Route::get('/{subscription}', [ UserSubscriptionController::class, 'show' ])->name('admin.subscriptions.show');
        Route::post('/payment-issues', [ UserSubscriptionController::class, 'handlePaymentIssues' ])->name('admin.subscriptions.payment-issues');
    });

    // User Progress Routes
    Route::prefix('progress')->group(function () {
        Route::get('/{user}', [ UserProgressController::class, 'index' ])->name('admin.progress.index');
        Route::get('/{user}/reports', [ UserProgressController::class, 'reports' ])->name('admin.progress.reports');
        Route::get('/{user}/performance', [ UserProgressController::class, 'performance' ])->name('admin.progress.performance');
        Route::post('/{user}/study-plans', [ UserProgressController::class, 'assignStudyPlan' ])->name('admin.progress.assign-study-plan');
    });

    // Roles & Permissions Routes
    Route::prefix('roles-permissions')->group(function () {
        Route::get('/', [ RolePermissionController::class, 'index' ])->name('admin.roles.index');
        Route::post('/roles', [ RolePermissionController::class, 'storeRole' ])->name('admin.roles.store');
        Route::put('/roles/{role}', [ RolePermissionController::class, 'updateRole' ])->name('admin.roles.update');
        Route::post('/permissions', [ RolePermissionController::class, 'assignPermissions' ])->name('admin.permissions.assign');
    });

    // Exam Management Routes
    Route::prefix('exam-types')->group(function () {
        Route::get('/', [ ExamTypeController::class, 'index' ])->name('admin.exam-types.index');
        Route::get('/list', [ ExamTypeController::class, 'listExamTypes' ])->name('admin.exam-types.list');
        Route::post('/', [ ExamTypeController::class, 'store' ])->name('admin.exam-types.store');
        Route::put('/{examType}', [ ExamTypeController::class, 'update' ])->name('admin.exam-types.update');
        Route::post('/{examType}/pricing', [ ExamTypeController::class, 'setPricing' ])->name('admin.exam-types.pricing');
    });

    Route::prefix('exam-sessions')->group(function () {
        Route::get('/active', [ ExamSessionController::class, 'activeSessions' ])->name('admin.exam-sessions.active');
        Route::get('/completed', [ ExamSessionController::class, 'completedSessions' ])->name('admin.exam-sessions.completed');
        Route::get('/monitor', [ ExamSessionController::class, 'monitor' ])->name('admin.exam-sessions.monitor');
        Route::post('/{examSession}/manage', [ ExamSessionController::class, 'manage' ])->name('admin.exam-sessions.manage');
    });

    Route::prefix('exam-sections')->group(function () {
        Route::get('/{examSection}', [ ExamSectionController::class, 'show' ])->name('admin.exam-sections.show');
        Route::put('/{examSection}/settings', [ ExamSectionController::class, 'updateSettings' ])->name('admin.exam-sections.settings');
        Route::get('/{examSection}/responses', [ ExamSectionController::class, 'responses' ])->name('admin.exam-sections.responses');
    });

    // Content Management Routes
    Route::prefix('question-banks')->group(function () {
        Route::get('/', [ QuestionBankController::class, 'index' ])->name('admin.question-banks.index');
        Route::get('/list', [ QuestionBankController::class, 'listQuestionBanks' ])->name('admin.question-banks.list');
        Route::post('/', [ QuestionBankController::class, 'store' ])->name('admin.question-banks.store');
        Route::put('/{questionBank}', [ QuestionBankController::class, 'update' ])->name('admin.question-banks.update');
        Route::post('/{questionBank}/toggle', [ QuestionBankController::class, 'toggleActive' ])->name('admin.question-banks.toggle');
        Route::post('/bulk-import', [ QuestionBankController::class, 'bulkImport' ])->name('admin.question-banks.bulk-import');
        Route::get('/bulk-export', [ QuestionBankController::class, 'bulkExport' ])->name('admin.question-banks.bulk-export');
    });

    Route::prefix('questions')->group(function () {
        Route::get('/', [ QuestionController::class, 'index' ])->name('admin.questions.index');
        Route::get('/list', [ QuestionController::class, 'listQuestions' ])->name('admin.questions.list');
        Route::post('/', [ QuestionController::class, 'store' ])->name('admin.questions.store');
        Route::put('/{question}', [ QuestionController::class, 'update' ])->name('admin.questions.update');
        Route::post('/{question}/approve', [ QuestionController::class, 'approve' ])->name('admin.questions.approve');
        Route::post('/{question}/metadata', [ QuestionController::class, 'updateMetadata' ])->name('admin.questions.metadata');
    });

    Route::prefix('reading-passages')->group(function () {
        Route::get('/', [ ReadingPassageController::class, 'index' ])->name('admin.reading-passages.index');
        Route::get('/list', [ ReadingPassageController::class, 'listReadingPassages' ])->name('admin.reading-passages.list');
        Route::post('/', [ ReadingPassageController::class, 'store' ])->name('admin.reading-passages.store');
        Route::put('/{readingPassage}', [ ReadingPassageController::class, 'update' ])->name('admin.reading-passages.update');
        Route::post('/{readingPassage}/categorize', [ ReadingPassageController::class, 'categorize' ])->name('admin.reading-passages.categorize');
    });

    Route::prefix('listening-audios')->group(function () {
        Route::get('/', [ ListeningAudioController::class, 'index' ])->name('admin.listening-audios.index');
        Route::get('/list', [ ListeningAudioController::class, 'listListeningAudios' ])->name('admin.listening-audios.list');
        Route::post('/', [ ListeningAudioController::class, 'store' ])->name('admin.listening-audios.store');
        Route::put('/{listeningAudio}', [ ListeningAudioController::class, 'update' ])->name('admin.listening-audios.update');
        Route::post('/{listeningAudio}/transcript', [ ListeningAudioController::class, 'updateTranscript' ])->name('admin.listening-audios.transcript');
    });

    Route::prefix('writing-prompts')->group(function () {
        Route::get('/', [ WritingPromptController::class, 'index' ])->name('admin.writing-prompts.index');
        Route::get('/list', [ WritingPromptController::class, 'listWritingPrompts' ])->name('admin.writing-prompts.list');
        Route::post('/', [ WritingPromptController::class, 'store' ])->name('admin.writing-prompts.store');
        Route::put('/{writingPrompt}', [ WritingPromptController::class, 'update' ])->name('admin.writing-prompts.update');
        Route::post('/{writingPrompt}/criteria', [ WritingPromptController::class, 'setCriteria' ])->name('admin.writing-prompts.criteria');
    });

    Route::prefix('speaking-questions')->group(function () {
        Route::get('/', [ SpeakingQuestionController::class, 'index' ])->name('admin.speaking-questions.index');
        Route::get('/list', [ SpeakingQuestionController::class, 'listSpeakingQuestions' ])->name('admin.speaking-questions.list');
        Route::post('/', [ SpeakingQuestionController::class, 'store' ])->name('admin.speaking-questions.store');
        Route::put('/{speakingQuestion}', [ SpeakingQuestionController::class, 'update' ])->name('admin.speaking-questions.update');
        Route::post('/{speakingQuestion}/follow-ups', [ SpeakingQuestionController::class, 'updateFollowUps' ])->name('admin.speaking-questions.follow-ups');
    });

    // Assessment Management Routes
    Route::prefix('reading-assessments')->group(function () {
        Route::get('/scores', [ ReadingAssessmentController::class, 'scores' ])->name('admin.reading-assessments.scores');
        Route::get('/{examSection}/responses', [ ReadingAssessmentController::class, 'responses' ])->name('admin.reading-assessments.responses');
        Route::post('/{examSection}/feedback', [ ReadingAssessmentController::class, 'generateFeedback' ])->name('admin.reading-assessments.feedback');
    });

    Route::prefix('listening-assessments')->group(function () {
        Route::get('/scores', [ ListeningAssessmentController::class, 'scores' ])->name('admin.listening-assessments.scores');
        Route::get('/{examSection}/responses', [ ListeningAssessmentController::class, 'responses' ])->name('admin.listening-assessments.responses');
        Route::post('/{examSection}/feedback', [ ListeningAssessmentController::class, 'generateFeedback' ])->name('admin.listening-assessments.feedback');
    });

    Route::prefix('writing-assessments')->group(function () {
        Route::get('/', [ WritingAssessmentController::class, 'index' ])->name('admin.writing-assessments.index');
        Route::post('/assign-assessor', [ WritingAssessmentController::class, 'assignAssessor' ])->name('admin.writing-assessments.assign-assessor');
        Route::get('/{writingAssessment}/ai', [ WritingAssessmentController::class, 'reviewAI' ])->name('admin.writing-assessments.ai');
        Route::put('/{writingAssessment}/scores', [ WritingAssessmentController::class, 'updateScores' ])->name('admin.writing-assessments.scores');
        Route::post('/{writingAssessment}/feedback', [ WritingAssessmentController::class, 'provideFeedback' ])->name('admin.writing-assessments.feedback');
    });

    Route::prefix('speaking-assessments')->group(function () {
        Route::get('/', [ SpeakingAssessmentController::class, 'index' ])->name('admin.speaking-assessments.index');
        Route::post('/assign-assessor', [ SpeakingAssessmentController::class, 'assignAssessor' ])->name('admin.speaking-assessments.assign-assessor');
        Route::get('/{speakingAssessment}/ai', [ SpeakingAssessmentController::class, 'reviewAI' ])->name('admin.speaking-assessments.ai');
        Route::put('/{speakingAssessment}/scores', [ SpeakingAssessmentController::class, 'updateScores' ])->name('admin.speaking-assessments.scores');
        Route::post('/{speakingAssessment}/feedback', [ SpeakingAssessmentController::class, 'provideFeedback' ])->name('admin.speaking-assessments.feedback');
    });

    Route::prefix('score-history')->group(function () {
        Route::get('/{user}', [ ScoreHistoryController::class, 'index' ])->name('admin.score-history.index');
        Route::get('/{user}/trends', [ ScoreHistoryController::class, 'trends' ])->name('admin.score-history.trends');
        Route::get('/{user}/export', [ ScoreHistoryController::class, 'export' ])->name('admin.score-history.export');
    });

    // Analytics & Reporting Routes
    Route::prefix('analytics')->group(function () {
        Route::get('/users', [ AnalyticsController::class, 'userAnalytics' ])->name('admin.analytics.users');
        Route::get('/exams', [ AnalyticsController::class, 'examAnalytics' ])->name('admin.analytics.exams');
        Route::get('/system', [ AnalyticsController::class, 'systemAnalytics' ])->name('admin.analytics.system');
        Route::get('/learning', [ AnalyticsController::class, 'learningAnalytics' ])->name('admin.analytics.learning');
    });

    // Notification Management Routes
    Route::prefix('notifications')->group(function () {
        Route::get('/email/templates', [ NotificationController::class, 'emailTemplates' ])->name('admin.notifications.email.templates');
        Route::get('/email/logs', [ NotificationController::class, 'emailLogs' ])->name('admin.notifications.email.logs');
        Route::post('/email/settings', [ NotificationController::class, 'emailSettings' ])->name('admin.notifications.email.settings');
        Route::post('/in-app', [ NotificationController::class, 'createInApp' ])->name('admin.notifications.in-app.create');
        Route::get('/in-app/history', [ NotificationController::class, 'inAppHistory' ])->name('admin.notifications.in-app.history');
        Route::get('/sms/templates', [ NotificationController::class, 'smsTemplates' ])->name('admin.notifications.sms.templates');
        Route::post('/sms/settings', [ NotificationController::class, 'smsSettings' ])->name('admin.notifications.sms.settings');
        Route::post('/push', [ NotificationController::class, 'pushNotifications' ])->name('admin.notifications.push.create');
        Route::get('/push/logs', [ NotificationController::class, 'pushLogs' ])->name('admin.notifications.push.logs');
    });

    // Payment Management Routes
    Route::prefix('payments')->group(function () {
        Route::get('/plans', [ PaymentController::class, 'plans' ])->name('admin.payments.plans');
        Route::post('/plans', [ PaymentController::class, 'storePlan' ])->name('admin.payments.plans.store');
        Route::put('/plans/{plan}', [ PaymentController::class, 'updatePlan' ])->name('admin.payments.plans.update');
        Route::get('/history', [ PaymentController::class, 'history' ])->name('admin.payments.history');
        Route::get('/refunds', [ PaymentController::class, 'refund' ])->name('admin.payments.refunds');
        Route::post('/failures', [ PaymentController::class, 'handleFailures' ])->name('admin.payments.failures');
        Route::post('/coupons', [ PaymentController::class, 'createCoupon' ])->name('admin.payments.coupons.create');
        Route::get('/coupons/usage', [ PaymentController::class, 'couponUsage' ])->name('admin.payments.coupons.usage');
    });

    // System Settings Routes
    Route::prefix('settings')->group(function () {
        Route::get('/general', [ SystemSettingController::class, 'general' ])->name('admin.settings.general');
        Route::get('/security', [ SystemSettingController::class, 'security' ])->name('admin.settings.security');
        Route::get('/integrations', [ SystemSettingController::class, 'integrations' ])->name('admin.settings.integrations');
        Route::get('/exam-integrity', [ SystemSettingController::class, 'examIntegrity' ])->name('admin.settings.exam-integrity');
        Route::get('/maintenance', [ SystemSettingController::class, 'maintenance' ])->name('admin.settings.maintenance');
    });

    // Content Approval Workflow Routes
    Route::prefix('content-approval')->group(function () {
        Route::get('/pending', [ ContentApprovalController::class, 'pending' ])->name('admin.content-approval.pending');
        Route::post('/approve', [ ContentApprovalController::class, 'approve' ])->name('admin.content-approval.approve');
        Route::post('/reject', [ ContentApprovalController::class, 'reject' ])->name('admin.content-approval.reject');
        Route::get('/approved', [ ContentApprovalController::class, 'approved' ])->name('admin.content-approval.approved');
        Route::post('/revert', [ ContentApprovalController::class, 'revert' ])->name('admin.content-approval.revert');
        Route::get('/rejected', [ ContentApprovalController::class, 'rejected' ])->name('admin.content-approval.rejected');
    });

    // Future Enhancements Routes
    Route::prefix('future-enhancements')->group(function () {                
        Route::post('/vr-settings', [ FutureEnhancementController::class, 'vrSettings' ])->name('admin.future.vr-settings');
        Route::post('/blockchain-certificates', [ FutureEnhancementController::class, 'blockchainCertificates' ])->name('admin.future.blockchain-certificates');
        Route::get('/blockchain-certificates/verify', [ FutureEnhancementController::class, 'verifyCertificates' ])->name('admin.future.blockchain-certificates.verify');
        Route::post('/live-tutoring', [ FutureEnhancementController::class, 'manageTutoring' ])->name('admin.future.live-tutoring');
        Route::get('/live-tutoring/monitor', [ FutureEnhancementController::class, 'monitorTutoring' ])->name('admin.future.live-tutoring.monitor');
        Route::post('/group-study', [ FutureEnhancementController::class, 'configureGroupStudy' ])->name('admin.future.group-study');
    });
});
