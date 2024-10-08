<?php
// EMI Calculation logic (server-side)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collecting data from form
    $loan_amount = $_POST['loan_amount'];
    $interest_rate = $_POST['interest_rate'];
    $loan_tenure = $_POST['loan_tenure'];

    // EMI Calculation formula
    $monthly_interest_rate = ($interest_rate / 12) / 100;
    $loan_tenure_months = $loan_tenure * 12;
    $emi = ($loan_amount * $monthly_interest_rate * pow(1 + $monthly_interest_rate, $loan_tenure_months)) / (pow(1 + $monthly_interest_rate, $loan_tenure_months) - 1);
    $total_payment = $emi * $loan_tenure_months;
    $total_interest = $total_payment - $loan_amount;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EMI Calculator</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #bbd8f0; /* Light blue background */
            margin: 0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        h1 {
            color: #1e3a5f; /* Dark navy blue */
            text-align: center;
            margin-bottom: 20px;
        }
        .container {
            max-width: 600px;
            width: 100%;
        }
        .result-box {
            background-color: #ffffff; /* White background for sections */
            padding: 20px;
            padding-top: 0px;
            margin: 10px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border: 2px solid #87ceeb; /* Sky blue border */
            text-align: center;
        }
        .result-box h2 {
            background-color: #6CD4FF;
            padding: 25px;
            color: #1e90ff; /* Dodger blue */
            font-weight: bold;
        }
        .result-box p {
            font-size: 18px;
            color: #1e3a5f; /* Dark navy blue */
            margin: 10px 0;
        }
        strong {
            color: #1c3d5a; /* Darker navy blue for important details */
        }
    </style>
</head>
<body>

    <h1>EMI Calculator</h1>

    <div class="container">

        <?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
            <div class="result-box">
                <h2><strong>EMI Calculation Result</strong></h2>
                <p><strong>Loan Amount:</strong> ₹<?php echo number_format($loan_amount); ?></p>
                <p><strong>Interest Rate:</strong> <?php echo $interest_rate; ?>%</p>
                <p><strong>Loan Tenure:</strong> <?php echo $loan_tenure; ?> years</p>
                <p><strong>Monthly EMI:</strong> ₹<?php echo number_format(round($emi, 2)); ?></p>
                <p><strong>Total Payment:</strong> ₹<?php echo number_format(round($total_payment, 2)); ?></p>
                <p><strong>Total Interest Payable:</strong> ₹<?php echo number_format(round($total_interest, 2)); ?></p>
            </div>
        <?php else: ?>
            <div class="result-box">
                <h2><strong>Please enter your loan details</strong></h2>
                <form method="post" action="">
                    <label for="loan_amount">Loan Amount:</label><br>
                    <input type="number" name="loan_amount" required><br><br>
                    <label for="interest_rate">Interest Rate (%):</label><br>
                    <input type="number" name="interest_rate" required><br><br>
                    <label for="loan_tenure">Loan Tenure (in years):</label><br>
                    <input type="number" name="loan_tenure" required><br><br>
                    <input type="submit" value="Calculate EMI">
                </form>
            </div>
        <?php endif; ?>

    </div>

</body>
</html>
