<!DOCTYPE html>
<html>
    <head>
        <title>Transactions</title>
        <style>
            table {
                width: 100%;
                border-collapse: collapse;
                text-align: center;
            }

            table tr th, table tr td {
                padding: 5px;
                border: 1px #eee solid;
            }

            tfoot tr th, tfoot tr td {
                font-size: 20px;
            }

            tfoot tr th {
                text-align: right;
            }
        </style>
    </head>
    <body>
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Check #</th>
                    <th>Description</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <!-- TODO -->
                <?php
                    foreach ($transactions as $transaction) {
                        echo "<tr>";
                        echo "<td>{$transaction['DateOfTransaction']}</td>";
                        echo "<td>{$transaction['CheckNum']}</td>";
                        echo "<td>{$transaction['Description']}</td>";
                        echo "<td style='color:" . ($transaction['Negative'] == 1 ? "red" : "green") . "'>$" . "{$transaction['Amount']}</td>";
                        echo "</tr>";
                    }?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3">Total Income:</th>
                    <td style="color: green"><!-- TODO -->
                    <?php echo '$'.$revenue; ?>
                    </td>
                </tr>
                <tr>
                    <th colspan="3">Total Expense:</th>
                    <td style="color:red"><!-- TODO -->
                    <?php echo '$'.abs($expenses); ?>
                    </td>
                </tr>
                <tr>
                    <th colspan="3">Net Total:</th>
                    <td <?php echo 'style=color:' . ($netTotal>=0? 'green':'red') ?> ><!-- TODO -->
                    <?php echo '$'.$netTotal; ?>
                    </td>
                </tr>
            </tfoot>
        </table>
    </body>
</html>
