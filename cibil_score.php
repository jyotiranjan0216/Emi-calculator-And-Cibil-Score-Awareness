<?php
// Variables for collecting input data
$pan = "";
$job = "";
$interest = "";
$cibil_score = 0;
$loan_eligibility = "";
$advice = "";

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collecting data from the form
    $pan = htmlspecialchars($_POST['pan']);
    $job = htmlspecialchars($_POST['job']);
    $interest = htmlspecialchars($_POST['interest']);
    
    // Generate a random CIBIL score between 300 and 900
    $cibil_score = rand(300, 900);

    // Check loan eligibility based on CIBIL score
    if ($cibil_score < 600) {
        $loan_eligibility = "Not Eligible for Loan";
        $advice = "Tips to improve your CIBIL Score: 
            <ol>
                <li>Pay your EMIs and credit card dues on time.</li>
                <li>Keep your credit utilization below 30%.</li>
                <li>Maintain a healthy mix of secured and unsecured loans.</li>
                <li>Limit the number of hard inquiries on your credit report.</li>
                <li>Regularly check your credit report for errors and dispute any inaccuracies.</li>
            </ol>";
    } elseif ($cibil_score >= 600 && $cibil_score < 750) {
        $loan_eligibility = "Conditionally Eligible for Loan";
        $advice = "Consider improving your score by: 
            <ol>
                <li>Paying off any outstanding debts.</li>
                <li>Timely payments of current loans.</li>
                <li>Avoiding taking on new debts until your score improves.</li>
            </ol>";
    } else {
        $loan_eligibility = "Eligible for Loan";
        $advice = "Great! You have a good CIBIL Score.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CIBIL Score Awareness</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #bbd8f0; 
            margin: 0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        h1 {
            color: #1e3a5f; 
            text-align: center;
            margin-bottom: 20px;
        }
        .container {
            max-width: 600px;
            width: 100%;
        }
        .result-box {
            background-color: #ffffff;
            padding: 20px;
            margin: 10px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border: 2px solid #87ceeb; 
            text-align: center;
        }
        h3,h2 {
            color: #1e90ff; 
            font-weight: bold;
        }
        .result-box p {
            font-size: 18px;
            color: #1e3a5f; 
            margin: 10px 0;
        }
        
        .advice {
            margin-top: 50px;
        }

        strong {
            color: #1c3d5a; 
        }
        ol {
            text-align: left;
            margin: 0 auto;
            padding: 0;
        }
    </style>
</head>
<body>

    <h1>CIBIL Score Awareness</h1>

    <div class="container">

        <div class="result-box">
            <h2>CIBIL DETAILS</h2>
            <p><strong>PAN Card Number:</strong> <?php echo $pan; ?></p>
            <p><strong>Job Details:</strong> <?php echo $job; ?></p>
            <p><strong>Area of Interest for Loans:</strong> <?php echo ucfirst($interest); ?></p>
            <p><strong>Generated CIBIL Score:</strong> <?php echo $cibil_score; ?></p>
            <p><strong>Loan Eligibility Status:</strong> <?php echo $loan_eligibility; ?></p>
            <div class="advice">
                <h3>Advice:</h3>
                <p><?php echo $advice; ?></p>
            </div>
        </div>

    </div>

</body>
</html>
