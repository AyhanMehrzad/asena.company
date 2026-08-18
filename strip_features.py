import os
import re

def remove_blocks(file_path, patterns):
    if not os.path.exists(file_path):
        return
    with open(file_path, 'r', encoding='utf-8') as f:
        content = f.read()

    for pattern in patterns:
        content = re.sub(pattern, '', content, flags=re.DOTALL)
        
    with open(file_path, 'w', encoding='utf-8') as f:
        f.write(content)

# Chat button in index.php
chat_index_pattern = r'<a href="chat\.php"[\s\S]*?</a>'

# Chat button in profile.php
chat_profile_pattern = r'<!-- Floating Chat Button -->[\s\S]*?</a>'
chat_profile_script = r'<script>[\s\S]*?// Initialize chat if user is logged in[\s\S]*?</script>'

# Rewards in profile_settings.php
rewards_settings_pattern = r'<a href="rewards\.php"[\s\S]*?</a>'

# Subscriptions in header.php
sub_header_desktop = r'<a class="text-white text-sm font-medium hover:text-secondary-container transition-all duration-200[^>]*? href="subscriptions\.php">اشتراک خودکار</a>'
sub_header_mobile = r'<a class="flex items-center gap-4 text-on-surface font-bold p-3 rounded-xl hover:bg-primary-container/10 hover:text-primary transition-colors" href="subscriptions\.php">[\s\S]*?</a>'

# User tickets in profile.php
tickets_profile_pattern = r'<a class="flex items-center gap-3 px-4 py-3 text-on-surface-variant hover:bg-surface-container-low rounded-xl transition-all" href="user_tickets\.php">[\s\S]*?</a>'

# Admin sidebar components
admin_sub_pattern = r"'subscriptions' => \['icon' => 'event_repeat', 'title' => 'مدیریت اشتراک‌ها', 'url' => 'subscriptions\.php'\],"
admin_campaign_pattern = r"'campaigns' => \['icon' => 'campaign', 'title' => 'مدیریت کمپین‌ها', 'url' => 'campaigns\.php'\],"

base_dir = '/opt/lampp/htdocs/petshop'

# STANDARD
remove_blocks(f"{base_dir}/standard/index.php", [chat_index_pattern])
remove_blocks(f"{base_dir}/standard/profile.php", [chat_profile_pattern])
remove_blocks(f"{base_dir}/standard/profile_settings.php", [rewards_settings_pattern])

# BASIC
remove_blocks(f"{base_dir}/basic/index.php", [chat_index_pattern])
remove_blocks(f"{base_dir}/basic/profile.php", [chat_profile_pattern, tickets_profile_pattern])
remove_blocks(f"{base_dir}/basic/profile_settings.php", [rewards_settings_pattern])
remove_blocks(f"{base_dir}/basic/includes/header.php", [sub_header_desktop, sub_header_mobile])
remove_blocks(f"{base_dir}/basic/admin/includes/admin_header.php", [admin_sub_pattern, admin_campaign_pattern])

print("Removed frontend components successfully.")
