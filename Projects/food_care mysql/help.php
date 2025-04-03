
<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ & Help | Food Management System</title>
    
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to right, #11998e, #38ef7d);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            color: white;
        }
        .faq-container {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            width: 60%;
            max-width: 800px;
            text-align: center;
        }
        h1 {
            color: #1e3c72;
            font-size: 32px;
            margin-bottom: 10px;
        }
        #faq-search {
            width: 95%;
            padding: 12px;
            margin: 15px 0;
            border: 2px solid #1e3c72;
            border-radius: 8px;
            font-size: 16px;
        }
        .faq-item {
            margin: 15px 0;
        }
        .faq-question {
            background: #1e3c72;
            color: white;
            border: none;
            padding: 14px;
            width: 100%;
            text-align: left;
            cursor: pointer;
            border-radius: 8px;
            font-size: 18px;
            transition: background 0.3s, transform 0.2s;
        }
        .faq-question:hover {
            background: #0d2a51;
            transform: scale(1.02);
        }
        .faq-answer {
            display: none;
            background: #f5f5f5;
            padding: 12px;
            margin-top: 6px;
            border-radius: 8px;
            font-size: 16px;
            color: #333;
            text-align: left;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }
        @media screen and (max-width: 768px) {
            .faq-container {
                width: 90%;
            }
        }
    </style>
</head>
<body>
    <div class="faq-container">
        <h1>❓ Frequently Asked Questions</h1>
        <p>Find answers to common questions about our food management system.</p>
        <input type="text" id="faq-search" placeholder="🔍 Search for a question...">
        <div class="faq-list">
            <div class="faq-item">
                <button class="faq-question">📌 How can I donate food?</button>
                <div class="faq-answer"><p>Sign up as a donor, select food items, and schedule pickup.</p></div>
            </div>
            <div class="faq-item">
                <button class="faq-question">📌 How does location tracking work?</button>
                <div class="faq-answer"><p>We use geolocation to find nearby food donation points.</p></div>
            </div>
            <div class="faq-item">
                <button class="faq-question">📌 Is there a fee for using this service?</button>
                <div class="faq-answer"><p>No, our platform is completely free for donors and beneficiaries.</p></div>
            </div>
            <div class="faq-item">
                <button class="faq-question">📌 Who can I contact for support?</button>
                <div class="faq-answer"><p>Email us at <b>support@foodmanagement.com</b>.</p></div>
            </div>
            <div class="faq-item">
                <button class="faq-question">📌 How can I track my food donation status?</button>
                <div class="faq-answer"><p>Log in to your dashboard to view donation approvals and status updates.</p></div>
            </div>
            <div class="faq-item">
                <button class="faq-question">📌 What happens if my food request is rejected?</button>
                <div class="faq-answer"><p>If a request is rejected, you can try requesting another available food item.</p></div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const faqQuestions = document.querySelectorAll(".faq-question");
            faqQuestions.forEach((question) => {
                question.addEventListener("click", function () {
                    const answer = this.nextElementSibling;
                    if (answer.style.display === "block") {
                        answer.style.display = "none";
                    } else {
                        document.querySelectorAll(".faq-answer").forEach((faq) => {
                            faq.style.display = "none";
                        });
                        answer.style.display = "block";
                    }
                });
            });
            document.getElementById("faq-search").addEventListener("input", function () {
                let searchQuery = this.value.toLowerCase();
                document.querySelectorAll(".faq-item").forEach((item) => {
                    let questionText = item.querySelector(".faq-question").innerText.toLowerCase();
                    item.style.display = questionText.includes(searchQuery) ? "block" : "none";
                });
            });
        });
    </script>
</body>
</html>
