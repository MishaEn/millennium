// Получение ID клиента из URL
const params = new URLSearchParams(window.location.search);
const id = 1;

// Запрос данных с сервера
fetch(`/api/user/${id}`)
    .then(response => response.json())
    .then(data => {
        // Отображение информации о клиенте
        document.getElementById('client-info').innerHTML = `
            <p><strong>ФИО:</strong> ${data.client_name}</p>
        `;

        // Отображение заказов
        const ordersContainer = document.getElementById('orders');
        data.orders.forEach(order => {
            const orderDiv = document.createElement('div');
            orderDiv.className = 'order';
            orderDiv.innerHTML = `
                <p><strong>Товар:</strong> ${order.title}</p>
                <p><strong>Цена:</strong> ${order.price} руб.</p>
            `;
            ordersContainer.appendChild(orderDiv);
        });
    })
    .catch(error => console.error('Ошибка:', error));