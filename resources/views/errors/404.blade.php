
@section('content')
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Not Found</title>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:wght@200;500&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary-color: #faca2e;
            --eye-pupil-color: #050505;
            --bg-color: #fff;
            --text-color: #000;
        }

        body {
            display: flex;
            min-height: 100vh;
            background-color: var(--bg-color);
            color: var(--text-color);
            font-family: "Fira Sans", sans-serif;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            margin: auto;
        }

        .eyes {
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        .eye {
            width: 80px;
            height: 80px;
            background-color: var(--primary-color);
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .eye__pupil {
            width: 30px;
            height: 30px;
            background-color: var(--eye-pupil-color);
            border-radius: 50%;
            animation: movePupil 2s infinite ease-in-out;
        }

        @keyframes movePupil {
            0%, 100% { transform: translate(0, 0); }
            25% { transform: translate(-10px, -10px); }
            50% { transform: translate(10px, 10px); }
            75% { transform: translate(-10px, 10px); }
        }

        .error-text {
            margin-top: 20px;
        }

        .error-title {
            font-size: 36px;
            font-weight: 500;
            color: var(--primary-color);
        }

        .error-description {
            margin-top: 10px;
            font-size: 22px;
            font-weight: 200;
        }

        .error-button {
            margin-top: 20px;
            text-decoration: none;
            font-size: 18px;
            padding: 12px 24px;
            border: 1px solid var(--primary-color);
            border-radius: 15px;
            background: transparent;
            transition: all 0.3s ease-in-out;
        }

        .error-button:hover {
            background-color: var(--primary-color);
            color: white;
        }

        .color-switcher {
            position: fixed;
            top: 20px;
            right: 20px;
            font-size: 24px;
            cursor: pointer;
            background: transparent;
            border: none;
            color: var(--primary-color);
        }
    </style>
</head>
<body>

<main class="container">
    <div class="eyes">
        <div class="eye"><div class="eye__pupil"></div></div>
        <div class="eye"><div class="eye__pupil"></div></div>
    </div>

    <div class="error-text">
        <h1 class="error-title">Oops! Page Not Found</h1>
        <p class="error-description">
            {{ session('message') ?? "The page you are looking for doesn't exist or you don't have permission to access it." }}
        </p>
    </div>

    <a href="{{url('/')}}" class="error-button">Back to Home</a>
</main>

<button class="color-switcher" onclick="toggleTheme()">🌙</button>

<script>
    let currentTheme = "light";
    function toggleTheme() {
        const root = document.documentElement;
        if (currentTheme === "dark") {
            root.style.setProperty("--bg-color", "#fff");
            root.style.setProperty("--text-color", "#000");
            currentTheme = "light";
        } else {
            root.style.setProperty("--bg-color", "#050505");
            root.style.setProperty("--text-color", "#fff");
            currentTheme = "dark";
        }
    }
</script>

</body>
</html>
