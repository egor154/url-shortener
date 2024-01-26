function shortenURL() {
    const originalURL = document.getElementById('originalURL').value;

    if (!originalURL) {
        alert('Please enter a URL');
        return;
    }

    // В реальном проекте здесь нужно отправить запрос на сервер для сокращения URL
    // В данном примере будем использовать сервис rebrandly.com

    const apiKey = 'api key';
    const apiUrl = 'https://api.rebrandly.com/v1/links';

    fetch(apiUrl, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'apikey': apiKey,
        },
        body: JSON.stringify({
            destination: originalURL,
        }),
    })
        .then(response => response.json())
        .then(data => {
            const shortenedURL = data.shortUrl;
            document.getElementById('shortenedURL').innerText = `Shortened URL: ${shortenedURL}`;
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while shortening the URL');
        });
}
