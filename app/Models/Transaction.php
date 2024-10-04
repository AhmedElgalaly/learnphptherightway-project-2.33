<?php

declare(strict_types = 1);

namespace App\Models;

use App\App;
use App\Model;
use PDO;
use DateTime;
use Ramsey\Uuid\Uuid;

class Transaction extends Model
{

    public function create(DateTime $dateOfTransaction, ?int $CheckNum, string $description, float $amount, ?string $ileId): void
    {
        $query = 'INSERT INTO transactions (TransactionID, DateOfTransaction, CheckNum, Description, Amount, Negative, FileID)
            VALUES (:TransactionID, :DateOfTransaction, :CheckNum, :Description, :Amount, :Negative, :FileID)';

        $newTransactionStmt = $this->db->prepare($query);

        $formatedDate = $dateOfTransaction->format('Y-m-d H:i:s');

        $newTransactionStmt->bindValue('TransactionID', Uuid::uuid4(), PDO::PARAM_STR);
        $newTransactionStmt->bindValue('DateOfTransaction', $formatedDate, PDO::PARAM_STR);
        $newTransactionStmt->bindValue('CheckNum', $CheckNum, PDO::PARAM_INT);
        $newTransactionStmt->bindValue('Description', $description, PDO::PARAM_STR);
        $newTransactionStmt->bindValue('Amount', abs($amount), PDO::PARAM_STR);
        $newTransactionStmt->bindValue('Negative', $amount < 0? TRUE : FALSE, PDO::PARAM_BOOL);
        $newTransactionStmt->bindValue('FileID', $ileId, PDO::PARAM_STR);

        
        $newTransactionStmt->execute();

    }

    public function all(): array
    {
        $query = 'SELECT * FROM transactions';

        $newTransactionStmt = $this->db->query($query);

        return $newTransactionStmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getRevenue (): float
    {
        $query = 'SELECT SUM(Amount) From Transactions
                    WHERE Negative = FALSE';

        $newTransactionStmt = $this->db->query($query);

        return (float)$newTransactionStmt->fetchColumn();
    }

    public function getExpenses (): float
    {
        $query = 'SELECT SUM(Amount) From Transactions
                    WHERE Negative = TRUE';

        $newTransactionStmt = $this->db->query($query);

        return $newTransactionStmt->fetchColumn() * -1;
    }



    
}