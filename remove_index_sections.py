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

base_dir = '/opt/lampp/htdocs/petshop'

# Regex for Subscription Plans
sub_pattern = r'<!-- Subscription Plans -->.*?<!-- AI Clinical Assistant & Support -->'

# Regex for AI Assistant
ai_pattern = r'<!-- AI Clinical Assistant & Support -->.*?<!-- Charity Section -->'

# In BASIC: Remove both Subscriptions and AI Assistant. Since removing sub_pattern removes the start of ai_pattern,
# we need to be careful. Better to combine or run sequentially.
# Wait, if we run sequentially, sub_pattern removes up to the AI comment, so the AI comment is gone!
# Let's adjust the patterns to lookahead or just combine them for BASIC.

sub_pattern_standalone = r'<!-- Subscription Plans -->.*?(?=<!-- AI Clinical Assistant & Support -->)'
ai_pattern_standalone = r'<!-- AI Clinical Assistant & Support -->.*?(?=<!-- Charity Section -->)'

# In STANDARD: Remove only AI Assistant
remove_blocks(f"{base_dir}/standard/index.php", [ai_pattern_standalone])

# In BASIC: Remove both
remove_blocks(f"{base_dir}/basic/index.php", [sub_pattern_standalone, ai_pattern_standalone])

print("Removed index sections successfully.")
