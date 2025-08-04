# STDC Asset System

A web-based application for managing company assets. It provides a comprehensive platform for administrators and staff to register, track, inspect, and manage the disposal of assets throughout their lifecycle.

# 1) Key Features

*   **Dual User Roles:** The system supports two main roles with distinct permissions:
    *   **Admin:** Has full control over the system, including managing staff accounts, asset categories, and all asset records. They can oversee registrations, inspections, and disposals.
    *   **Staff:** Can manage assets, perform inspections, and initiate asset disposal processes.
*   **Complete Asset Lifecycle Management:**
    *   **Registration:** Detailed forms to register new assets with information like category, price, purchase date, and supplier.
    *   **Inspection:** Schedule and record asset inspections to ensure they are in good condition.
    *   **Disposal:** Manage the removal of assets from the system through a formal disposal process.
*   **QR Code Integration:** Automatically generates QR codes for each asset upon registration, making it easy to track and identify assets using a QR scanner.
*   **Profile Management:** Users can manage their own profile information.
*   **Reporting & Printing:** Generate and print reports for asset registration, inspection, and disposal records.
*   **Admin Dashboard:** A comprehensive dashboard for administrators to get an overview of the system's assets and activities.

# 2) Technology Stack

*   **Backend:** PHP
*   **Frontend:** HTML, CSS, JavaScript, jQuery, Bootstrap, DataTables
*   **Database:** MySQL / MariaDB (SQL dump provided in the `database` directory)

# 3) Project Structure

The application is organized into functional modules and shared components:

*   `/conn`: Contains the database connection script.
*   `/css`: Includes custom stylesheets for the application.
*   `/database`: Contains the `db_stdc_asset.sql` file to set up the database schema and initial data.
*   `/js`: Contains custom JavaScript files for dynamic functionality.
*   `/layout`: Contains reusable PHP view components like the header, footer, and menu.
*   `/phpqrcode`: The library used for generating QR codes.
*   `/vendor` & `/vendors`: Contain third-party frontend libraries and assets.
*   **Root Files:** Includes the main pages for login (`index.php`), dashboard (`dashboard.php`), and various forms and lists for managing assets and staff.

# 4) Project Preview

<img width="800" height="600" alt="image" src="https://github.com/user-attachments/assets/383f5f24-f23e-41da-9dc9-0fc9d056267b" />
<br>
<img width="800" height="600" alt="image" src="https://github.com/user-attachments/assets/53e10152-b1bb-4c67-a911-5329c98a23a9" />
<br>
<img width="800" height="600" alt="image" src="https://github.com/user-attachments/assets/937c1adb-367d-4d42-a1a8-d616e7cc5442" />
<br>
<img width="800" height="600" alt="image" src="https://github.com/user-attachments/assets/e4097699-0c6d-4fe6-bdc8-2abaadc9c762" />
<br>
<img width="800" height="600" alt="image" src="https://github.com/user-attachments/assets/16c6244e-cb20-4eae-8cab-e9893e9baefd" />
<br>
<img width="800" height="600" alt="image" src="https://github.com/user-attachments/assets/38b9bccc-988b-443a-9cf4-8a108b6168ae" />
<br>
<img width="800" height="600" alt="image" src="https://github.com/user-attachments/assets/2029d10e-8150-4382-9042-12ce46ed58ca" />







