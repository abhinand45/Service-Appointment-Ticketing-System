<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Ticket Management</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Service Ticket Management</h1>

        <!-- Create Ticket Form -->
        <div>
            <h2>Create New Ticket</h2>
            <form id="createTicketForm">
                <label for="customer_name">Customer Name:</label>
                <input type="text" id="customer_name" required>

                <label for="service_type">Service Type:</label>
                <select id="service_type" required>
                    <option value="Electrical">Electrical</option>
                    <option value="Plumbing">Plumbing</option>
                    <option value="HVAC">HVAC</option>
                </select>

                <label for="appointment_datetime">Appointment Date and Time:</label>
                <input type="datetime-local" id="appointment_datetime" required>

                <label for="contact_number">Contact Number:</label>
                <input type="text" id="contact_number" required>

                <label for="description">Description:</label>
                <textarea id="description"></textarea>

                <button type="submit">Create Ticket</button>
            </form>
        </div>

        <!-- Ticket List -->
        <div>
            <h2>Service Tickets</h2>
            <ul id="ticketList"></ul>
        </div>
    </div>

    <script src="scripts.js"></script>
</body>
</html>
