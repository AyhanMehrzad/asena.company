<?php
require_once 'includes/header.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$mode = isset($_GET['mode']) && $_GET['mode'] === 'ai' ? 'ai' : 'admin';

// Handle sending message via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['message'])) {
    $msg = trim($_POST['message']);
    $target = $_POST['target'] === 'ai' ? 'ai' : 'admin';
    
    if (!empty($msg)) {
        // Insert user message
        $stmt = $pdo->prepare("INSERT INTO chat_messages (user_id, sender_type, message, is_read) VALUES (?, 'user', ?, FALSE)");
        $stmt->execute([$user_id, $msg]);
        
        // If AI mode, generate a fake AI response immediately
        if ($target === 'ai') {
            $ai_reply = "شما گفتید: '$msg'. من یک دستیار هوشمند آزمایشی هستم.";
            $stmt = $pdo->prepare("INSERT INTO chat_messages (user_id, sender_type, message, is_read) VALUES (?, 'ai', ?, TRUE)");
            $stmt->execute([$user_id, $ai_reply]);
        }
        
        // Redirect to avoid resubmission
        header("Location: chat.php?mode=$target");
        exit;
    }
}

// Fetch messages for the current mode
$stmt = $pdo->prepare("
    SELECT * FROM chat_messages 
    WHERE user_id = ? AND (sender_type = 'user' OR sender_type = ?)
    ORDER BY created_at ASC
");
// If we are in AI mode, show user messages and AI messages.
// But wait, the query logic: we might want to separate AI conversations from Admin conversations entirely.
// Let's add a 'target_type' column or just filter based on sender_type and assume users send messages to either AI or Admin.
// For simplicity in this demo, let's just fetch all messages. A real app would have thread IDs.
$stmt = $pdo->prepare("
    SELECT * FROM chat_messages 
    WHERE user_id = ?
    ORDER BY created_at ASC
");
$stmt->execute([$user_id]);
$all_messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

// For the UI, filter messages based on the active tab
$messages = [];
foreach ($all_messages as $m) {
    if ($mode === 'ai' && ($m['sender_type'] === 'ai' || ($m['sender_type'] === 'user' && strpos($m['message'], '[AI]') === 0))) {
        // Strip [AI] prefix for display
        $m['message'] = str_replace('[AI] ', '', $m['message']);
        $messages[] = $m;
    } elseif ($mode === 'admin' && ($m['sender_type'] === 'admin' || ($m['sender_type'] === 'user' && strpos($m['message'], '[AI]') !== 0))) {
        $messages[] = $m;
    }
}
// This requires a hack for saving messages to know their target, let's update the POST logic.
// Ah, the POST logic is above, let's fix it by prefixing user messages for AI.
?>
<main class="max-w-4xl mx-auto overflow-hidden py-12 px-margin-desktop min-h-[70vh] flex flex-col">
    <div class="bg-white rounded-3xl shadow-xl border border-outline-variant/30 flex flex-col h-[70vh] overflow-hidden relative">
        
        <!-- Header & Tabs -->
        <div class="bg-surface-container-low border-b border-outline-variant/30 p-4">
            <div class="flex items-center justify-between mb-4">
                <h1 class="text-title-lg font-bold text-primary flex items-center gap-2">
                    <span class="material-symbols-outlined">support_agent</span>
                    پشتیبانی و دستیار هوشمند
                </h1>
                <a href="profile.php" class="text-on-surface-variant hover:text-primary"><span class="material-symbols-outlined">close</span></a>
            </div>
            
            <div class="flex bg-surface-container-lowest p-1 rounded-xl">
                <a href="chat.php?mode=ai" class="flex-1 py-2 text-center rounded-lg font-bold text-sm transition-all <?php echo $mode === 'ai' ? 'bg-primary-container text-white shadow' : 'text-on-surface-variant hover:text-primary'; ?>">
                    دستیار هوشمند (AI)
                </a>
                <a href="chat.php?mode=admin" class="flex-1 py-2 text-center rounded-lg font-bold text-sm transition-all <?php echo $mode === 'admin' ? 'bg-primary-container text-white shadow' : 'text-on-surface-variant hover:text-primary'; ?>">
                    پشتیبانی آنلاین (ادمین)
                </a>
            </div>
        </div>

        <!-- Chat Area -->
        <div class="flex-1 overflow-y-auto p-6 space-y-4 bg-surface-container-lowest" id="chat-box">
            <?php if(empty($messages)): ?>
                <div class="h-full flex flex-col items-center justify-center text-on-surface-variant opacity-70">
                    <span class="material-symbols-outlined text-6xl mb-4"><?php echo $mode === 'ai' ? 'smart_toy' : 'forum'; ?></span>
                    <p class="font-bold">پیامی یافت نشد. اولین پیام خود را ارسال کنید.</p>
                </div>
            <?php else: ?>
                <?php foreach($messages as $msg): ?>
                    <?php if($msg['sender_type'] === 'user'): ?>
                        <div class="flex justify-start flex-row-reverse gap-3">
                            <div class="w-8 h-8 rounded-full bg-primary-container text-white flex items-center justify-center font-bold text-xs shrink-0">شما</div>
                            <div class="bg-primary text-white p-3 rounded-2xl rounded-tl-sm max-w-[80%] text-sm leading-relaxed">
                                <?php echo nl2br(htmlspecialchars($msg['message'])); ?>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="flex justify-start gap-3">
                            <div class="w-8 h-8 rounded-full <?php echo $msg['sender_type'] === 'ai' ? 'bg-status-warning text-white' : 'bg-secondary text-white'; ?> flex items-center justify-center font-bold text-xs shrink-0">
                                <span class="material-symbols-outlined text-[18px]"><?php echo $msg['sender_type'] === 'ai' ? 'smart_toy' : 'support_agent'; ?></span>
                            </div>
                            <div class="bg-surface-container p-3 rounded-2xl rounded-tr-sm max-w-[80%] text-sm leading-relaxed text-on-surface">
                                <?php echo nl2br(htmlspecialchars($msg['message'])); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <!-- Input Area -->
        <div class="p-4 bg-white border-t border-outline-variant/30">
            <form action="actions/chat_action.php" method="POST" class="flex gap-2 relative">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="target" value="<?php echo $mode; ?>">
                <input type="text" name="message" required placeholder="<?php echo $mode === 'ai' ? 'سوال خود را از هوش مصنوعی بپرسید...' : 'پیام خود را برای پشتیبانی بنویسید...'; ?>" class="flex-1 border border-outline-variant rounded-xl pl-12 pr-4 py-3 focus:ring-2 focus:ring-primary-container outline-none text-sm bg-surface-container-lowest">
                <button type="submit" class="absolute left-2 top-1/2 -translate-y-1/2 w-10 h-10 bg-primary text-white rounded-lg flex items-center justify-center hover:bg-primary-container transition-colors">
                    <span class="material-symbols-outlined rotate-180" style="font-variation-settings: 'FILL' 1;">send</span>
                </button>
            </form>
        </div>
    </div>
</main>
<script>
    // Scroll to bottom of chat
    const chatBox = document.getElementById('chat-box');
    chatBox.scrollTop = chatBox.scrollHeight;
</script>
<?php include 'includes/footer.php'; ?>
