# Number Classification API

## Overview

This is a simple number classification API that evaluates whether a number is prime, perfect, or an Armstrong number. It also provides the sum of digits, odd/even classification, and a fun fact.

## Features

- Determines if a number is **prime**
- Determines if a number is **perfect**
- Identifies if a number is an **Armstrong number**
- Computes the **sum of its digits**
- Classifies the number as **odd or even**
- Fetches a **fun fact** about the number using Numbers API
- Returns structured JSON responses
- Handles errors gracefully
- Deployed on AWS EC2

## API Specification

### Endpoint

```
GET http://ec2-18-226-226-215.us-east-2.compute.amazonaws.com/api/classify-number?number=<integer>
```

### Request Parameters

| Parameter | Type    | Required | Description            |
| --------- | ------- | -------- | ---------------------- |
| number    | integer | Yes      | The number to classify |

### Response Format

#### **200 OK** (Valid Integer Input)

```json
{
    "number": 371,
    "is_prime": false,
    "is_perfect": false,
    "properties": ["armstrong", "odd"],
    "digit_sum": 11,
    "fun_fact": "371 is an Armstrong number because 3^3 + 7^3 + 1^3 = 371"
}
```

#### **400 Bad Request** (Invalid Input)

```json
{
    "number": "alphabet",
    "error": true
}
```

## Deployment

The API is deployed on an AWS EC2 instance and can be accessed publicly [here](http://ec2-18-226-226-215.us-east-2.compute.amazonaws.com/api/classify-number) . Future improvements may include migrating to AWS Lambda for better scalability.

## Technologies Used

- **Language:** PHP
- **Hosting:** AWS EC2
- **Version Control:** GitHub
- **API Data Source:** Numbers API (for fun facts)

## Setup and Installation

To run this project locally:

1. Clone the repository:
   ```sh
   git clone <repository-url>
   ```
2. Navigate to the project directory:
   ```sh
   cd your-path/devops_task_one/
   ```
3. Start a PHP server (assuming PHP is installed):
   ```sh
   php -S localhost:8000
   ```
4. Test the API:
   ```sh
   curl "http://localhost:8000/api/classify-number?number=371"
   ```

## Future Improvements

- Enhance error handling for external API failures.
- Implement rate limiting to prevent abuse.
- Consider migrating to AWS Lambda for auto-scaling.
- Improve input validation to reject floating-point numbers.

## License

This project is open-source and available under the MIT License.

