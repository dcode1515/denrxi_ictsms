<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Ticket Update Notification</title>
</head>

<body style="margin:0; padding:0; background-color:#f4f6f8; font-family: Arial, Helvetica, sans-serif;">

<table width="100%" cellpadding="0" cellspacing="0">
    <tr>
        <td align="center" style="padding:30px 15px;">

            <table width="600" cellpadding="0" cellspacing="0"
                   style="background:#ffffff; border-radius:6px; overflow:hidden;">

                <!-- HEADER -->
                <tr>
                    <td style="background:#146c43; color:#ffffff; padding:20px;">
                        <table width="100%" cellpadding="0" cellspacing="0">
                            <tr>
                                <td align="left">
                                    <img src="{{ config('app.url') }}/images/logo/denr1.png"
                                         alt="DENR Logo"
                                         height="40"
                                         style="display:block;">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h2 style="margin:10px 0 0 0; font-size:20px;">
                                        🎫 Ticket Status Update
                                    </h2>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <!-- BODY -->
                <tr>
                    <td style="padding:25px; color:#333333; font-size:14px; line-height:1.6;">

                        <!-- Greeting -->
                        <p>Dear <strong>{{ $ticket_request }}</strong>,</p>

                        <!-- Status -->
                        <p>
                            Your helpdesk ticket has been updated by the assigned technician.
                        </p>

                        <p>
                            <strong>Status:</strong> 
                            <span style="color:#0b5ed7;">{{ $ticket->status }}</span><br>
                            <strong>Resolution:</strong> {{ $ticket->resolution }}
                        </p>

                        <!-- INFO BOX -->
                        <table width="100%" cellpadding="8" cellspacing="0"
                               style="background:#f8f9fa; border:1px solid #e1e1e1; margin:20px 0;">
                            <tr>
                                <td width="35%"><strong>Helpdesk No:</strong></td>
                                <td>{{ $ticket->helpdesk_no }}</td>
                            </tr>
                            <tr>
                                <td><strong>Category:</strong></td>
                                <td>{{ $ticket->ticketType->ticket_type ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Subject:</strong></td>
                                <td>{{ $ticket->ticketCategory->ticket_category ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Date Received:</strong></td>
                                <td>{{ \Carbon\Carbon::parse($ticket->date_receive)->format('F d, Y \a\t g:i A l') }}</td>
                            </tr>
                            <tr>
                                <td><strong>Date Acted:</strong></td>
                                <td>{{ \Carbon\Carbon::parse($ticket->date_acted)->format('F d, Y \a\t g:i A l') }}</td>
                            </tr>
                            <tr>
                                <td><strong>Assigned Technician:</strong></td>
                                <td>
                                    {{ $ticket->technician->firstname ?? 'N/A' }}
                                    {{ $ticket->technician->middle_initial ? $ticket->technician->middle_initial . '.' : '' }}
                                    {{ $ticket->technician->lastname ?? '' }}
                                </td>
                            </tr>
                        </table>

                        <!-- TRACK & FEEDBACK BUTTON -->
                        <table width="100%" cellpadding="0" cellspacing="0" style="margin:25px 0;">
                            <tr>
                                <td align="center">
                                   <a href="localhost/denrxi_ictsms/ticket/track/"
                                       style="
                                            background:#0b5ed7;
                                            color:#ffffff;
                                            text-decoration:none;
                                            padding:12px 22px;
                                            font-size:14px;
                                            border-radius:4px;
                                            display:inline-block;
                                       ">
                                        🔍 Track & Give Feedback
                                    </a>
                                </td>
                            </tr>
                        </table>

                        <!-- WHAT TO EXPECT -->
                        <h3 style="margin-bottom:5px; color:#0b5ed7;">What You Can Expect</h3>
                        <ul style="padding-left:20px; margin-top:0;">
                            <li>Our technician has reviewed your concern and provided a resolution.</li>
                            <li>You can track progress and provide feedback using the button above.</li>
                            <li>Complex issues may require additional time for further follow-up.</li>
                            <li>You may be contacted if more information is needed.</li>
                        </ul>

                        <!-- IMPORTANT NOTE -->
                        <h3 style="margin-bottom:5px; color:#d9534f;">Important Note</h3>
                        <p style="background:#f8d7da; border:1px solid #f5c2c7; padding:10px; border-radius:4px;">
                            For urgent matters requiring immediate attention, please contact the ICT Unit directly at
                            <strong>(082) 123-4567</strong> during office hours
                            (8:00 AM - 5:00 PM, Monday to Friday).
                        </p>

                        <!-- Closing -->
                        <p>
                            Thank you for using our Helpdesk system. We appreciate your cooperation.
                        </p>

                        <p>
                            Best regards,<br>
                            <strong>DENR XI – RICTU Team</strong>
                        </p>

                    </td>
                </tr>

                <!-- FOOTER -->
                <tr>
                    <td style="background:#f1f1f1; text-align:center; padding:15px;
                               font-size:12px; color:#777777;">
                        This is a system-generated email. Please do not share your ticket details publicly.
                    </td>
                </tr>

            </table>

        </td>
    </tr>
</table>

</body>
</html>
