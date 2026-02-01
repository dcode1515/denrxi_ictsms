<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>ICT Equipment Repair Form</title>
<style>
  body {
    font-family: Arial, sans-serif;
    font-size: 14px;
    margin: 20px;
  }

  /* Header Table */
  table.header-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
  }

  /* Logo Column — No border */
  .logo-cell {
    width: 15%;
    vertical-align: middle;
    padding: 10px;
    border: none;
  }
  .logo-cell img {
    max-width: 80px;
    display: block;
    margin: 0 auto;
  }

  /* Title Column — Boxed */
  .title-cell {
    width: 60%;
    text-align: center;
    padding: 15px 10px;
    border: 1px solid black; /* Box border */
  }
  .title-cell .dept {
    font-weight: bold;
    font-size: 14px;
    margin-bottom: 5px;
    
  }
   .dept-1 {
   
    font-size: 14px;
    margin-right: 100px;
    
  }
  .title-cell .form-title {
    font-weight: bold;
    font-size: 18px;
  }
   .form-title-1 {
    font-weight: bold;
    font-size: 14px;
     margin-top: 15px;
    
  }

  /* Document Info Column */
  .doc-info-cell {
    width: 25%;
    padding: 0;
  }
  table.doc-info-table {
    width: 100%;
    border-collapse: collapse;
  }
  table.doc-info-table td {
    border: 1px solid black;
    padding: 4px 10px; /* Increased horizontal padding */
    font-size: 12px;
  }
  table.doc-info-table td:first-child {
    font-weight: normal;
    width: 40%; /* Make label column slightly wider */
  }
  table.doc-info-table td:nth-child(2) {
    text-align: center;
  }

  /* Form Titles */
  .form-section-title {
    text-align: center;
    font-weight: bold;
    margin-top: 10px;
  }
  .form-section-subtitle {
    text-align: center;
    font-size: 12px;
    margin-bottom: 15px;
  }

  /* Form Content */
  .form-content {
    width: 100%;
    font-size: 13px;
  }
  .field-label {
    font-weight: bold;
  }
  .line-input {
    display: inline-block;
    border-bottom: 1px solid black;
    min-width: 150px;
    margin-left: 5px;
    margin-right: 20px;
  }
  .multi-line {
    border-bottom: 1px solid black;
    height: 15px;
    margin: 6px 0;
  }
  .multi-line.long {
    width: 100%;
    display: block;
  }
  .inline-group {
    margin-bottom: 8px;
  }

  /* Rating Explanation */
  .rating-explanation {
    font-size: 11px;
    margin-top: 10px;
  }
  .rating-explanation u {
    font-weight: normal;
  }

  /* Signature Section */
  .signature-table {
    width: 100%;
    margin-top: 40px;
    border-collapse: collapse;
  }
  .signature-table td {
    width: 50%;
    vertical-align: top;
    font-size: 13px;
  }
  .sig-left {
    text-align: left;
    padding-left: 10px;
  }
  .sig-right {
    text-align: right;
    padding-right: 10px;
  }
  .sig-title {
    font-weight: bold;
    margin-bottom: 25px;
     margin-right: 105px;
  }
  .sig-line {
    border-bottom: 1px solid black;
    width: 200px;
    margin-bottom: 5px;
  }
  .sig-right .sig-line {
    margin-left: auto;
  }
  .sig-label {
    font-size: 12px;
    margin-left: 37px;
    
  }
    .sig-label-1 {
    font-size: 12px;
    margin-right: 37px;
    
  }
</style>
</head>
<body>

<!-- Header Table -->
<table>
  <tr>
    <!-- Logo -->
    <td class="logo-cell">
      <img src="{{ URL::asset('public/images/logo/denr1.png') }}" />
    </td>

    <!-- Title (Boxed) -->
    <td class="title-cell">
      <div class="dept">Department of Environment and Natural Resources</div>
      <div class="form-title">ICT Equipment Repair Form</div>
    </td>

    <!-- Document Info -->
     &nbsp;
     
    <td class="doc-info-cell">
      <table class="doc-info-table" aria-label="Document Information">
        <tr>
          <td>Document ID</td>
          <td>RII-PMD-FO-004</td>
        </tr>
        <tr>
          <td>Revision</td>
          <td>0</td>
        </tr>
        <tr>
          <td>Date Issued</td>
          <td>December 18, 2019</td>
        </tr>
      </table>
    </td>
  </tr>
</table>

<table>
    <tr>
         <td class="title-cell">
      <div class="dept-1" >Originator:</div>
      <div class="form-title-1">Planning and Management Division</div>
    </td>
    <td class="title-cell">
      <div class="dept-1">Reviewed by:</div>
      <div class="form-title-1">ARED for Management Service</div>
    </td>
    <td class="title-cell">
      <div class="dept-1">Approved by: </div>
      <div class="form-title-1">Regional Executive Director</div>
    </td>
</tr>
</table>


<!-- Form Titles -->
<div class="form-section-title">REGIONAL INFORMATION AND COMMUNICATION TECHNOLOGY</div>
<div class="form-section-subtitle">
  <b>Repair of ICT Equipment</b><br />
  Request Form
</div><br>

<!-- Form Content -->
<div class="form-content" role="form" aria-label="ICT Equipment Repair Form">
  <div class="inline-group">
    <span class="field-label">HELPDESK CONT.NO:</span>
    <span class="line-input">{{$ticket->helpdesk_no}}</span>
  </div>

  <div class="inline-group">
    <span class="field-label">OFFICE:</span>
    <span class="line-input">{{$ticket->office->office}}</span>
  </div>

  <div class="inline-group">
    <span class="field-label">DATE:</span>
   <span class="line-input">{{ \Carbon\Carbon::parse($ticket->date_created)->format('m/d/y') }}</span>


    <span class="field-label">TIME:</span>
   <span class="line-input">{{ \Carbon\Carbon::parse($ticket->date_created)->format('h:i A') }}</span>

  </div>

  <div class="inline-group">
    <span class="field-label">PROPERTY #:</span>
  <span class="line-input long" style="min-width:300px;">
    {{$ticket->property_no ?? 'No Property # Encoded'}}
</span>

  </div>

  <div class="inline-group" style="margin-top: 15px;">
    <span class="field-label">ISSUE/ CONCERN:</span>
  </div>
  <div class="multi-line long">{{$ticket->issue_concern}}</div>
  <div class="multi-line long"></div>
  <div class="multi-line long"></div>
  <div class="multi-line long"></div>

  <div class="inline-group" style="margin-top: 15px;">
    <span class="field-label">RESOLUTION:</span>
  </div>
  <div class="multi-line long">{{$ticket->resolution}}</div>
  <div class="multi-line long"></div>
  <div class="multi-line long"></div>
  <div class="multi-line long"></div>

  <div class="inline-group" style="margin-top: 15px;">
    <span class="field-label">PROBLEM SOLVE: YES:</span>
    <span class="line-input" style="width: 40px;"></span>
    <span>or No</span>
    <span class="line-input" style="width: 40px;"></span>
    <span>Why?</span>
  </div>
  <div class="multi-line long"></div>
  <div class="multi-line long"></div>
  <div class="multi-line long"></div>

  <div class="inline-group" style="margin-top: 20px;">
    <span class="field-label">Rate the technician.</span>
    <span class="line-input" style="width: 80px;"></span>
  </div>

  <div class="rating-explanation">
    <span><u>E</u> - Excellent</span>&nbsp;&nbsp;
    <span><u>VS</u> - Very Satisfactory</span>&nbsp;&nbsp;
    <span><u>S</u> - Satisfactory</span>&nbsp;&nbsp;
    <span><u>BS</u> - Below Satisfactory</span>
  </div>

  <!-- Signature Section -->
  <table class="signature-table">
    <tr>
      <td class="sig-left">
        <div class="sig-title">Inspected / Repaired by:</div>
        <div class="sig-line" style="display:inline-block; max-width:200px; word-wrap:break-word;"><span style="margin-left:39px;">{{$ticket->technician->firstname}} {{$ticket->technician->middle_initial}}. {{$ticket->technician->lastname}}</span></div>
        <div class="sig-label">Technician / RICTU</div>
      </td>
<td class="sig-right" style="text-align:center; vertical-align:top;">
  <div class="sig-title">Conformed by:</div>
  <div class="sig-line" style="display:inline-block; max-width:200px; word-wrap:break-word;">
    {{$ticket->firstname}} {{$ticket->middle_initial}}. {{$ticket->lastname}}
  </div>
  <div class="sig-label-1">Name and Signature</div>
</td>

    </tr>
  </table>
</div>

</body>
</html>
