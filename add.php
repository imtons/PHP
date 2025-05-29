<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8" />
    <title>Thêm liên hệ</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f9fc;
            margin: 0;
            padding: 20px;
        }
        h2 {
            color: #333;
            text-align: center;
            margin-bottom: 30px;
        }
        form {
            max-width: 400px;
            background: #fff;
            padding: 25px 30px;
            margin: 0 auto;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        label {
            display: block;
            margin-bottom: 15px;
            color: #555;
            font-weight: 600;
        }
        input[type="text"],
        input[type="email"] {
            width: 100%;
            padding: 10px 12px;
            margin-top: 6px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1em;
            box-sizing: border-box;
            transition: border-color 0.3s ease;
        }
        input[type="text"]:focus,
        input[type="email"]:focus {
            border-color: #1e90ff;
            outline: none;
        }
        button {
            width: 100%;
            background-color: #1e90ff;
            border: none;
            padding: 12px 0;
            font-size: 1.1em;
            color: white;
            font-weight: bold;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 10px;
        }
        button:hover {
            background-color: #1565c0;
        }
    </style>
</head>
<body>
    <h2>Thêm liên hệ</h2>
    <form action="store.php" method="POST">
        <label>Họ tên:
            <input type="text" name="name" required />
        </label>
        <label>Email:
            <input type="email" name="email" required />
        </label>
        <label>SĐT:
            <input type="text" name="phone" required />
        </label>
        <button type="submit">Lưu</button>
    </form>
</body>
</html>
