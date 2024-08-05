<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Banking System</title>
</head>
<body>
    <h1>Bank Account Management</h1>
    <form action="withdraw.php" method="post">
        <label for="amount">Amount to withdraw:</label>
        <input type="number" id="amount" name="amount" required>
        <button type="submit">Withdraw</button>
    </form>
    <h2>Transaction Logs</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Amount</th>
            <th>Balance After</th>
            <th>Timestamp</th>
        </tr>
        <?php
        $conn = new mysqli("localhost", "root", "", "bank");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "SELECT * FROM logs";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["id"] . "</td><td>" . $row["amount"] . "</td><td>" . $row["balance_after"] . "</td><td>" . $row["timestamp"] . "</td></tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No transactions found</td></tr>";
        }
        $conn->close();
        ?>
    </table>
</body>
</html>
