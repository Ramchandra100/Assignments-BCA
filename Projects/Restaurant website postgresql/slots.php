<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Rest of the slots.php content
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Flavor Haven - Reservations</title>
<!-- Same assets as your main site 
<link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link
href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;700&family=Forum&di
splay=swap" rel="stylesheet"> -->
<link rel="stylesheet" href="./assets/css/style.css">
</head>
<body id="top">
<!-- #PRELOADER -->
<div class="preload" data-preaload>
<div class="circle"></div>
<p class="text">Flavor Haven</p>
</div>
<!-- #HEADER -->
<header class="header" data-header>
<div class="container">
<a href="index.php" class="logo">
<!--<img src="./assets/images/logo.svg" width="160" height="50" alt="Flavor Haven -
Home">-->
</a>
<nav class="navbar" data-navbar>
<!-- Your existing navbar content -->
</nav>
<a href="index.php" class="btn btn-secondary">
<span class="text text-1">Back to Home</span>
<span class="text text-2" aria-hidden="true">Back to Home</span>
</a>
<button class="nav-open-btn" aria-label="open menu" data-nav-toggler>
<span class="line line-1"></span>
<span class="line line-2"></span>
<span class="line line-3"></span>
</button>
<div class="overlay" data-nav-toggler data-overlay></div>
</div>
</header>
<main>
<article>
<!-- RESERVATIONS SECTION -->
<section class="section reservation-list bg-black-10">
<div class="container">
<p class="section-subtitle label-2 text-center">Your Bookings</p>
<h2 class="section-title headline-1 text-center">Reservation Details</h2>
<div class="reservation-grid" id="reservationGrid">
<!-- Reservations will be loaded here by JavaScript -->
<p class="text-center body-4">Loading your reservations...</p>
</div>
<div class="text-center">
<a href="index.php" class="btn btn-primary">
<span class="text text-1">Book Another Table</span>
<span class="text text-2" aria-hidden="true">Book Another Table</span>
</a>
</div>
</div>
</section>
</article>
</main>
<!-- FOOTER -->
<footer class="footer section has-bg-image" style="background-image:
url('./assets/images/footer-bg.jpg')">
<!-- Your existing footer content -->
</footer>
<!-- BACK TO TOP -->
<a href="#top" class="back-top-btn active" aria-label="back to top" data-back-top-btn>
<ion-icon name="chevron-up" aria-hidden="true"></ion-icon>
</a>
<!-- SCRIPTS -->
<script src="./assets/js/script.js"></script>
<script type="module"
src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule
src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<!-- Reservation Display Script -->
<script>
document.addEventListener("DOMContentLoaded", function() {
// Load reservations from local storage
const reservations = JSON.parse(localStorage.getItem("reservations")) || [];
const reservationGrid = document.getElementById("reservationGrid");
if (reservations.length === 0) {
reservationGrid.innerHTML = `
<div class="text-center">
<p class="body-4">You haven't made any reservations yet.</p>
<a href="index.php" class="btn-text hover-underline label-2">Book a table now</a>
</div>
`;
return;
}
// Sort reservations by date (newest first)
reservations.sort((a, b) => new Date(b.timestamp) - new Date(a.timestamp));
// Display reservations
reservationGrid.innerHTML = '';
reservations.forEach(reservation => {
const reservationCard = document.createElement("div");
reservationCard.className = "reservation-card has-before hover:shine";
reservationCard.innerHTML = `
<div class="card-content">
<div class="flex-between">
<h3 class="title-3">${reservation.name}</h3>
<span class="label-1">${reservation.phone}</span>
</div>
<div class="reservation-details">
<div class="detail-item">
<ion-icon name="people-outline"></ion-icon>
<span>${reservation.persons.replace("-", " ")}</span>
</div>
<div class="detail-item">
<ion-icon name="calendar-outline"></ion-icon>
<span>${formatDate(reservation.date)}</span>
</div>
<div class="detail-item">
<ion-icon name="time-outline"></ion-icon>
<span>${reservation.time}</span>
</div>
</div>
${reservation.message ? `<p class="reservation-notes
body-4"><strong>Notes:</strong> ${reservation.message}</p>` : ''}
<button class="cancel-btn btn-text hover-underline label-2"
data-timestamp="${reservation.timestamp}">
Cancel Reservation
</button>
</div>
`;
reservationGrid.appendChild(reservationCard);
});
// Add cancel button event listeners
document.querySelectorAll(".cancel-btn").forEach(button => {
button.addEventListener("click", function() {
const timestamp = this.getAttribute("data-timestamp");
cancelReservation(timestamp);
});
});
});
function formatDate(dateString) {
const options = { year: 'numeric', month: 'long', day: 'numeric', weekday: 'long' };
return new Date(dateString).toLocaleDateString('en-US', options);
}
function cancelReservation(timestamp) {
let reservations = JSON.parse(localStorage.getItem("reservations")) || [];
reservations = reservations.filter(res => res.timestamp !== timestamp);
localStorage.setItem("reservations", JSON.stringify(reservations));
// Reload the page to show updated list
location.reload();
}
</script>
</body>
</html>