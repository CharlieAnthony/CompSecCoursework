# Antique Evaluation Web Application

This project is a secure web application developed for a local antique dealer, to allow customers to register and request evaluations of antique objects. The application prioritizes security to protect customer information and safeguard from competitors.

## Features

- **User Registration**: Allows customers to register with email, password, name, and phone number. Data stored securely in a database.
- **Login**: Secure login functionality.
- **Password Management**: Password strength recommendations and recovery options.
- **Request Evaluation**: Logged-in users can submit evaluation requests with details of the object, preferred contact method, and optional photo upload.
- **Request Listing**: Admin-only page displaying all evaluation requests.

## Technology Stack

- **Backend**: PHP
- **Database**: SQLite
- **Hosting**: 000webhost (hosting has since stopped)

## Security Features

- Input validation and sanitation to prevent SQL injection and XSS attacks.
- Strong password policy enforcement and recovery process.
- Role-based access control (admin-only pages).
- File upload restrictions to prevent malicious file types.

## Usage

1. Register or log in as a customer to request an antique evaluation.
2. Admin users can view a list of all evaluation requests.

---

This project was developed as part of a coursework assignment focusing on secure web application practices.
