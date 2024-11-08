1. Landing Page (Company-Specific)
Purpose: This page serves as the entry point for guests to submit incidents and for users to log in.

Contents:
    - Company branding and description
    - Login form
    - "Submit an Incident" form for guests
    - Links to register or get more information about the service

Tables Used:
    - Companies (to display company-specific branding)
    - Users (for user login)
    - Incidents (for guests to submit incidents)

How It Works: Each company will have its own unique landing page. Guests can submit incidents via a form, and logged-in users will be directed to their respective dashboards. 
This page also authenticates users by checking credentials from the Users table.

2. Admin Dashboard
Purpose: Provides Admins with an overview of system-wide activity and access to all features.

Contents:
    - Summary cards (Total Incidents, Open Incidents, Resolved Incidents)
    - Recent incident list
    - Navigation to manage users, companies, subscriptions, and reports

Tables Used:
    - Incidents (for incident summaries)
    - Users, Roles, Companies (for managing users and companies)
    - Subscriptions (for subscription tracking)

How It Works: Admins can view all incidents across all companies, manage user accounts, assign roles, and view subscription information. 
The dashboard will query the Incidents table to display incident statuses and the Subscriptions table to monitor company subscription plans.

3. Company Admin Dashboard
Purpose: Gives Company Admins control over their company’s incidents, users, teams, and reports.

Contents:
    - Company-specific incident and task summaries
    - Links to manage incidents, teams, and users
    - Performance reports

Tables Used:
    - Incidents
    - Tasks
    - Teams 
    - Users 
    - Companies

How It Works: This dashboard restricts the view to incidents and tasks related to the logged-in admin's company. 
Company Admins can assign tasks to teams, resolve incidents, and manage their company’s user accounts.

4. User/Employee Dashboard
Purpose: Allows users to track and manage incidents and tasks assigned to them.

Contents:
    - My Incidents (incidents they’ve reported)
    - Assigned Tasks (tasks assigned to them by Company Admin)
    - Profile settings

Tables Used:
    - Incidents
    - Tasks
    - Users

How It Works: This dashboard provides a personalized view for users, showing only the incidents they have submitted or tasks assigned to them. 
They can view details, track the status, and update their profile settings.

5. Guest Incident Submission Page
Purpose: Enables guests to submit incidents without needing to log in.

Contents:
    - Incident submission form
    - Basic fields: Name, Contact Info, Incident Description

Tables Used:
    - Incidents 
    - Users (optional guest entry)

How It Works: Guests can submit incidents by filling out a form. The incident will be assigned to the appropriate Company Admin based on the landing page they accessed. 
If desired, the system can store minimal information about the guest in the Users table.

6. Incident Management Page
Purpose: Allows Company Admins and Users to view, update, and manage incidents.

Contents:
    - List of all incidents reported (filter by status, date, etc.)
    - View Incident Details (description, status, assigned team)
    - Update status (Company Admins only)

Tables Used:
    - Incidents
    - Users 
    - Teams

How It Works: This page lists incidents for either the whole company (for Company Admins) or only those assigned to the user (for Users/Employees). 
Company Admins can update the status (open, in progress, resolved) and assign tasks to teams.

7. Task Management Page
Purpose: Provides the ability to view and manage tasks related to incidents.

Contents:
    - Task list (filter by status, assigned to, etc.)
    - Task details (description, status, assigned user/team)
    - Update task status (open, in progress, completed)

Tables Used:
    - Tasks 
    - Incidents 
    - Users 
    - Teams

How It Works: Users can view tasks assigned to them, and Company Admins can assign tasks to specific users or teams. 
Tasks are linked to incidents, so completing a task can automatically update the corresponding incident status.

8. Team Management Page
Purpose: Allows Company Admins to create and manage teams within their company.

Contents:
    - List of teams
    - Add/Remove users from teams
    - Create new teams

Tables Used:
    - Teams 
    - Users 
    - Companies

How It Works: Company Admins can create teams and assign Users/Employees from their company to those teams. 
This page allows admins to manage team membership and monitor team performance on incidents and tasks.

9. User Management Page
Purpose: For Admins (system-wide) and Company Admins (company-specific) to manage users.

Contents:
    - User list (filter by role, company, etc.)
    - Create, edit, or delete user accounts
    - Assign roles (Admin, Company Admin, User/Employee)

Tables Used:
    - Users
    - Roles 
    - Companies

How It Works: Admins can manage all users across the system, while Company Admins can only manage users within their company. 
Users can be created with specific roles, and permissions are assigned based on those roles.

10. Subscription Management Page (For Admins)
Purpose: To manage company subscriptions and billing.

Contents:
    - List of companies and their subscription status
    - Add or modify subscription plans
    - View billing cycles

Tables Used:
    - Subscriptions 
    - Companies

How It Works: Admins can view all subscribed companies and their billing information. 
This page helps in managing subscription renewals, plan upgrades, and monitoring the status (active, expired) of each company's subscription.

11. Reports & Analytics Page
Purpose: For Admins and Company Admins to generate reports on incidents and tasks.

Contents:
    - Incident and task performance reports
    - Filter options (date, status, team, etc.)
    - Export to CSV/PDF

Tables Used:
    - Incidents
    - Tasks 
    - Users 
    - Companies

How It Works: This page generates reports and analytics for incidents and tasks based on various filters. 
Admins can generate system-wide reports, while Company Admins can generate reports specific to their company.

12. Settings Page
Purpose: For all users to update personal account settings, and for Admins to configure system settings.

Contents:
    - Update password, email, and other personal settings
    - System settings (Admin only)

Tables Used:
    - Users 
    - Companies

How It Works: Users can update their account information, such as password and email, while Admins can access additional 
settings related to system-wide configurations like default permissions or subscription management settings.

