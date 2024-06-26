<html>

<head>
    <title>API Reference</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <style>
        body {
            margin: 0;
        }
    </style>
</head>

<body>
    <!-- Add your own OpenAPI/Swagger spec file URL here: -->
    <!-- Note: this includes our proxy, you can remove the following line if you do not need it -->
    <!-- data-proxy-url="https://api.scalar.com/request-proxy" -->
    <script id="api-reference" data-url="/openapi.yaml"></script>
    <!-- You can also set a full configuration object like this -->
    <!-- easier for nested objects -->
    <script>
        var configuration = {
            theme: 'purple',
        }

        var apiReference = document.getElementById('api-reference')
        apiReference.dataset.configuration = JSON.stringify(configuration)
        const socket = new WebSocket('ws://localhost:8000');
        const onMessage = (e) => {
            console.log({e})
            window.location.reload(true);
        }
        socket.onmessage = onMessage;
        // socket.onclose = onMessage;
        // socket.onerror = onMessage;
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@scalar/api-reference"></script>
</body>

</html>

