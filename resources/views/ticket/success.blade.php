<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ticket Submitted | IT Helpdesk</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        * {
            box-sizing: border-box;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
            padding: 20px;
        }

        .success-card {
            background: #ffffff;
            padding: 40px 35px;
            border-radius: 16px;
            max-width: 480px;
            width: 100%;
            text-align: center;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            animation: fadeIn 0.8s ease-in-out;
            position: relative;
            overflow: hidden;
        }

        .success-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, #28a745, #20c997);
        }

        .success-icon {
            width: 100px;
            height: 100px;
            margin: 0 auto 25px;
            border-radius: 50%;
            background: linear-gradient(135deg, #28a745, #20c997);
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 8px 20px rgba(40, 167, 69, 0.3);
        }

        .success-icon i {
            color: #fff;
            font-size: 50px;
        }

        h1 {
            margin: 15px 0 10px;
            color: #2c3e50;
            font-size: 28px;
            font-weight: 700;
        }

        p {
            color: #555;
            font-size: 15px;
            line-height: 1.6;
            margin-bottom: 15px;
        }

        .ticket-info {
            background: #f8f9fa;
            border-left: 4px solid #28a745;
            padding: 16px;
            margin: 25px 0;
            text-align: left;
            font-size: 14px;
            border-radius: 0 8px 8px 0;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
        }

        .ticket-info p {
            margin: 10px 0;
            display: flex;
            align-items: center;
        }

        .ticket-info i {
            margin-right: 10px;
            color: #28a745;
            width: 20px;
        }

        .ticket-info strong {
            color: #333;
            font-weight: 600;
            margin-right: 8px;
        }

        .important-note {
            background: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 16px;
            margin: 20px 0;
            text-align: left;
            font-size: 14px;
            border-radius: 0 8px 8px 0;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
        }

        .important-note p {
            margin: 0;
            color: #856404;
            display: flex;
            align-items: flex-start;
        }

        .important-note i {
            margin-right: 10px;
            color: #ffc107;
            margin-top: 2px;
        }

        .btn-container {
            display: flex;
            gap: 15px;
            margin-top: 25px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 12px 28px;
            background: #e74c3c;
            color: #fff;
            text-decoration: none;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(231, 76, 60, 0.2);
        }

        .btn:hover {
            background: #c0392b;
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(231, 76, 60, 0.3);
        }

        .btn-home {
            background: #3498db;
            box-shadow: 0 4px 12px rgba(52, 152, 219, 0.2);
        }

        .btn-home:hover {
            background: #2980b9;
            box-shadow: 0 6px 15px rgba(52, 152, 219, 0.3);
        }

        .btn i {
            margin-right: 8px;
        }

        .footer-text {
            margin-top: 25px;
            font-size: 13px;
            color: #777;
            padding-top: 15px;
            border-top: 1px solid #eee;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 480px) {
            .success-card {
                padding: 30px 20px;
            }
            
            .btn-container {
                flex-direction: column;
            }
            
            .btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>

    <div class="success-card">
        <div class="success-icon">
            <i class="fas fa-check-circle"></i>
        </div>

        <h1>Ticket Submitted Successfully</h1>

        <p>
            Thank you for contacting the <strong>IT Helpdesk</strong>.
            Your request has been received and is currently under review.
        </p>

        <div class="ticket-info">
            <p><i class="fas fa-ticket-alt"></i> <strong>Ticket No:</strong> {{ $ticket->helpdesk_no }}</p>
            <p><i class="fas fa-envelope"></i> <strong>Email Address:</strong> {{ $ticket->email }}</p>
            <p><i class="fas fa-info-circle"></i> <strong>Status:</strong> <span style="color: #28a745; font-weight: 600;">{{ $ticket->status }}</span></p>
        </div>

        <div class="important-note">
            <p><i class="fas fa-exclamation-triangle"></i> 
                <strong>IMPORTANT:</strong> Please save your Ticket Number and Email Address for future reference and status tracking.
            </p>
        </div>

        <p>
            Our IT support team will contact you as soon as possible with updates on your request.
        </p>

        <div class="btn-container">
            <a href="/denrxi_ictsms/ticket/request" class="btn btn-home"><i class="fas fa-home"></i> Back to Ticket Request</a>
           
        </div>

        <p class="footer-text">
            For urgent matters, please call our IT support hotline: <strong>1-800-IT-HELP</strong>
        </p>
    </div>

</body>
</html>