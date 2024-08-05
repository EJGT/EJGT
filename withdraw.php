<?php
$conn = new mysqli("localhost", "root", "", "bank");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$amount = $_POST['amount'];

$sql = "SELECT balance FROM accounts WHERE id = 1 FOR UPDATE";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $current_balance = $row['balance'];

    if ($current_balance >= $amount) {
        $new_balance = $current_balance - $amount;
        $sql = "UPDATE accounts SET balance = $new_balance WHERE id = 1";
        if ($conn->query($sql) === TRUE) {
            $sql = "INSERT INTO logs (amount, balance_after, timestamp) VALUES ($amount, $new_balance, NOW())";
            $conn->query($sql);
            echo "Withdrawal successful. New balance: $new_balance";
        } else {
            echo "Error updating balance: " . $conn->error;
        }
    } else {
        echo "Insufficient funds.";
    }
} else {
    echo "Account not found.";
}

$conn->close();
?>
