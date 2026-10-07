# Implementation Plan - Express-Van Feature Enhancements

This plan outlines the implementation of five major features for the Express-Van application: a Discount & Promo Code System, a Quick Booking interface for admins, property-level Postcode Lookup, manual Payment Reminders, and automated Calendar Sync.

## User Review Required

> [!IMPORTANT]
> **API Keys Required**: The user will need to provide API keys for:
> 1. [Ideal Postcodes](https://ideal-postcodes.co.uk) (for property-level address lookup).
> 2. Google Cloud Console (for Calendar API and Maps Autocomplete).
> 3. Microsoft Azure (if Outlook Calendar sync is required).

> [!WARNING]
> **Database Changes**: This implementation involves creating new tables and modifying existing ones. We will use Laravel migrations to ensure a smooth transition.

## Proposed Changes

### 1. Discount & Promo Code System
Implement a full-featured discount system for removal bookings.

#### [NEW] [RemovalCoupon.php](file:///d:/xampp/htdocs/express-van/@core/app/RemovalCoupon.php)
#### [NEW] [RemovalCouponUsage.php](file:///d:/xampp/htdocs/express-van/@core/app/RemovalCouponUsage.php)
*   **Database**: Create `removal_coupons` table (code, type, value, expiry, limits, min_spend) and `removal_coupon_usages` table.
*   **Admin UI**: Create a management interface in the backend to CRUD coupons.
*   **Logic**:
    *   Validation logic: Check expiry, limits, and minimum spend.
    *   Non-stackable by default.
    *   Server-side calculation in `BookController.php` to prevent price manipulation.
*   **Frontend**: Add a "Promo Code" input in the checkout/basket area with real-time AJAX validation.

### 2. Quick Booking (Admin Backend)
A minimalist interface for admins to manually add bookings.

#### [MODIFY] [AdminDashboardController.php](file:///d:/xampp/htdocs/express-van/@core/app/Http/Controllers/AdminDashboardController.php)
*   **Modal**: Implement a pop-up modal using Blade and JavaScript.
*   **Data Entry**: Quick form for customer contact, logistics (with Google Maps autocomplete), and inventory.
*   **Integration**: Add "Quick Add" button to the dashboard and trigger from the admin calendar.

### 3. Property-Level Postcode Lookup
Integrate Ideal Postcodes for accurate address selection.

#### [MODIFY] [address.blade.php](file:///d:/xampp/htdocs/express-van/@core/resources/views/frontend/pages/book/address.blade.php)
*   Replace/Enhance the existing postcode field with a lookup trigger.
*   Implement a dropdown for selecting specific properties (Door numbers/Flat names).
*   Auto-populate Address Line 1, City, and Postcode.

### 4. Payment Reminder System
Allow admins to manually remind customers of pending payments.

#### [MODIFY] [view.blade.php](file:///d:/xampp/htdocs/express-van/@core/resources/views/backend/pages/removal/view.blade.php)
*   Add a "Send Payment Reminder" button for bookings with "Pending Payment" status.
#### [NEW] [PaymentReminder.php](file:///d:/xampp/htdocs/express-van/@core/app/Mail/PaymentReminder.php)
*   Dynamic HTML email template with a direct link to the payment page.
*   Activity log to track when reminders were sent.

### 5. Booking-to-Calendar Sync
Automatically push bookings to Google/Outlook calendars.

#### [NEW] [CalendarSyncService.php](file:///d:/xampp/htdocs/express-van/@core/app/Services/CalendarSyncService.php)
*   **OAuth 2.0**: Integrate Socialite for Google/Microsoft authentication.
*   **Sync Logic**: Automatically push events on booking confirmation. Update/Delete events when bookings change or are cancelled.
*   **Settings Page**: Allow users/admins to connect their calendar and toggle sync options.

---

## Open Questions

1.  **Ideal Postcodes Plan**: Do you already have an account with Ideal Postcodes, or would you like me to use a placeholder configuration for now?
2.  **Calendar Sync Target**: Should the sync be for the **Admin's** main business calendar (all bookings) or for the **Customer's** personal calendar (their own booking), or both?
3.  **Personalized Note**: For the payment reminder, would you like a small text box to appear for adding a personal message, or should it be a one-click automated email?

## Verification Plan

### Automated Tests
*   `php artisan test` (if applicable).
*   Validation tests for coupon logic (expiry, limits, min spend).

### Manual Verification
*   **Discount System**: Test various coupon types (%, Fixed) and constraints.
*   **Quick Booking**: Verify manual entries appear correctly on the dashboard and calendar.
*   **Postcode Lookup**: Test with several UK postcodes to ensure property-level data is fetched.
*   **Payment Reminder**: Verify email delivery and payment link functionality.
*   **Calendar Sync**: Connect a test Google account and verify event creation/updates.
