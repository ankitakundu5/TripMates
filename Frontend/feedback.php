<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback - TripMates</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Global Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: #f8f8f8;
            color: #333;
            line-height: 1.6;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }
        
        /* Header */
        header {
            background-color: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 100;
        }
        
        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
        }
        
        .logo img {
            height: 40px;
        }
        
        /* Page Title */
        .page-title {
            background-color: #1A3A48;
            color: white;
            padding: 40px 0;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        .page-title::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('img/feedback-hero.jpg');
            background-size: cover;
            background-position: center;
            opacity: 0.3;
            z-index: -1;
        }
        
        .page-title h1 {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 10px;
        }
        
        .page-title p {
            font-size: 16px;
            max-width: 600px;
            margin: 0 auto;
        }
        
        /* Feedback Content */
        .feedback-container {
            max-width: 800px;
            margin: 40px auto;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }
        
        .section-title {
            font-size: 24px;
            font-weight: 600;
            color: #1A3A48;
            margin-bottom: 20px;
        }
        
        .form-group {
            margin-bottom: 25px;
        }
        
        .form-group label {
            display: block;
            font-size: 16px;
            font-weight: 500;
            margin-bottom: 10px;
            color: #555;
        }
        
        .form-group input, 
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 15px;
        }
        
        .form-group input:focus, 
        .form-group select:focus,
        .form-group textarea:focus {
            border-color: #FF7A00;
            outline: none;
        }
        
        .form-group textarea {
            min-height: 150px;
            resize: vertical;
        }
        
        .rating-group {
            display: flex;
            flex-direction: column;
            margin-bottom: 25px;
        }
        
        .rating-title {
            font-size: 16px;
            font-weight: 500;
            margin-bottom: 10px;
            color: #555;
        }
        
        .rating-options {
            display: flex;
            gap: 15px;
        }
        
        .rating-item {
            flex: 1;
            text-align: center;
        }
        
        .stars {
            font-size: 24px;
            color: #ddd;
            cursor: pointer;
            margin-bottom: 5px;
        }
        
        .stars .fas {
            color: #FFD700;
        }
        
        .rating-text {
            font-size: 12px;
            color: #777;
        }
        
        .image-upload {
            display: flex;
            flex-direction: column;
            gap: 15px;
            margin-bottom: 25px;
        }
        
        .upload-title {
            font-size: 16px;
            font-weight: 500;
            color: #555;
        }
        
        .upload-zone {
            border: 2px dashed #ddd;
            border-radius: 5px;
            padding: 30px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .upload-zone:hover {
            border-color: #FF7A00;
        }
        
        .upload-icon {
            font-size: 30px;
            color: #aaa;
            margin-bottom: 10px;
        }
        
        .upload-text {
            color: #777;
            margin-bottom: 10px;
        }
        
        .file-input {
            display: none;
        }
        
        .btn {
            background-color: #FF7A00;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 14px 25px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
        }
        
        .btn:hover {
            background-color: #e06e00;
        }
        
        .btn-container {
            text-align: center;
            margin-top: 20px;
        }
        
        /* Testimonials */
        .testimonials {
            margin: 60px 0;
        }
        
        .testimonials-title {
            text-align: center;
            font-size: 28px;
            font-weight: 600;
            color: #1A3A48;
            margin-bottom: 40px;
        }
        
        .testimonial-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 30px;
        }
        
        .testimonial-card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 25px;
            display: flex;
            flex-direction: column;
        }
        
        .testimonial-header {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }
        
        .testimonial-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 15px;
        }
        
        .testimonial-info h3 {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 3px;
        }
        
        .testimonial-info p {
            font-size: 13px;
            color: #777;
        }
        
        .testimonial-rating {
            color: #FFD700;
            font-size: 16px;
            margin-bottom: 15px;
        }
        
        .testimonial-text {
            color: #555;
            font-style: italic;
            margin-bottom: 15px;
            flex-grow: 1;
        }
        
        .testimonial-package {
            background-color: #f5f5f5;
            padding: 10px 15px;
            border-radius: 5px;
            font-size: 13px;
            font-weight: 500;
        }
        
        /* Footer */
        footer {
            background-color: #1A3A48;
            color: white;
            padding: 40px 0 20px;
        }
        
        .footer-content {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }
        
        .footer-logo {
            height: 40px;
            margin-bottom: 10px;
        }
        
        .footer-links {
            display: flex;
            flex-direction: column;
        }
        
        .footer-link {
            color: #ddd;
            text-decoration: none;
            margin-bottom: 8px;
            font-size: 14px;
        }
        
        .footer-social {
            display: flex;
            gap: 15px;
        }
        
        .social-icon {
            color: white;
            font-size: 18px;
        }
        
        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 20px;
            font-size: 13px;
            color: #aaa;
            text-align: center;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .rating-options {
                flex-wrap: wrap;
            }
            
            .testimonial-grid {
                grid-template-columns: 1fr;
            }
            
            .footer-content {
                flex-direction: column;
                gap: 30px;
            }
        }
    </style>
</head>
<body>

    <div class="page-title">
        <div class="container">
            <h1>Share Your Experience</h1>
            <p>Your feedback helps us improve and provides valuable insights for fellow travelers.</p>
        </div>
    </div>
    
    <!-- Feedback Form -->
    <div class="container">
        <div class="feedback-container">
            <h2 class="section-title">Leave Your Feedback</h2>
            
            <form>
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" id="name" placeholder="Enter your name">
                </div>
                
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" placeholder="Enter your email">
                </div>
                
                <div class="form-group">
                    <label for="package">Select Package</label>
                    <select id="package">
                        <option value="">Select the package you experienced</option>
                        <option value="kalabahal">Kalabahal Peak Trek</option>
                        <option value="beach">Beach Vacation Package</option>
                        <option value="city">City Explorer Tour</option>
                        <option value="wildlife">Wildlife Safari Adventure</option>
                    </select>
                </div>
                
                <div class="rating-group">
                    <p class="rating-title">How would you rate your overall experience?</p>
                    <div class="rating-options">
                        <div class="rating-item">
                            <div class="stars" data-rating="1">
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                            </div>
                            <p class="rating-text">Poor</p>
                        </div>
                        
                        <div class="rating-item">
                            <div class="stars" data-rating="2">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                            </div>
                            <p class="rating-text">Fair</p>
                        </div>
                        
                        <div class="rating-item">
                            <div class="stars" data-rating="3">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                            </div>
                            <p class="rating-text">Good</p>
                        </div>
                        
                        <div class="rating-item">
                            <div class="stars" data-rating="4">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                            </div>
                            <p class="rating-text">Very Good</p>
                        </div>
                        
                        <div class="rating-item">
                            <div class="stars" data-rating="5">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <p class="rating-text">Excellent</p>
                        </div>
                    </div>

                </div>
                <button>Submit</button>
                
      


            