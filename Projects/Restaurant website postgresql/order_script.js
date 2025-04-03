document.addEventListener("DOMContentLoaded", () => {
    const cart = [];
    const cartItemsContainer = document.getElementById("cart-items");
    const cartCount = document.getElementById("cart-count");
    const checkoutButton = document.getElementById("checkout");
    const clearCartButton = document.getElementById("clear-cart");
    const cartSummary = document.getElementById("cart-summary");
    const cartSubtotal = document.getElementById("cart-subtotal");
    const cartTax = document.getElementById("cart-tax");
    const cartTotal = document.getElementById("cart-total");
    // Modal elements
    const paymentModal = document.getElementById("payment-modal");
    const paymentForm = document.getElementById("payment-form");
    const paymentAmount = document.getElementById("payment-amount");
    const closeModal = document.querySelector(".close");
    const closeConfirmation = document.getElementById("close-confirmation");
    const confirmationModal = document.getElementById("confirmation-modal");
    const orderIdElement = document.getElementById("order-id");
    const confirmationEmail = document.getElementById("confirmation-email");
    // Calculate cart totals
    function calculateTotals() {
    const subtotal = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
    const tax = subtotal * 0.05; // 5% tax
    const total = subtotal + tax;
    cartSubtotal.textContent = `₹${subtotal.toFixed(2)}`;
    cartTax.textContent = `₹${tax.toFixed(2)}`;
    cartTotal.textContent = `₹${total.toFixed(2)}`;
    paymentAmount.textContent = total.toFixed(2);
    return total;
    }
    // Update cart display
    function updateCart() {
    cartItemsContainer.innerHTML = "";
    if (cart.length === 0) {
    cartItemsContainer.innerHTML = "<p>No items in your cart.</p>";
    checkoutButton.disabled = true;
    clearCartButton.disabled = true;
    cartSummary.style.display = "none";
    } else {
    checkoutButton.disabled = false;
    clearCartButton.disabled = false;
    cartSummary.style.display = "block";
    cart.forEach((item, index) => {
    const cartItem = document.createElement("div");
    cartItem.classList.add("cart-item");
    cartItem.innerHTML = `
    <div class="cart-item-info">
    <h3>${item.name}</h3>
    <p>₹${item.price} each</p>
    </div>
    <div class="cart-item-controls">
    <button class="quantity-btn minus" data-index="${index}">-</button>
    <span class="quantity-display">${item.quantity}</span>
    <button class="quantity-btn plus" data-index="${index}">+</button>
    <button class="remove-btn" data-index="${index}">Remove</button>
    </div>
    `;
    cartItemsContainer.appendChild(cartItem);
    });
    // Add event listeners to all buttons
    document.querySelectorAll(".remove-btn").forEach(button => {
    button.addEventListener("click", (e) => {
    const index = e.target.getAttribute("data-index");
    removeFromCart(index);
    });
    });
    document.querySelectorAll(".quantity-btn.minus").forEach(button => {
    button.addEventListener("click", (e) => {
    const index = e.target.getAttribute("data-index");
    updateQuantity(index, -1);
    });
    });
    document.querySelectorAll(".quantity-btn.plus").forEach(button => {
    button.addEventListener("click", (e) => {
    const index = e.target.getAttribute("data-index");
    updateQuantity(index, 1);
    });
    });
    }
    cartCount.textContent = `(${cart.reduce((sum, item) => sum + item.quantity, 0)})`;
    calculateTotals();
    }
    // Add item to cart
    function addToCart(name, price) {
    const existingItem = cart.find(item => item.name === name);
    if (existingItem) {
    existingItem.quantity += 1;
    } else {
    cart.push({ name, price, quantity: 1 });
    }
    updateCart();
    }
    // Remove item from cart
    function removeFromCart(index) {
    cart.splice(index, 1);
    updateCart();
    }
    // Update item quantity
    function updateQuantity(index, change) {
    const newQuantity = cart[index].quantity + change;
    if (newQuantity < 1) {
    removeFromCart(index);
    } else {
    cart[index].quantity = newQuantity;
    updateCart();
    }
    }
    // Clear cart
    function clearCart() {
    cart.length = 0;
    updateCart();
    }
    // Handle checkout
    function handleCheckout() {
    paymentModal.style.display = "block";
    }
    // Handle form submission (simulated payment)
    function handlePayment(e) {
    e.preventDefault();
    const submitButton = document.getElementById('submit-payment');
    const buttonText = document.getElementById('button-text');
    const spinner = document.getElementById('payment-spinner');
    // Show loading state
    buttonText.style.display = 'none';
    spinner.style.display = 'block';
    submitButton.disabled = true;
    // Simulate payment processing delay
    setTimeout(() => {
    // Hide payment modal
    paymentModal.style.display = 'none';
    // Reset form
    paymentForm.reset();
    // Reset button
    buttonText.style.display = 'inline';
    spinner.style.display = 'none';
    submitButton.disabled = false;
    // Show confirmation
    const orderId = 'ORD-' + Math.floor(Math.random() * 1000000);
    orderIdElement.textContent = orderId;
    confirmationEmail.textContent = document.getElementById('email').value;
    confirmationModal.style.display = 'block';
    // Clear cart
    clearCart();
    }, 1500);
    }
    // Close modal
    function closePaymentModal() {
    paymentModal.style.display = 'none';
    }
    // Close confirmation modal
    function closeConfirmationModal() {
    confirmationModal.style.display = 'none';
    }
    // Close modals when clicking outside
    window.addEventListener('click', (e) => {
    if (e.target === paymentModal) {
    closePaymentModal();
    }
    if (e.target === confirmationModal) {
    closeConfirmationModal();
    }
    });
    // Event listeners
    document.querySelectorAll(".add-to-cart").forEach(button => {
    button.addEventListener("click", (e) => {
    const item = e.target.closest(".menu-item");
    const name = item.getAttribute("data-name");
    const price = parseInt(item.getAttribute("data-price"));
    addToCart(name, price);
    // Add animation to cart button
    const cartLink = document.querySelector('a[href="#cart"]');
    cartLink.classList.add('pulse');
    setTimeout(() => {
    cartLink.classList.remove('pulse');
    }, 1000);
    });
    });
    clearCartButton.addEventListener("click", clearCart);
    checkoutButton.addEventListener("click", handleCheckout);
    closeModal.addEventListener("click", closePaymentModal);
    closeConfirmation.addEventListener("click", closeConfirmationModal);
    paymentForm.addEventListener("submit", handlePayment);
    // Initialize
    updateCart();
    // Add pulse animation for cart button
    const style = document.createElement('style');
    style.textContent = `
    @keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.1); }
    100% { transform: scale(1); }
    }
    .pulse {
    animation: pulse 0.5s ease;
    }
    `;
    document.head.appendChild(style);
    });