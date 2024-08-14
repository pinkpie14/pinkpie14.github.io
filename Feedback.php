<?php
require_once 'app/Models/Feedback.php';

$feedback = new Feedback();
$feedbacks = $feedback->listar();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Feedbacks</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #ddd;
        }
    </style>
</head>
<body>
    <h1>Feedbacks Recebidos</h1>
    <table>
        <tr>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Comentários</th>
            <th>Avaliação</th>
            <th>Data</th>
        </tr>
        <?php foreach ($feedbacks as $item) : ?>
        <tr>
            <td><?php echo htmlspecialchars($item['nome']); ?></td>
            <td><?php echo htmlspecialchars($item['email']); ?></td>
            <td><?php echo htmlspecialchars($item['comentarios']); ?></td>
            <td><?php echo intval($item['avaliacao']); ?></td>
            <td><?php echo htmlspecialchars($item['data_feedback']); ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
