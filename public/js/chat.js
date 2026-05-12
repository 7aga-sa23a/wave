async function sendMessage() {

    const response = await fetch("../../public/api/chat.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: "message=Explain JavaScript loops"
    });

    const data = await response.json();

    console.log(data);
}

sendMessage();