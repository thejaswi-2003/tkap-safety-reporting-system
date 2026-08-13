# TKAP Safety Reporting System

A QR-code based digital safety walkthrough and near-miss reporting tool, built during an Information Systems internship at Toyota Kirloskar Auto Parts (TKAP).

## Overview

Shop-floor safety observations (near-misses, unsafe conditions, PPE violations) are often reported manually or verbally, making them slow to log and hard to track to closure. This project digitizes that process: an employee scans a location-specific QR code, submits a short report from their phone in under a minute, and the EHS (Environmental, Health & Safety) team tracks it through resolution on a live dashboard.

## Features

- **QR-code based reporting** — each shop-floor location has a unique QR code; scanning it opens a mobile-friendly report form with the location pre-selected. No login or app install required.
- **Structured issue categorization** — Near Miss, Unsafe Condition, Unsafe Act, PPE Violation, Fire Hazard, Spill/Leak.
- **Status workflow** — Open → Under Review → Action Taken → Closed, with a full timestamped history for audit purposes.
- **EHS dashboard** — live summary cards and Chart.js visualizations showing report volume by issue type and status.
- **Admin panel** — manage departments and locations, and auto-generate QR codes for each location.

## Tech Stack

| Layer | Technology |
|---|---|
| Backend | PHP (Core PHP) |
| Database | MySQL |
| Frontend | HTML5, CSS3, Bootstrap 5, Bootstrap Icons |
| Charts | Chart.js |
| QR generation | phpqrcode |
| Local server | XAMPP (Apache + MySQL + PHP) |

## Project Structure

## Database Schema

Six core tables: `departments`, `locations`, `ehs_officers`, `issue_types`, `reports`, `status_history`.

## Running Locally

1. Install XAMPP and start Apache + MySQL.
2. Clone this repo into your `htdocs` folder.
3. Enable the PHP `gd` extension in `php.ini` (required for QR generation).
4. Create a MySQL database and the six tables listed above.
5. Update `db_connect.php` with your database credentials.
6. Visit `index.php` to confirm the database connection.
7. Generate QR codes via `generate_qr.php`, then scan from a phone on the same Wi-Fi network.

## Status

Working prototype, developed and tested end-to-end including live testing on physical mobile devices over a local network. Built as an internship deliverable, not a production deployment.

### Known Limitations / Future Work

- No login or role-based access control.
- PDF export not yet implemented.
- Photo attachment not yet implemented.
- Tested only in a local development environment.

## Author

**Thejaswi Kotian**
MCA, Yenepoya Deemed to be University
Built during an Information Systems internship at Toyota Kirloskar Auto Parts (TKAP)