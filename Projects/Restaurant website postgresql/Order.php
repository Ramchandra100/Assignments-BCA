<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Rest of the order.php content
?>
<!DOCTYPE html> 
<html lang="en"> 
<head> 
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Flavour Haven - Food Ordering</title> 
    <link rel="stylesheet" href="order_styles.css"> 
</head> 
<body> 
    <header> 
        <div class="container"> 
            <h1>Flavour Haven</h1> 
            <nav> 
                <ul> 
                    <li><a href="#breakfast">Breakfast</a></li> 
                    <li><a href="#appetizers">Appetizers</a></li> 
                    <li><a href="#drinks">Drinks</a></li> 
                    <li><a href="#cart">Cart <span id="cart-count">(0)</span></a></li> 
                </ul> 
            </nav> 
        </div> 
    </header> 
 
    <!-- Breakfast Section --> 
    <section id="breakfast" class="menu-section"> 
        <h2>Breakfast</h2> 
        <div class="menu-items"> 
            <div class="menu-item" data-name="Sheermal & Nihari" data-price="150"> 
                <img src="images/b1.png" alt="Sheermal & Nihari" width="150px" height="150px"> 
                <h3>Sheermal & Nihari</h3> 
                <p>Price: ₹150</p> 
                <button class="add-to-cart">Add to Cart</button> 
            </div> 
            <div class="menu-item" data-name="Paya Soup with Kulcha" data-price="120"> 
                <img src="images/b2.png" alt="Paya Soup with Kulcha" width="150px" height="150px"> 
                <h3>Paya Soup with Kulcha</h3> 
                <p>Price: ₹120</p> 
                <button class="add-to-cart">Add to Cart</button> 
            </div> 
            <div class="menu-item" data-name="Mughlai Paratha" data-price="100"> 
                <img src="images/b3.png" alt="Mughlai Paratha" width="150px" height="150px"> 
                <h3>Mughlai Paratha</h3> 
                <p>Price: ₹100</p> 
                <button class="add-to-cart">Add to Cart</button> 
            </div> 
            <div class="menu-item" data-name="Kesar Pista Halwa" data-price="80"> 
                <img src="images/b4.png" alt="Kesar Pista Halwa" width="150px" height="150px"> 
                <h3>Kesar Pista Halwa</h3> 
                <p>Price: ₹80</p> 
                <button class="add-to-cart">Add to Cart</button> 
            </div> 
            <div class="menu-item" data-name="Bedmi Puri with Aloo Sabzi" data-price="90"> 
                <img src="images/b5.png" alt="Bedmi Puri with Aloo Sabzi" width="150px" height="150px"> 
                <h3>Bedmi Puri with Aloo Sabzi</h3> 
                <p>Price: ₹90</p> 
                <button class="add-to-cart">Add to Cart</button> 
            </div> 
            <div class="menu-item" data-name="Chhena Poda" data-price="110"> 
                <img src="images/b6.png" alt="Chhena Poda" width="150px" height="150px"> 
                <h3>Chhena Poda</h3> 
                <p>Price: ₹110</p> 
                <button class="add-to-cart">Add to Cart</button> 
            </div> 
            <div class="menu-item" data-name="Hyberbadi Khichdi" data-price="130"> 
                <img src="images/b7.png" alt="Hyberbadi Khichdi" width="150px" height="150px"> 
                <h3>Hyberbadi Khichdi</h3> 
                <p>Price: ₹130</p> 
                <button class="add-to-cart">Add to Cart</button> 
            </div> 
            <div class="menu-item" data-name="Lucknowi Chole Bhature" data-price="140"> 
                <img src="images/b8.png" alt="Lucknowi Chole Bhature" width="150px" height="150px"> 
                <h3>Lucknowi Chole Bhature</h3> 
                <p>Price: ₹140</p> 
                <button class="add-to-cart">Add to Cart</button> 
            </div> 
        </div> 
    </section> 
 
    <!-- Appetizers Section --> 
    <section id="appetizers" class="menu-section"> 
        <h2>Appetizers</h2> 
        <div class="menu-items"> 
            <div class="menu-item" data-name="Shahi Galouti Kebab" data-price="50"> 
                <img src="images/a1.png" alt="Shahi Galouti Kebab" width="150px" height="150px"> 
                <h3>Shahi Galouti Kebab</h3> 
                <p>Price: ₹50</p> 
                <button class="add-to-cart">Add to Cart</button> 
            </div>  
        <div class="menu-item" data-name="Dahi Ke Kebab" data-price="180"> 
            <img src="images/a3.png" alt="Dahi Ke Kebab" width="150px" height="150px"> 
            <h3>Dahi Ke Kebab</h3> 
            <p>Price: ₹180</p> 
            <button class="add-to-cart">Add to Cart</button> 
        </div> 
        <div class="menu-item" data-name="Murg Malai Tikka" data-price="150"> 
            <img src="images/a2.png" alt="Murg Malai Tikka" width="150px" height="150px"> 
            <h3>Murg Malai Tikka</h3> 
            <p>Price: ₹150</p> 
            <button class="add-to-cart">Add to Cart</button> 
        </div> 
        <div class="menu-item" data-name="Zafrani Paneer Tikka" data-price="130"> 
            <img src="images/a4.png" alt="Zafrani Paneer Tikka" width="150px" height="150px"> 
            <h3>Zafrani Paneer Tikka</h3> 
            <p>Price: ₹130</p> 
            <button class="add-to-cart">Add to Cart</button> 
        </div> 
        <div class="menu-item" data-name="Nizami Seekh Kebab" data-price="100"> 
            <img src="images/a5.png" alt="Nizami Seekh Kebab" width="150px" height="150px"> 
            <h3>Nizami Seekh Kebab</h3> 
            <p>Price: ₹100</p> 
            <button class="add-to-cart">Add to Cart</button> 
        </div> 
        <div class="menu-item" data-name="Khumb Galouti" data-price="80"> 
            <img src="images/a6.png" alt="Khumb Galouti" width="150px" height="150px"> 
            <h3>Khumb Galouti</h3> 
            <p>Price: ₹80</p> 
            <button class="add-to-cart">Add to Cart</button> 
        </div> 
        <div class="menu-item" data-name="Makhmali Fish Tikka" data-price="90"> 
            <img src="images/a7.png" alt="Makhmali Fish Tikka" width="150px" height="150px"> 
            <h3>Makhmali Fish Tikka</h3> 
            <p>Price: ₹90</p> 
            <button class="add-to-cart">Add to Cart</button> 
        </div> 
        <div class="menu-item" data-name="Stuffed Tandoori Aloo" data-price="160"> 
            <img src="images/a8.png" alt="Stuffed Tandoori Aloo" width="150px" height="150px"> 
            <h3>Stuffed Tandoori Aloo</h3> 
            <p>Price: ₹160</p> 
            <button class="add-to-cart">Add to Cart</button> 
        </div> 
    </div> 
    </section> 
 
    <!-- Drinks Section --> 
    <section id="drinks" class="menu-section"> 
        <h2>Drinks</h2> 
        <div class="menu-items"> 
            <div class="menu-item" data-name="Badam Sharbat" data-price="30"> 
                <img src="images/d1.png" alt="Badam Sharbat" width="150px" height="150px"> 
                <h3>Badam Sharbat</h3> 
                <p>Price: ₹30</p> 
                <button class="add-to-cart">Add to Cart</button> 
            </div> 
            <div class="menu-item" data-name="Kesariya Thandai" data-price="80"> 
                <img src="images/d2.png" alt="Kesariya Thandai" width="150px" height="150px"> 
                <h3>Kesariya Thandai</h3> 
                <p>Price: ₹80</p> 
                <button class="add-to-cart">Add to Cart</button> 
            </div>  
            <div class="menu-item" data-name="Rose Lassi" data-price="90"> 
                <img src="images/d3.png" alt="Rose Lassi" width="150px" height="150px"> 
                <h3>Rose Lassi</h3> 
                <p>Price: ₹90</p> 
                <button class="add-to-cart">Add to Cart</button> 
            </div> 
            <div class="menu-item" data-name="Kesar Chai" data-price="50"> 
                <img src="images/d4.png" alt="Kesar Chai" width="150px" height="150px"> 
                <h3>Kesar Chai</h3> 
                <p>Price: ₹50</p> 
                <button class="add-to-cart">Add to Cart</button> 
            </div> 
            <div class="menu-item" data-name="Paan Shots" data-price="60"> 
                <img src="images/d5.png" alt="Paan Shots" width="150px" height="150px"> 
                <h3>Paan Shots</h3> 
                <p>Price: ₹60</p> 
                <button class="add-to-cart">Add to Cart</button> 
            </div> 
            <div class="menu-item" data-name="Zafrani Kahwa" data-price="100"> 
                <img src="images/d6.png" alt="Zafrani Kahwa" width="150px" height="150px"   > 
                <h3>Zafrani Kahwa</h3> 
                <p>Price: ₹100</p> 
                <button class="add-to-cart">Add to Cart</button> 
            </div>  
        </div> 
    </section> 
 
    <!-- Cart Section -->
<section id="cart" class="cart-section">
    <h2>Your Cart</h2>
    <div id="cart-items">
    <p>No items in your cart.</p>
    </div>
    <div id="cart-summary" style="display: none;">
    <div class="summary-row">
    <span>Subtotal:</span>
    <span id="cart-subtotal">₹0</span>
    </div>
    <div class="summary-row">
    <span>Tax (5%):</span>
    <span id="cart-tax">₹0</span>
    </div>
    <div class="summary-row total">
    <span>Total:</span>
    <span id="cart-total">₹0</span>
    </div>
    </div>
    <div class="cart-actions">
    <button id="clear-cart" disabled>Clear Cart</button>
    <button id="checkout" disabled>Proceed to Checkout</button>
    </div>
    <!-- Payment Modal -->
    <div id="payment-modal" class="modal">
    <div class="modal-content">
    <span class="close">&times;</span>
    <h2>Complete Your Order</h2>
    <form id="payment-form">
    <div class="form-group">
    <label for="name">Full Name</label>
    <input type="text" id="name" required>
    </div>
    <div class="form-group">
    <label for="email">Email</label>
    <input type="email" id="email" required>
    </div>
    <div class="form-group">
    <label for="address">Delivery Address</label>
    <textarea id="address" rows="3" required></textarea>
    </div>
    <div class="form-group">
    <label for="card-element">Credit or Debit Card</label>
    <div id="card-element" class="card-element"></div>
    <div id="card-errors" role="alert"></div>
    </div>
    <button type="submit" id="submit-payment">
    <span id="button-text">Pay ₹<span id="payment-amount">0</span></span>
    <span id="payment-spinner" class="spinner" style="display: none;"></span>
    </button>
    </form>
    </div>
    </div>
    <!-- Order Confirmation Modal -->
    <div id="confirmation-modal" class="modal">
    <div class="modal-content confirmation">
    <h2>Order Confirmed!</h2>
    <p>Thank you for your order. Your food will be prepared fresh and delivered
    soon.</p>
    <p>Order ID: <span id="order-id"></span></p>
    <p>A confirmation has been sent to <span id="confirmation-email"></span></p>
    <button id="close-confirmation">Continue Shopping</button>
    </div>
    </div>
    </section>
 
    <script src="order_script.js"></script> 
</body> 
</html> 
