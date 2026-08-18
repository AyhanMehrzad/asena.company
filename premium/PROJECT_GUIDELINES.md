# ASENA - Project Settings & Guidelines

This document serves as the absolute Source of Truth for the ASENA (ASENA) eCommerce platform. Whenever prompted to "make this page in our project settings" or "follow project guidelines", the rules within this document MUST be strictly followed.

## 1. Global Color Palette & Design System

The project uses a custom Material Design 3 inspired Tailwind CSS configuration located at `assets/js/tailwind-config.js`. 

### Key Brand Colors:
*   **Primary (`text-primary`, `bg-primary`)**: `#001a48` (Dark Navy Blue) - Used for primary headings, active states, and dominant branding.
*   **Primary Container (`bg-primary-container`)**: `#002d72` - Used for heavy call-to-action sections and hero backgrounds.
*   **Secondary (`bg-secondary`, `text-secondary`)**: `#954a00` - Used for secondary actions.
*   **Secondary Container (`bg-secondary-container`)**: `#fd8100` (Bright Orange) - Used heavily for "Add to Cart" buttons, sale tags, and highlights.
*   **Error (`bg-error`, `text-error`)**: `#ba1a1a` - Used for validation errors, sale prices, and delete actions.

### Typography & Layout:
*   **Font**: The project utilizes the `Geist` font family.
*   **Direction**: The entire application is Right-To-Left (RTL). All HTML tags must be `<html dir="rtl" lang="fa">`.
*   **Spacing**: 
    *   Maximum Container Width: `max-w-container-max` (1280px).
    *   Standard Desktop Padding: `px-margin-desktop` (24px).

## 2. Standard Page Structure

Every new frontend page MUST follow this exact skeletal structure to ensure the header, footer, and styling are perfectly consistent:

```php
<?php
require_once 'includes/db.php'; // ONLY if database access is needed

// [PHP Logic Here]

require_once 'includes/header.php'; // ALWAYS required
?>

<main class="max-w-container-max mx-auto overflow-hidden py-8 px-margin-desktop min-h-[70vh]">
    <!-- Page Content Goes Here -->
</main>

<?php include 'includes/footer.php'; // ALWAYS required ?>
```

## 3. Functional Requirements

### Database & Security
*   **Database Connection**: Always include `includes/db.php`.
*   **Queries**: STRICTLY use PDO Prepared Statements for all database interactions to prevent SQL injection. NEVER concatenate variables into SQL strings.
*   **Passwords**: Passwords must be hashed using `password_hash()` and verified using `password_verify()`.

### State Management & Forms
*   **Form Submissions**: Forms should ideally use `POST` for sensitive data (login, cart actions) and `GET` for filtering/search (shop page).
*   **Session Management**: User authentication is tracked via `$_SESSION['user_id']`. Pages requiring login must verify this session variable and redirect to `loginpage.php` if absent.

## 4. Component Library

### The ASENA Animated Product Card
This is the standard, user-approved design for product cards. It features rounded corners, a scaling image on hover, and an animated "Add to Cart" form that slides up from the bottom.

```html
<div class="bg-white rounded-3xl p-6 shadow-lg hover:shadow-2xl transition-all duration-300 group flex flex-col relative border border-outline-variant/10">
    <!-- Optional Badge -->
    <div class="absolute top-6 left-6 bg-secondary-container text-on-secondary-container text-label-sm px-3 py-1 rounded-full z-10 font-bold">تخفیف ویژه</div>

    <div class="aspect-square bg-surface-container-lowest rounded-2xl mb-6 overflow-hidden relative">
        <img src="path/to/image.jpg" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" alt="Product Name">
        
        <!-- Animated Add to Cart Overlay -->
        <form action="cart_action.php" method="POST" class="absolute inset-x-0 bottom-0 p-4 translate-y-full group-hover:translate-y-0 transition-transform duration-300 bg-gradient-to-t from-black/60 to-transparent flex justify-center z-20">
            <input type="hidden" name="product_id" value="[PRODUCT_ID]">
            <input type="hidden" name="action" value="add">
            <button type="submit" class="bg-primary text-white w-full py-3 rounded-xl font-bold flex justify-center items-center gap-2 hover:bg-primary-container">
                <span class="material-symbols-outlined">add_shopping_cart</span>
                افزودن به سبد
            </button>
        </form>
    </div>
    
    <div class="flex-1 flex flex-col">
        <p class="text-label-sm text-on-surface-variant mb-1">Category Name</p>
        <h3 class="text-title-lg font-bold text-on-surface mb-4 line-clamp-2">Product Name</h3>
        
        <div class="mt-auto flex justify-between items-center">
            <div class="flex flex-col">
                <!-- Discount Pricing State -->
                <span class="text-label-sm text-on-surface-variant line-through mb-1">200,000 تومان</span>
                <span class="text-title-lg font-bold text-primary">180,000 تومان</span>
            </div>
        </div>
    </div>
</div>
```

### Action Buttons
*   **Primary Action**: `<button class="bg-primary text-white py-3 px-6 rounded-lg font-bold hover:bg-primary-container transition-colors">Submit</button>`
*   **Secondary/Highlight Action (e.g., Cart)**: `<button class="bg-[#f97316] text-white py-2 px-4 font-bold rounded hover:bg-[#ea580c] transition-colors">Action</button>`
