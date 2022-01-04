<?php
                if (isset($_POST['Deposit'])) {
                    $deposit_sum=htmlspecialchars($_POST["Deposit"]);
                    $request = "UPDATE Accounts SET balance = balance + $deposit_sum WHERE id='$id'";
                    $depositStatement = $connection->prepare($request);
                    $depositStatement->execute();
                    $sqlQuery = "INSERT INTO Transactions (transaction_number, transaction_name, amount, transaction_type, account_id, transaction_date) VALUES (32569, 'Deposit', '$deposit_sum', '+', '$id', Now())";
                    $addTransactionStatement = $connection->prepare($sqlQuery);
                    $addTransactionStatement->execute();
                } else if (isset($_POST['Withdrawal'])) {
                    $withdrawal_sum=htmlspecialchars($_POST["Withdrawal"]);
                    $request = "UPDATE Accounts SET balance = balance - $withdrawal_sum WHERE id='$id'";
                    $depositStatement = $connection->prepare($request);
                    $depositStatement->execute();
                    $sqlQuery = "INSERT INTO Transactions (transaction_number, transaction_name, amount, transaction_type, account_id, transaction_date) VALUES (32569, 'Withdrawal', '$withdrawal_sum', '-', '$id', Now())";
                    $addTransactionStatement = $connection->prepare($sqlQuery);
                    $addTransactionStatement->execute();
                } else {
                    $errorMessage = 'Error';
                }
                ?>