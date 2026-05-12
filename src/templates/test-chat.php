<?php require_once __DIR__ . '/../core/config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wave AI Test</title>
</head>
<body>

    <h1>Wave AI Test</h1>

    <textarea id="message" placeholder="Write your message"></textarea>

    <br><br>

    <button type="button" onclick="sendMessage()">
        Send
    </button>

    <pre id="response"></pre>

    <script>

        async function sendMessage() {

            const message = document.getElementById("message").value;

            const response = await fetch("../api/chat.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body: "message=" + encodeURIComponent(message)
            });

            const data = await response.json();

            console.log(data);

            if(data.choices){

                document.getElementById("response").innerText =
                    data.choices[0].message.content;

            } else {

                document.getElementById("response").innerText =
                    JSON.stringify(data, null, 2);

            }
        }

    </script>

</body>
</html>