## Problem Statement
The Cool Kids Network is a user management system that allows users to register, log in, and view character data based on their roles. The system differentiates between three user roles: Cool Kid, Cooler Kid, and Coolest Kid, each with varying levels of access to user data.

## Technical Specification
- **User  Registration**: Users can sign up with an email address, which generates a character with random data.
- **User  Login**: Users can log in using their email address.
- **Role-Based Access**: Users can view their character data and, depending on their role, access data of other users.
- **API for Role Assignment**: A protected endpoint allows maintainers to change user roles.

## Technical Decisions
- **WordPress**: Chosen for its robust user management and extensibility.
- **OOP**: Used for user management classes to encapsulate functionality.
- **Logging**: Implemented logging for error tracking and monitoring.

## User Story Fulfillment
- **User  Story 1**: Implemented user registration and character generation.
- **User  Story 2**: Created a login system to view character data.
- **User  Story 3**: Implemented access control for Cooler Kid and Coolest Kid roles.
- **User  Story 4**: Enabled Coolest Kid role to view email and role of other users.
- **User  Story 5**: Developed a protected API endpoint for role assignment.

## Additional Notes
- The codebase is structured for readability and maintainability.


Detailed explanation is given below. 


Key Functionalities to Implement:
1. User Registration and Character Creation: Users can sign up with an email, generating a fake character.
2. User Login: Users can log in with their email and view their character's data.
3. Role-Based Access Control: Depending on a user's role, they may access different data (names, countries, emails, and roles of other regsitered users).
4. Role Assignment via API: Admin can change the role of a user via an API using the user’s email and name.


Technical Specification of the Design

Key Components:
1. User Registration: When a new user signs up with a valid email address, the randomuser.me API is called to generate random user data (first name, last name, country, email, and a default "Cool Kid" role). This data is stored in the WordPress users data page.
2. User Login: The user logs in by providing their email address. If the email matches a registered user, the login is successful. After logging in, the user can view their character's details (first name, last name, country, email, and role).
3. Role-Based Access Control:
    3.1 Cool Kid: Can only view their own character data.
    3.2 Cooler Kid: Can see other users' names and countries.
    3.3 Coolest Kid: Can see other users' names, countries, email addresses, and roles.
    3.4 Admin API for Role Assignment: An authenticated REST API endpoint allows the admin to update a user’s role by specifying their email, first name, and last name. Only the valid roles "Cool Kid", "Cooler Kid", and           "Coolest Kid" can be assigned.
 
4. Frontend Design
      A homepage with a Sign Up button that redirects to the registration page and a Login button for existing users.
      After logging in, a user sees a dashboard with their character’s details based on their role.

5. Backend Design
        The backend leverages WordPress's existing user management system. The roles and user data are stored in the WordPress database, utilizing custom user meta fields for character data and roles.
        User Data Storage: User details are stored in WordPress's wp_users table, while additional character information (first name, last name, country, email, role) is stored in wp_usermeta.
        API Design: The API is built using WordPress's REST API. The API endpoint for role assignment uses wp_remote_post() to validate and update a user’s role based on the provided email, first name, and last name.

4. API for Role Assignment
        The API is protected and can only be accessed by authenticated users with the proper permissions (maintainer role). The request must contain the email and role which needs to be updated. If the user exists, their           role is updated.


Technical Decisions Made

1. Use of WordPress
      Since the problem required a WordPress solution, the decision to use WordPress for both frontend and backend made the most sense. WordPress offers built-in user management and a REST API, which fits the requirement         for both user authentication and role-based access control.

2. Character Creation with randomuser.me
      To generate fake user data (character details), I used the randomuser.me API. This API provides random user data in various formats and is perfect for generating the character's first name, last name, country, and           email.

3. Role Management via User Meta
        I used WordPress's custom user meta fields to store and retrieve additional character data, such as first name, last name, country, and role. This approach allowed me to extend the default WordPress user table             without modifying the core structure.

4. REST API for Role Assignment
The REST API is a suitable choice for enabling third-party integrations to change user roles. This solution provides a clean, secure, and easily accessible endpoint for administrators to update roles as needed.

Achieving the Desired Outcome
1. User Registration and Character Creation
      When a user signs up with a valid email address, their character is automatically created with random details. The user is given the "Cool Kid" role by default. This ensures that the character creation process is          seamless and automated for new users.

2. User Login
      The login functionality works by matching the provided email with the registered users. Upon successful login, the user can view their character’s data.

3. Role-Based Data Access
      Cool Kid: After login, the user can only view their own data.
      Cooler Kid: This role allows the user to view other users' names and countries, while keeping email addresses and roles hidden.
      Coolest Kid: This role grants the user full access to other users' data, including their email addresses and roles.

4. Admin Role Assignment via API
      The admin can use the API to change the role of a user. The API checks for a valid user based on their email, first name, and last name. If found, the role is updated successfully, ensuring that role assignments are       flexible and easy to manage.


Conclusion

The solution implements all of the desired functionality in a WordPress environment, including user registration, login, role-based data access, and role management through an API. The implementation uses modern object-oriented programming (OOP) principles where appropriate and follows best practices for WordPress development. Additionally, the system is observable, resilient, and produces relevant logs for monitoring and error handling.








- Tests and CI are set up to ensure 

