<?php
/**
 * ASENA Visual Blog Builder & Live WYSIWYG Editor
 * Designed for Admins and Doctors to author rich Knowledge Base articles with
 * Callouts (Image 3), FAQ Accordions (Image 4), Headings, Links, and Media.
 */

require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/blog_service.php';

// Authentication Check: Admin or Doctor
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$stmt = $pdo->prepare("SELECT role, name FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();

if (!$user || !in_array($user['role'], ['admin', 'doctor'])) {
    header("Location: index.php");
    exit;
}

$user_role = $user['role'];
$user_name = $user['name'] ?? 'کاربر';
$user_id = (int)$_SESSION['user_id'];

// Load existing post if editing
$post_id = isset($_GET['id']) && is_numeric($_GET['id']) ? (int)$_GET['id'] : 0;
$post = null;
if ($post_id > 0) {
    $post = get_db_blog_by_id($pdo, $post_id);
}

// Handle Form Submission (Save / Publish)
$message = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'save_blog') {
    $title = trim($_POST['title'] ?? '');
    $slug = trim($_POST['slug'] ?? '');
    $short_desc = trim($_POST['short_desc'] ?? '');
    $category = $_POST['category'] ?? 'medical';
    $content = $_POST['content'] ?? '';
    $read_time = trim($_POST['read_time'] ?? '۵ دقیقه مطالعه');
    $author_name = trim($_POST['author_name'] ?? 'آسنا');
    $author_role = trim($_POST['author_role'] ?? 'تیم تخصصی و تحریریه آسنا');
    $status = $_POST['status'] === 'draft' ? 'draft' : 'published';

    if (empty($title)) {
        $error = 'عنوان مقاله نمی‌تواند خالی باشد.';
    } else {
        $data = [
            'id' => $post_id,
            'title' => $title,
            'slug' => $slug,
            'short_desc' => $short_desc,
            'category' => $category,
            'content' => $content,
            'read_time' => $read_time,
            'author_name' => $author_name,
            'author_role' => $author_role,
            'status' => $status
        ];

        $saved_id = save_db_blog($pdo, $data, $user_id);
        if ($saved_id > 0) {
            $post_id = $saved_id;
            $post = get_db_blog_by_id($pdo, $post_id);
            $message = 'مقاله با موفقیت ذخیره و در پایگاه دانش به‌روزرسانی شد!';
        } else {
            $error = 'خطا در ذخیره‌سازی مقاله در پایگاه داده.';
        }
    }
}

// Set initial field values
$init_title = $post['title'] ?? '';
$init_slug = $post['slug'] ?? '';
$init_short_desc = $post['short_desc'] ?? '';
$init_category = $post['category'] ?? 'medical';
$init_read_time = $post['read_time'] ?? '۵ دقیقه مطالعه';
$init_author_name = $post['author_name'] ?? 'آسنا';
$init_author_role = $post['author_role'] ?? 'تیم تخصصی و تحریریه آسنا';
$init_content = $post['content'] ?? '<p>متن و پاراگراف‌های اصلی مقاله خود را در اینجا بنویسید. از نوار ابزار بالا برای ایجاد تیتر، برجسته‌سازی متن، لینک، کادرهای ویژه (نقل‌قول) و آکاردئون سوالات متداول استفاده فرمایید.</p>';
$init_status = $post['status'] ?? 'published';
?>
<!DOCTYPE html>
<html dir="rtl" lang="fa">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ویرایشگر بصری مقالات و وبلاگ - ASENA Visual Blog Builder</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="assets/css/material-symbols.css" rel="stylesheet">
    <link href="assets/css/vazirmatn.css" rel="stylesheet">
    <script src="assets/js/tailwindcss-cdn.js"></script>
    <style>
        body { font-family: 'Vazirmatn', sans-serif; }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
        #canvas-content:focus { outline: none; }
        #canvas-content h2 { font-size: 1.5rem; font-weight: 800; margin-top: 1.5rem; margin-bottom: 0.75rem; color: #0f172a; }
        #canvas-content h3 { font-size: 1.25rem; font-weight: 700; margin-top: 1.25rem; margin-bottom: 0.5rem; color: #1e293b; }
        #canvas-content p { margin-bottom: 1rem; line-height: 2; color: #334155; }
        #canvas-content ul { list-style-type: disc; padding-right: 1.5rem; margin-bottom: 1rem; color: #334155; }
        #canvas-content ol { list-style-type: decimal; padding-right: 1.5rem; margin-bottom: 1rem; color: #334155; }
        #canvas-content a { color: #0284c7; text-decoration: underline; }
        .toolbar-btn { transition: all 0.15s ease; }
        .toolbar-btn:hover { background: rgba(2, 132, 199, 0.1); color: #0284c7; }
        .toolbar-btn:active { transform: scale(0.95); }
    </style>
</head>
<body class="bg-slate-100 dark:bg-slate-950 text-slate-900 dark:text-slate-100 min-h-screen relative pb-20">

<!-- Ambient Gradient Background -->
<div class="fixed inset-0 pointer-events-none -z-10 overflow-hidden">
    <div class="absolute -top-40 right-10 w-[550px] h-[550px] bg-gradient-to-br from-blue-600/15 via-[#002d72]/20 to-teal-500/10 rounded-full blur-3xl"></div>
    <div class="absolute top-1/2 left-5 w-[500px] h-[500px] bg-gradient-to-tr from-indigo-700/15 via-[#0f766e]/15 to-blue-500/10 rounded-full blur-3xl"></div>
</div>

<form id="blog-form" method="POST" action="">
    <input type="hidden" name="action" value="save_blog">
    <input type="hidden" id="input-title" name="title" value="<?= htmlspecialchars($init_title) ?>">
    <input type="hidden" id="input-slug" name="slug" value="<?= htmlspecialchars($init_slug) ?>">
    <input type="hidden" id="input-short-desc" name="short_desc" value="<?= htmlspecialchars($init_short_desc) ?>">
    <input type="hidden" id="input-category" name="category" value="<?= htmlspecialchars($init_category) ?>">
    <input type="hidden" id="input-read-time" name="read_time" value="<?= htmlspecialchars($init_read_time) ?>">
    <input type="hidden" id="input-author-name" name="author_name" value="<?= htmlspecialchars($init_author_name) ?>">
    <input type="hidden" id="input-author-role" name="author_role" value="<?= htmlspecialchars($init_author_role) ?>">
    <input type="hidden" id="input-content" name="content" value="">
    <input type="hidden" id="input-status" name="status" value="<?= htmlspecialchars($init_status) ?>">

    <!-- Top Sticky Bar -->
    <header class="sticky top-0 z-50 bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl border-b border-slate-200 dark:border-slate-800 shadow-sm">
        <div class="max-w-6xl mx-auto px-4 h-16 flex items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <a href="<?= $user_role === 'admin' ? 'admin/blogs.php' : 'doctor/blogs.php' ?>" class="p-2 rounded-xl hover:bg-slate-100 dark:hover:bg-slate-800 text-slate-500 transition-colors" title="بازگشت به پنل">
                    <span class="material-symbols-outlined">arrow_forward</span>
                </a>
                <div>
                    <h1 class="font-extrabold text-sm md:text-base leading-tight">ویرایشگر بصری مقاله</h1>
                    <p class="text-[11px] text-slate-500">حالت: <?= $user_role === 'admin' ? 'مدیریت کل سیستم' : 'پزشک معالج' ?></p>
                </div>
            </div>

            <!-- Status & Action Buttons -->
            <div class="flex items-center gap-2 md:gap-3">
                <select id="select-status" class="text-xs font-bold rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 px-3 py-2 outline-none">
                    <option value="published" <?= $init_status === 'published' ? 'selected' : '' ?>>🟢 انتشار عمومی</option>
                    <option value="draft" <?= $init_status === 'draft' ? 'selected' : '' ?>>🟡 پیش‌نویس خصوصی</option>
                </select>

                <?php if ($post_id > 0 && !empty($init_slug)): ?>
                <a href="knowledge_base.php?article=<?= urlencode($init_slug) ?>" target="_blank" class="hidden sm:flex items-center gap-1.5 px-3 py-2 rounded-xl text-xs font-bold border border-slate-200 dark:border-slate-700 bg-white/70 dark:bg-slate-800/80 text-slate-700 dark:text-slate-200 hover:bg-slate-100 transition-all">
                    <span class="material-symbols-outlined text-[16px]">visibility</span>
                    <span>مشاهده زنده</span>
                </a>
                <?php endif; ?>

                <button type="submit" onclick="prepareAndSubmit()" class="px-5 py-2 rounded-xl bg-gradient-to-r from-primary to-blue-600 hover:from-blue-700 hover:to-indigo-700 text-white font-bold text-xs md:text-sm shadow-md transition-all flex items-center gap-1.5">
                    <span class="material-symbols-outlined text-[18px]">save</span>
                    <span>ذخیره و انتشار</span>
                </button>
            </div>
        </div>
    </header>

    <!-- Notification Messages -->
    <?php if (!empty($message)): ?>
    <div class="max-w-4xl mx-auto px-4 mt-6">
        <div class="p-4 rounded-2xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-800 dark:text-emerald-300 text-xs md:text-sm font-bold flex items-center gap-2">
            <span class="material-symbols-outlined text-emerald-600">check_circle</span>
            <span><?= htmlspecialchars($message) ?></span>
        </div>
    </div>
    <?php endif; ?>

    <?php if (!empty($error)): ?>
    <div class="max-w-4xl mx-auto px-4 mt-6">
        <div class="p-4 rounded-2xl bg-rose-500/10 border border-rose-500/30 text-rose-800 dark:text-rose-300 text-xs md:text-sm font-bold flex items-center gap-2">
            <span class="material-symbols-outlined text-rose-600">error</span>
            <span><?= htmlspecialchars($error) ?></span>
        </div>
    </div>
    <?php endif; ?>

    <!-- Main Canvas Area -->
    <main class="max-w-4xl mx-auto px-4 mt-8">
        
        <!-- Live Editable Article Header Glass Card -->
        <div class="relative rounded-3xl p-6 md:p-10 mb-8 border border-white/60 dark:border-slate-800/80 bg-white/70 dark:bg-slate-900/80 backdrop-blur-xl shadow-xl overflow-hidden space-y-4">
            
            <!-- Category & Read Time Selectors -->
            <div class="flex flex-wrap items-center gap-3">
                <div class="flex items-center gap-2">
                    <span class="text-xs text-slate-500 font-bold">دسته‌بندی:</span>
                    <select id="select-category" class="text-xs font-bold rounded-xl border border-primary/20 bg-primary/10 text-primary px-3 py-1.5 outline-none">
                        <option value="medical" <?= $init_category === 'medical' ? 'selected' : '' ?>>💉 پزشکی و سلامت</option>
                        <option value="pharmacy" <?= $init_category === 'pharmacy' ? 'selected' : '' ?>>💊 دارو و نسخه</option>
                        <option value="shop" <?= $init_category === 'shop' ? 'selected' : '' ?>>🐾 پت‌شاپ و تغذیه</option>
                        <option value="platform" <?= $init_category === 'platform' ? 'selected' : '' ?>>📖 راهنمای سامانه آسنا</option>
                    </select>
                </div>

                <div class="flex items-center gap-1.5">
                    <span class="material-symbols-outlined text-slate-400 text-base">schedule</span>
                    <input type="text" id="canvas-read-time" value="<?= htmlspecialchars($init_read_time) ?>" placeholder="مثلاً: ۷ دقیقه مطالعه" class="text-xs bg-transparent border-b border-dashed border-slate-300 dark:border-slate-700 py-1 px-2 text-slate-600 dark:text-slate-300 outline-none w-32 focus:border-primary">
                </div>
            </div>

            <!-- Title (Click to edit directly) -->
            <div>
                <label class="block text-[11px] font-bold text-slate-400 mb-1">عنوان اصلی مقاله (تیتر H1 سئو):</label>
                <div id="canvas-title" contenteditable="true" class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-slate-900 dark:text-white leading-snug outline-none border-b-2 border-transparent focus:border-primary/40 pb-2 transition-all" placeholder="عنوان مقاله را اینجا تایپ فرمایید..."><?= !empty($init_title) ? htmlspecialchars($init_title) : 'عنوان جذاب و سئومحور مقاله خود را اینجا تایپ کنید...' ?></div>
            </div>

            <!-- Excerpt / Short Description -->
            <div>
                <label class="block text-[11px] font-bold text-slate-400 mb-1">خلاصه کوتاه مقاله (توضیحات متا در گوگل و کارت‌ها):</label>
                <div id="canvas-short-desc" contenteditable="true" class="text-sm md:text-base text-slate-600 dark:text-slate-300 leading-relaxed outline-none border-b-2 border-transparent focus:border-primary/40 pb-2 transition-all" placeholder="یک یا دو جمله خلاصه جذاب از مقاله..."><?= !empty($init_short_desc) ? htmlspecialchars($init_short_desc) : 'خلاصه مقاله جهت نمایش در کارت‌های پایگاه دانش و توضیحات گوگل...' ?></div>
            </div>

            <!-- Author Info (Defaults to ASENA) -->
            <div class="flex items-center gap-4 pt-4 border-t border-slate-200/60 dark:border-slate-800">
                <div class="w-11 h-11 rounded-2xl bg-gradient-to-tr from-primary to-blue-600 flex items-center justify-center text-white shadow-md">
                    <span class="material-symbols-outlined text-xl">verified_user</span>
                </div>
                <div class="flex-1">
                    <div class="flex items-center gap-2">
                        <input type="text" id="canvas-author-name" value="<?= htmlspecialchars($init_author_name) ?>" class="text-sm font-bold bg-transparent border-b border-dashed border-slate-300 dark:border-slate-700 outline-none w-48 text-slate-900 dark:text-white focus:border-primary" placeholder="نام نویسنده">
                        <span class="material-symbols-outlined text-blue-500 text-sm">check_circle</span>
                    </div>
                    <input type="text" id="canvas-author-role" value="<?= htmlspecialchars($init_author_role) ?>" class="text-xs bg-transparent border-b border-dashed border-slate-200 dark:border-slate-800 outline-none w-64 text-slate-500 dark:text-slate-400 mt-1 focus:border-primary" placeholder="سمت نویسنده">
                </div>
            </div>
        </div>

        <!-- Sticky Floating WYSIWYG Formatting Toolbar -->
        <div class="sticky top-20 z-40 my-4 p-2.5 rounded-2xl border border-white/60 dark:border-slate-800/80 bg-white/95 dark:bg-slate-900/95 backdrop-blur-xl shadow-xl flex flex-wrap items-center gap-1.5 text-slate-700 dark:text-slate-200">
            
            <!-- Font Size Dropdown -->
            <div class="flex items-center gap-1 bg-slate-100 dark:bg-slate-800 rounded-xl px-2.5 py-1 border border-slate-200 dark:border-slate-700">
                <span class="material-symbols-outlined text-[17px] text-slate-500">format_size</span>
                <select id="fontSizeSelect" onchange="setFontSize(this.value); this.value='';" class="text-xs font-bold bg-transparent outline-none cursor-pointer text-slate-700 dark:text-slate-200">
                    <option value="">اندازه قلم</option>
                    <option value="12px">بسیار کوچک (12px)</option>
                    <option value="14px">کوچک (14px)</option>
                    <option value="16px">استاندارد (16px)</option>
                    <option value="18px">بزرگ (18px)</option>
                    <option value="22px">خیلی بزرگ (22px)</option>
                    <option value="26px">تیتر برجسته (26px)</option>
                    <option value="32px">عظیم (32px)</option>
                </select>
            </div>

            <!-- Font Color Picker -->
            <label class="toolbar-btn flex items-center gap-1 px-2.5 h-9 rounded-xl cursor-pointer hover:bg-slate-100 dark:hover:bg-slate-800 border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800" title="تغییر رنگ قلم (Font Color)">
                <span class="material-symbols-outlined text-[19px] text-primary">format_color_text</span>
                <span class="text-xs font-bold hidden sm:inline">رنگ متن</span>
                <input type="color" onchange="formatDoc('foreColor', this.value)" value="#0f172a" class="w-5 h-5 rounded-md cursor-pointer border-0 p-0 bg-transparent shadow-sm">
            </label>

            <!-- Highlight Background Color Picker -->
            <label class="toolbar-btn flex items-center gap-1 px-2.5 h-9 rounded-xl cursor-pointer hover:bg-slate-100 dark:hover:bg-slate-800 border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800" title="هایلایت و رنگ پس‌زمینه متن">
                <span class="material-symbols-outlined text-[19px] text-amber-500">format_ink_highlighter</span>
                <span class="text-xs font-bold hidden sm:inline">هایلایت</span>
                <input type="color" onchange="formatDoc('hiliteColor', this.value)" value="#fef08a" class="w-5 h-5 rounded-md cursor-pointer border-0 p-0 bg-transparent shadow-sm">
            </label>

            <div class="w-[1px] h-6 bg-slate-200 dark:bg-slate-700 mx-1"></div>

            <!-- Standard Formatting (Bold, Italic, Underline) -->
            <button type="button" onclick="formatDoc('bold')" class="toolbar-btn w-9 h-9 rounded-xl flex items-center justify-center font-bold hover:bg-slate-100 dark:hover:bg-slate-800" title="بولد / ضخیم (Ctrl+B)">
                <span class="material-symbols-outlined text-[19px]">format_bold</span>
            </button>
            <button type="button" onclick="formatDoc('italic')" class="toolbar-btn w-9 h-9 rounded-xl flex items-center justify-center hover:bg-slate-100 dark:hover:bg-slate-800" title="ایتالیک / مایل (Ctrl+I)">
                <span class="material-symbols-outlined text-[19px]">format_italic</span>
            </button>
            <button type="button" onclick="formatDoc('underline')" class="toolbar-btn w-9 h-9 rounded-xl flex items-center justify-center hover:bg-slate-100 dark:hover:bg-slate-800" title="زیرخط / Underline (Ctrl+U)">
                <span class="material-symbols-outlined text-[19px]">format_underlined</span>
            </button>
            
            <div class="w-[1px] h-6 bg-slate-200 dark:bg-slate-700 mx-1"></div>

            <!-- Headings -->
            <button type="button" onclick="formatDoc('formatBlock', '<h2>')" class="toolbar-btn px-2.5 h-9 rounded-xl flex items-center justify-center font-black text-xs hover:bg-slate-100 dark:hover:bg-slate-800" title="تیتر اصلی (H2)">
                H2
            </button>
            <button type="button" onclick="formatDoc('formatBlock', '<h3>')" class="toolbar-btn px-2.5 h-9 rounded-xl flex items-center justify-center font-black text-xs hover:bg-slate-100 dark:hover:bg-slate-800" title="زیرتیتر (H3)">
                H3
            </button>

            <div class="w-[1px] h-6 bg-slate-200 dark:bg-slate-700 mx-1"></div>

            <!-- Alignment -->
            <button type="button" onclick="formatDoc('justifyRight')" class="toolbar-btn w-8 h-9 rounded-xl flex items-center justify-center hover:bg-slate-100 dark:hover:bg-slate-800" title="راست‌چین">
                <span class="material-symbols-outlined text-[18px]">format_align_right</span>
            </button>
            <button type="button" onclick="formatDoc('justifyCenter')" class="toolbar-btn w-8 h-9 rounded-xl flex items-center justify-center hover:bg-slate-100 dark:hover:bg-slate-800" title="وسط‌چین">
                <span class="material-symbols-outlined text-[18px]">format_align_center</span>
            </button>
            <button type="button" onclick="formatDoc('justifyLeft')" class="toolbar-btn w-8 h-9 rounded-xl flex items-center justify-center hover:bg-slate-100 dark:hover:bg-slate-800" title="چپ‌چین">
                <span class="material-symbols-outlined text-[18px]">format_align_left</span>
            </button>

            <div class="w-[1px] h-6 bg-slate-200 dark:bg-slate-700 mx-1"></div>

            <!-- Lists & Links -->
            <button type="button" onclick="formatDoc('insertUnorderedList')" class="toolbar-btn w-8 h-9 rounded-xl flex items-center justify-center hover:bg-slate-100 dark:hover:bg-slate-800" title="لیست نشانه‌دار">
                <span class="material-symbols-outlined text-[19px]">format_list_bulleted</span>
            </button>
            <button type="button" onclick="formatDoc('insertOrderedList')" class="toolbar-btn w-8 h-9 rounded-xl flex items-center justify-center hover:bg-slate-100 dark:hover:bg-slate-800" title="لیست شماره‌دار">
                <span class="material-symbols-outlined text-[19px]">format_list_numbered</span>
            </button>
            <button type="button" onclick="insertLinkPrompt()" class="toolbar-btn w-8 h-9 rounded-xl flex items-center justify-center hover:bg-slate-100 dark:hover:bg-slate-800" title="افزودن پیوند / لینک">
                <span class="material-symbols-outlined text-[19px]">link</span>
            </button>
            <button type="button" onclick="formatDoc('removeFormat')" class="toolbar-btn w-8 h-9 rounded-xl flex items-center justify-center text-rose-500 hover:bg-rose-50 dark:hover:bg-rose-950/30" title="پاک‌کردن قالب‌بندی">
                <span class="material-symbols-outlined text-[18px]">format_clear</span>
            </button>

            <div class="w-[1px] h-6 bg-slate-200 dark:bg-slate-700 mx-1"></div>

            <!-- COMPONENT 1: Callout / Quote Box (Image 3) -->
            <button type="button" onclick="insertCalloutBox()" class="toolbar-btn px-3 h-9 rounded-xl bg-teal-50 dark:bg-teal-950/40 text-teal-700 dark:text-teal-300 font-bold text-xs flex items-center gap-1.5 border border-teal-300 dark:border-teal-800 hover:bg-teal-100 transition-all shadow-sm" title="درج کادر ویژه / نقل‌قول (تصویر ۳)">
                <span class="material-symbols-outlined text-[18px]">format_quote</span>
                <span>+ کادر نقل‌قول و هشدار</span>
            </button>

            <!-- COMPONENT 2: FAQ Accordion (Image 4) -->
            <button type="button" onclick="insertFaqAccordion()" class="toolbar-btn px-3 h-9 rounded-xl bg-blue-50 dark:bg-blue-950/40 text-blue-700 dark:text-blue-300 font-bold text-xs flex items-center gap-1.5 border border-blue-300 dark:border-blue-800 hover:bg-blue-100 transition-all shadow-sm" title="درج پرسش و پاسخ تاشو (تصویر ۴)">
                <span class="material-symbols-outlined text-[18px]">quiz</span>
                <span>+ سوال متداول تاشو</span>
            </button>
        </div>

        <!-- Live Content Editor Body (Glass Canvas) -->
        <div class="rounded-3xl p-6 md:p-10 border border-white/60 dark:border-slate-800/80 bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl shadow-lg leading-loose text-slate-800 dark:text-slate-200 min-h-[400px]">
            <div id="canvas-content" contenteditable="true" class="prose prose-blue dark:prose-invert max-w-none outline-none">
                <?= $init_content ?>
            </div>
        </div>

    </main>
</form>

<script>
function formatDoc(cmd, value = null) {
    if (cmd === 'hiliteColor') {
        if (!document.execCommand('hiliteColor', false, value)) {
            document.execCommand('backColor', false, value);
        }
    } else {
        document.execCommand(cmd, false, value);
    }
    document.getElementById('canvas-content').focus();
}

function setFontSize(size) {
    if (!size) return;
    const sel = window.getSelection();
    if (!sel.rangeCount || sel.isCollapsed) {
        alert('لطفاً ابتدا متنی که می‌خواهید اندازه آن تغییر کند را انتخاب فرمایید.');
        return;
    }
    const range = sel.getRangeAt(0);
    const span = document.createElement('span');
    span.style.fontSize = size;
    span.appendChild(range.extractContents());
    range.insertNode(span);
    sel.removeAllRanges();
    const newRange = document.createRange();
    newRange.selectNodeContents(span);
    sel.addRange(newRange);
    document.getElementById('canvas-content').focus();
}

function insertLinkPrompt() {
    const url = prompt('آدرس اینترنتی پیوند (URL) را وارد نمایید:', 'https://');
    if (url && url !== 'https://') {
        formatDoc('createLink', url);
    }
}

// Inserts the exact Callout / Quote Box requested (Image 3)
function insertCalloutBox() {
    const title = prompt('عنوان کادر برجسته / نقل‌قول:', '۱. استامینوفن (تیلنول / پاراستامول)');
    if (!title) return;
    const desc = prompt('متن توضیحات کادر:', 'گربه‌ها فاقد آنزیم گلوکورونیل ترانسفراز هستند. مصرف حتی مقدار اندکی استامینوفن باعث تولید متابولیت بسیار سمی و تغییر هموگلوبین خون می‌شود...');
    
    const html = `
    <div class="my-4 p-4 rounded-2xl bg-slate-50 dark:bg-slate-800/60 border border-slate-200 dark:border-slate-700 select-all">
        <h4 class="font-bold text-teal-700 dark:text-teal-400 mb-1">${title}</h4>
        <p class="text-sm text-slate-600 dark:text-slate-300 leading-relaxed">${desc || 'توضیحات تکمیلی...'}</p>
    </div><p><br></p>`;
    
    document.execCommand('insertHTML', false, html);
    document.getElementById('canvas-content').focus();
}

// Inserts the exact FAQ Accordion requested (Image 4)
function insertFaqAccordion() {
    const q = prompt('متن پرسش سرپرستان پت:', 'اگر حیوانم درد دارد چه داروی مسکنی می‌توانم در خانه بدهم؟');
    if (!q) return;
    const a = prompt('پاسخ پزشک:', 'هیچ داروی انسانی به عنوان مسکن ایمن نیست. فقط مسکن‌های اختصاصی با تجویز مستقیم پزشک مجاز هستند.');

    const html = `
    <details class="group rounded-2xl border border-slate-200 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-800/40 p-4 my-3 transition-all">
        <summary class="font-bold text-sm text-slate-900 dark:text-white cursor-pointer list-none flex items-center justify-between">
            <span>${q}</span>
            <span class="material-symbols-outlined text-slate-400 group-open:rotate-180 transition-transform">expand_more</span>
        </summary>
        <p class="mt-3 text-xs md:text-sm text-slate-600 dark:text-slate-300 leading-relaxed pt-2 border-t border-slate-200/50 dark:border-slate-800">
            ${a || 'پاسخ سوال...'}
        </p>
    </details><p><br></p>`;

    document.execCommand('insertHTML', false, html);
    document.getElementById('canvas-content').focus();
}

// Sync content from contenteditable fields to hidden form inputs before submit
function prepareAndSubmit() {
    const titleEl = document.getElementById('canvas-title');
    const shortDescEl = document.getElementById('canvas-short-desc');
    const contentEl = document.getElementById('canvas-content');
    const catEl = document.getElementById('select-category');
    const statusEl = document.getElementById('select-status');
    const readTimeEl = document.getElementById('canvas-read-time');
    const authorNameEl = document.getElementById('canvas-author-name');
    const authorRoleEl = document.getElementById('canvas-author-role');

    document.getElementById('input-title').value = titleEl.innerText.trim();
    document.getElementById('input-short-desc').value = shortDescEl.innerText.trim();
    document.getElementById('input-content').value = contentEl.innerHTML;
    document.getElementById('input-category').value = catEl.value;
    document.getElementById('input-status').value = statusEl.value;
    document.getElementById('input-read-time').value = readTimeEl.value.trim();
    document.getElementById('input-author-name').value = authorNameEl.value.trim();
    document.getElementById('input-author-role').value = authorRoleEl.value.trim();
}
</script>

</body>
</html>
