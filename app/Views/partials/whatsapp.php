<?php
// 1. Configuration - Change these to your details
$country_code    = "233";          // Country code without the + or 00 (e.g., 1 for USA, 44 for UK, 91 for India)
$phone_number    = "506617880"; // Your full mobile number without leading zeros or spaces
$default_message = "Hello! I am visiting your website and have a question.";

// 2. Process the data
$full_number     = $country_code . $phone_number;
$encoded_message = urlencode($default_message);

// 3. Generate the universal WhatsApp link
$whatsapp_url    = "https://wa.me/{$full_number}?text={$encoded_message}";
?>

<!-- The Floating WhatsApp Button -->
<a href="<?php echo $whatsapp_url; ?>" target="_blank" rel="noopener noreferrer" class="whatsapp-floating-button"
    aria-label="Chat with us on WhatsApp">
    <!-- SVG WhatsApp Icon for crisp scaling on all screens -->
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
        <path
            d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946C.06 5.348 5.397.01 12.008.01c3.202.001 6.212 1.246 8.477 3.513 2.266 2.268 3.507 5.28 3.505 8.484-.004 6.657-5.34 11.997-11.953 11.997-2.005-.001-3.973-.502-5.713-1.457L0 24zm6.59-4.846c1.6.95 3.188 1.449 4.825 1.451 5.436 0 9.86-4.37 9.863-9.748.002-2.607-1.01-5.059-2.85-6.902C16.642 2.113 14.193.998 11.59.998c-5.442 0-9.866 4.372-9.87 9.75-.002 1.733.458 3.423 1.332 4.927l-.995 3.635 3.722-.962zm10.83-3.705c-.27-.135-1.593-.787-1.839-.877-.246-.09-.425-.135-.605.135-.179.27-.696.877-.852 1.057-.157.18-.313.202-.583.067-.27-.135-1.138-.419-2.167-1.338-.802-.714-1.342-1.597-1.5-1.867-.157-.27-.017-.416.118-.55.121-.121.27-.315.405-.472.135-.158.179-.27.27-.449.09-.18.045-.338-.023-.473-.067-.135-.605-1.462-.828-2.003-.217-.521-.456-.45-.625-.459-.16-.009-.344-.01-.528-.01-.184 0-.485.07-.738.347-.254.277-.969.947-.969 2.309 0 1.361.991 2.676 1.129 2.859.137.184 1.948 2.974 4.719 4.168.659.284 1.174.454 1.576.581.662.21 1.265.18 1.742.109.531-.08 1.592-.649 1.816-1.277.225-.629.225-1.17.157-1.282-.069-.107-.253-.173-.523-.307z" />
    </svg>
    <span>Chat with us</span>
</a>


<style>
    .whatsapp-floating-button {
        position: fixed;
        bottom: 100px;
        right: 25px;
        background-color: #25D366;
        color: #ffffff;
        text-decoration: none;
        font-family: Arial, sans-serif;
        font-size: 15px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 20px;
        border-radius: 50px;
        box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.15);
        z-index: 9999;
        transition: transform 0.2s ease, background-color 0.2s ease;
    }

    /* Hover Effect */
    .whatsapp-floating-button:hover {
        background-color: #128C7E;
        transform: scale(1.05);
        color: #ffffff;
    }

    /* Optional: Hide the text on mobile screens to just show a neat round icon */
    @media (max-width: 480px) {
        .whatsapp-floating-button {
            padding: 14px;
            bottom: 20px;
            right: 20px;
        }

        .whatsapp-floating-button span {
            display: none;
        }
    }
</style>