// Base URL of the API
const API_URL = 'http://localhost:8000/api/service-tickets';

// Fetch and display all tickets
function fetchTickets() {
    fetch(API_URL)
        .then(response => response.json())
        .then(data => {
            const ticketList = document.getElementById('ticketList');
            ticketList.innerHTML = ''; // Clear the list before adding new items
            data.data.forEach(ticket => {
                const ticketItem = document.createElement('li');
                ticketItem.innerHTML = `
                    <h3>${ticket.ticket_number} - ${ticket.customer_name}</h3>
                    <p>Service Type: ${ticket.service_type}</p>
                    <p>Appointment: ${ticket.appointment_datetime}</p>
                    <p>Status: ${ticket.status}</p>
                `;
                ticketList.appendChild(ticketItem);
            });
        })
        .catch(error => console.error('Error fetching tickets:', error));
}

// Handle ticket form submission
document.getElementById('createTicketForm').addEventListener('submit', function(event) {
    event.preventDefault();

    const customer_name = document.getElementById('customer_name').value;
    const service_type = document.getElementById('service_type').value;
    const appointment_datetime = document.getElementById('appointment_datetime').value;
    const contact_number = document.getElementById('contact_number').value;
    const description = document.getElementById('description').value;

    const newTicket = {
        customer_name,
        service_type,
        appointment_datetime,
        contact_number,
        description
    };

    // Make a POST request to create a new ticket
    fetch(API_URL, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(newTicket)
    })
    .then(response => response.json())
    .then(data => {
        alert('Ticket created successfully!');
        document.getElementById('createTicketForm').reset(); // Reset the form
        fetchTickets(); // Refresh ticket list
    })
    .catch(error => console.error('Error creating ticket:', error));
});

// Initial fetch to load tickets when the page loads
window.onload = fetchTickets;
