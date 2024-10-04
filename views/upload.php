<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Page</title>
</head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        input[type="file"] {
            display: block;
            margin-bottom: 10px;
        }

        button {
            background-color: #ff5733;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #e04e2a;
        }
    </style>
<body>
    <form method="post" action="/upload" enctype="multipart/form-data">
    <input name="file" type="file" id="files" accept=".csv, .xlsx,
            application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
            required>
        <button type="submit">Upload</button>
    </form>
</body>
</html>